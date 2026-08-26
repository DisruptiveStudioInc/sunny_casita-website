<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\Attributes\Test;

final class BlogRepositoryTest extends BlogTestCase
{
    #[Test]
    public function it_only_returns_published_non_future_posts_in_date_order(): void
    {
        $this->writePost('en', 'older-post', ['date' => '2026-08-10']);
        $this->writePost('en', 'newer-post', ['date' => '2026-08-25']);
        $this->writePost('en', 'draft-post', ['published' => false]);
        $this->writePost('en', 'future-post', ['date' => '2026-08-27']);

        $posts = $this->repository()->published('en');

        self::assertSame(['newer-post', 'older-post'], array_column($posts, 'slug'));
    }

    #[Test]
    public function it_skips_invalid_metadata_and_logs_the_reason(): void
    {
        $this->writePost('en', 'valid-post');
        $this->writePost('en', 'bad-category', ['categories' => ['unknown']]);
        $this->writePost('en', 'bad-cover', ['cover' => '../secret.webp']);
        $this->writePost('en', 'wrong-language', ['language' => 'es']);

        $posts = $this->repository()->published('en');

        self::assertCount(1, $posts);
        self::assertSame('valid-post', $posts[0]->slug);
        self::assertCount(3, $this->logs);
        self::assertStringContainsString('Skipping invalid blog post', $this->logs[0]);
    }

    #[Test]
    public function it_finds_posts_and_loads_localized_category_labels(): void
    {
        $this->writePost('es', 'guia-adus');

        $repository = $this->repository();
        $post = $repository->findPublished('es', 'guia-adus');

        self::assertNotNull($post);
        self::assertSame('guia-adus', $post->slug);
        self::assertSame('Financiamiento', $repository->categories()['financing']['es']);
        self::assertNull($repository->findPublished('es', '../guia-adus'));
    }
}
