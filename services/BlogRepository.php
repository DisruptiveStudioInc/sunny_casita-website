<?php

declare(strict_types=1);

namespace Services;

use Closure;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use InvalidArgumentException;
use Models\BlogPost;
use RuntimeException;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;
use Throwable;

final class BlogRepository
{
    /** @var array<string, array<string, BlogPost>> */
    private array $postCache = [];

    /** @var array<string, array<string, string>>|null */
    private ?array $categoryCache = null;

    /** @var Closure(string): void */
    private readonly Closure $logger;

    /**
     * @param list<string> $languages
     */
    public function __construct(
        private readonly string $contentDirectory,
        private readonly string $coverDirectory,
        private readonly array $languages = ['en', 'es'],
        ?DateTimeImmutable $today = null,
        ?callable $logger = null,
    ) {
        $this->today = $today ?? new DateTimeImmutable('today', new DateTimeZone('UTC'));
        $this->logger = static function (string $message) use ($logger): void {
            if ($logger !== null) {
                $logger($message);
                return;
            }
            error_log($message);
        };
    }

    private readonly DateTimeImmutable $today;

    /**
     * @return list<BlogPost>
     */
    public function published(string $language): array
    {
        $this->assertLanguage($language);

        $posts = array_values(array_filter(
            $this->postsForLanguage($language),
            fn(BlogPost $post): bool => $post->isVisible($this->today),
        ));

        usort(
            $posts,
            static fn(BlogPost $left, BlogPost $right): int =>
                $right->date <=> $left->date ?: strcmp($left->slug, $right->slug),
        );

        return $posts;
    }

    /**
     * @return list<BlogPost>
     */
    public function allPublished(): array
    {
        $posts = [];
        foreach ($this->languages as $language) {
            array_push($posts, ...$this->published($language));
        }

        return $posts;
    }

    public function findPublished(string $language, string $slug): ?BlogPost
    {
        if (!preg_match('/\A[a-z0-9]+(?:-[a-z0-9]+)*\z/', $slug)) {
            return null;
        }

        foreach ($this->published($language) as $post) {
            if ($post->slug === $slug) {
                return $post;
            }
        }

        return null;
    }

    /**
     * @return array<string, array<string, string>>
     */
    public function categories(): array
    {
        if ($this->categoryCache !== null) {
            return $this->categoryCache;
        }

        $path = $this->contentDirectory . '/categories.yaml';
        if (!is_file($path) || !is_readable($path)) {
            throw new RuntimeException('Blog category catalog is missing or unreadable.');
        }

        try {
            $parsed = Yaml::parseFile($path);
        } catch (ParseException $exception) {
            throw new RuntimeException('Blog category catalog contains invalid YAML.', 0, $exception);
        }

        if (!is_array($parsed) || !isset($parsed['categories']) || !is_array($parsed['categories'])) {
            throw new RuntimeException('Blog category catalog must contain a categories map.');
        }

        $catalog = [];
        foreach ($parsed['categories'] as $key => $labels) {
            if (!is_string($key) || !preg_match('/\A[a-z0-9]+(?:-[a-z0-9]+)*\z/', $key) || !is_array($labels)) {
                throw new RuntimeException('Blog category keys must use lowercase letters, numbers, and hyphens.');
            }

            $catalog[$key] = [];
            foreach ($this->languages as $language) {
                $label = $labels[$language] ?? null;
                if (!is_string($label) || trim($label) === '') {
                    throw new RuntimeException("Category {$key} is missing the {$language} label.");
                }
                $catalog[$key][$language] = trim($label);
            }
        }

        return $this->categoryCache = $catalog;
    }

    /**
     * @return array<string, BlogPost>
     */
    private function postsForLanguage(string $language): array
    {
        if (isset($this->postCache[$language])) {
            return $this->postCache[$language];
        }

        $posts = [];
        $files = glob($this->contentDirectory . '/' . $language . '/*.md') ?: [];
        sort($files, SORT_STRING);

        foreach ($files as $path) {
            try {
                $post = $this->parseFile($path, $language);
                if (isset($posts[$post->slug])) {
                    throw new InvalidArgumentException("Duplicate blog slug: {$post->slug}");
                }
                $posts[$post->slug] = $post;
            } catch (Throwable $exception) {
                ($this->logger)('Skipping invalid blog post ' . basename($path) . ': ' . $exception->getMessage());
            }
        }

        return $this->postCache[$language] = $posts;
    }

    private function parseFile(string $path, string $folderLanguage): BlogPost
    {
        $source = file_get_contents($path);
        if ($source === false) {
            throw new InvalidArgumentException('Unable to read file.');
        }

        if (!preg_match('/\A---\R(.*?)\R---(?:\R|\z)(.*)\z/s', $source, $matches)) {
            throw new InvalidArgumentException('Front matter must be enclosed by --- markers.');
        }

        try {
            $metadata = Yaml::parse($matches[1]);
        } catch (ParseException $exception) {
            throw new InvalidArgumentException('Front matter contains invalid YAML.', 0, $exception);
        }

        if (!is_array($metadata)) {
            throw new InvalidArgumentException('Front matter must be a YAML map.');
        }

        $name = $this->requiredString($metadata, 'name');
        $cover = $this->requiredString($metadata, 'cover');
        $coverAlt = $this->requiredString($metadata, 'cover_alt');
        $slug = $this->requiredString($metadata, 'url');
        $description = $this->requiredString($metadata, 'seo_description');
        $language = $this->requiredString($metadata, 'language');
        $translation = $this->optionalString($metadata, 'translation');
        $author = $this->optionalString($metadata, 'author') ?? 'Sunny Casita';
        $date = $this->parseDate($metadata['date'] ?? null, 'date');
        $updated = isset($metadata['updated'])
            ? $this->parseDate($metadata['updated'], 'updated')
            : $date;
        $published = $metadata['published'] ?? null;
        $categories = $metadata['categories'] ?? null;
        $markdown = trim($matches[2]);

        if ($language !== $folderLanguage) {
            throw new InvalidArgumentException('The language metadata must match the containing folder.');
        }
        $this->assertLanguage($language);

        if (!preg_match('/\A[a-z0-9]+(?:-[a-z0-9]+)*\z/', $slug)) {
            throw new InvalidArgumentException('The url must be a lowercase hyphenated slug.');
        }
        if (basename($path, '.md') !== $slug) {
            throw new InvalidArgumentException('The filename must match the url metadata.');
        }
        if ($translation !== null && !preg_match('/\A[a-z0-9]+(?:-[a-z0-9]+)*\z/', $translation)) {
            throw new InvalidArgumentException('The translation must be a valid slug.');
        }
        if (!is_bool($published)) {
            throw new InvalidArgumentException('The published field must be true or false.');
        }
        if (!is_array($categories) || !array_is_list($categories)) {
            throw new InvalidArgumentException('The categories field must be a YAML list.');
        }

        $validCategories = [];
        $catalog = $this->categories();
        foreach ($categories as $category) {
            if (!is_string($category) || !isset($catalog[$category])) {
                throw new InvalidArgumentException('Every category must reference a catalog key.');
            }
            if (!in_array($category, $validCategories, true)) {
                $validCategories[] = $category;
            }
        }

        if (!preg_match('/\A[a-zA-Z0-9][a-zA-Z0-9._-]*\.(?:webp|avif|jpe?g|png)\z/i', $cover)) {
            throw new InvalidArgumentException('The cover must be a safe image filename.');
        }
        if (!is_file($this->coverDirectory . '/' . $cover)) {
            throw new InvalidArgumentException('The cover image does not exist.');
        }
        if ($markdown === '') {
            throw new InvalidArgumentException('The Markdown body cannot be empty.');
        }

        return new BlogPost(
            name: $name,
            cover: $cover,
            coverAlt: $coverAlt,
            slug: $slug,
            seoDescription: $description,
            language: $language,
            translation: $translation,
            date: $date,
            updated: $updated,
            published: $published,
            categories: $validCategories,
            author: $author,
            markdown: $markdown,
            sourcePath: $path,
        );
    }

    /**
     * @param array<array-key, mixed> $metadata
     */
    private function requiredString(array $metadata, string $key): string
    {
        $value = $metadata[$key] ?? null;
        if (!is_string($value) || trim($value) === '') {
            throw new InvalidArgumentException("The {$key} field is required.");
        }

        return trim($value);
    }

    /**
     * @param array<array-key, mixed> $metadata
     */
    private function optionalString(array $metadata, string $key): ?string
    {
        if (!isset($metadata[$key]) || $metadata[$key] === '') {
            return null;
        }
        if (!is_string($metadata[$key])) {
            throw new InvalidArgumentException("The {$key} field must be a string.");
        }

        return trim($metadata[$key]);
    }

    private function parseDate(mixed $value, string $field): DateTimeImmutable
    {
        if (is_int($value)) {
            return (new DateTimeImmutable('@' . $value))->setTimezone(new DateTimeZone('UTC'));
        }
        if ($value instanceof DateTimeInterface) {
            return DateTimeImmutable::createFromInterface($value)->setTimezone(new DateTimeZone('UTC'));
        }
        if (!is_string($value)) {
            throw new InvalidArgumentException("The {$field} field must use YYYY-MM-DD.");
        }

        $date = DateTimeImmutable::createFromFormat('!Y-m-d', $value, new DateTimeZone('UTC'));
        $errors = DateTimeImmutable::getLastErrors();
        if ($date === false || ($errors !== false && ($errors['warning_count'] > 0 || $errors['error_count'] > 0))) {
            throw new InvalidArgumentException("The {$field} field must use YYYY-MM-DD.");
        }

        return $date;
    }

    private function assertLanguage(string $language): void
    {
        if (!in_array($language, $this->languages, true)) {
            throw new InvalidArgumentException('Unsupported blog language.');
        }
    }
}
