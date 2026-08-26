<?php

declare(strict_types=1);

namespace Models;

use DateTimeImmutable;

final readonly class BlogPost
{
    /**
     * @param list<string> $categories
     */
    public function __construct(
        public string $name,
        public string $cover,
        public string $coverAlt,
        public string $slug,
        public string $seoDescription,
        public string $language,
        public ?string $translation,
        public DateTimeImmutable $date,
        public DateTimeImmutable $updated,
        public bool $published,
        public array $categories,
        public string $author,
        public string $markdown,
        public string $sourcePath,
    ) {
    }

    public function isVisible(DateTimeImmutable $today): bool
    {
        return $this->published && $this->date <= $today;
    }

    public function coverUrl(): string
    {
        return '/images/body/blog/' . rawurlencode($this->cover);
    }
}
