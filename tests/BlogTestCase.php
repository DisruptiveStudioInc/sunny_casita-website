<?php

declare(strict_types=1);

namespace Tests;

use DateTimeImmutable;
use DateTimeZone;
use PHPUnit\Framework\TestCase;
use Services\BlogRepository;
use Symfony\Component\Yaml\Yaml;

abstract class BlogTestCase extends TestCase
{
    protected string $root;
    protected string $content;
    protected string $covers;

    /** @var list<string> */
    protected array $logs = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->root = sys_get_temp_dir() . '/sunny-blog-' . bin2hex(random_bytes(6));
        $this->content = $this->root . '/content';
        $this->covers = $this->root . '/covers';

        mkdir($this->content . '/en', 0777, true);
        mkdir($this->content . '/es', 0777, true);
        mkdir($this->covers, 0777, true);
        file_put_contents($this->covers . '/cover.webp', 'fixture');
        file_put_contents($this->content . '/categories.yaml', Yaml::dump([
            'categories' => [
                'adus' => ['en' => 'ADUs', 'es' => 'ADUs'],
                'financing' => ['en' => 'Financing', 'es' => 'Financiamiento'],
            ],
        ], 4));
    }

    protected function tearDown(): void
    {
        $this->removeDirectory($this->root);
        parent::tearDown();
    }

    protected function repository(): BlogRepository
    {
        return new BlogRepository(
            $this->content,
            $this->covers,
            ['en', 'es'],
            new DateTimeImmutable('2026-08-26', new DateTimeZone('UTC')),
            function (string $message): void {
                $this->logs[] = $message;
            },
        );
    }

    /**
     * @param array<string, mixed> $overrides
     */
    protected function writePost(string $language, string $slug, array $overrides = []): void
    {
        $metadata = array_replace([
            'name' => ucfirst(str_replace('-', ' ', $slug)),
            'cover' => 'cover.webp',
            'cover_alt' => 'A test cover',
            'url' => $slug,
            'seo_description' => 'A useful test article description.',
            'language' => $language,
            'date' => '2026-08-20',
            'published' => true,
            'categories' => ['adus'],
        ], $overrides);

        $source = "---\n"
            . Yaml::dump($metadata, 4)
            . "---\n\n"
            . "# Test article\n\nUseful content.\n";

        file_put_contents($this->content . '/' . $language . '/' . $slug . '.md', $source);
    }

    private function removeDirectory(string $directory): void
    {
        if (!is_dir($directory)) {
            return;
        }

        $items = scandir($directory) ?: [];
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }
            $path = $directory . '/' . $item;
            if (is_dir($path)) {
                $this->removeDirectory($path);
            } else {
                unlink($path);
            }
        }
        rmdir($directory);
    }
}
