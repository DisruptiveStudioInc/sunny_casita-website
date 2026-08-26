<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\Attributes\Test;
use Services\BlogService;
use Services\MarkdownRenderer;

final class BlogServiceTest extends BlogTestCase
{
    #[Test]
    public function it_paginates_filters_and_counts_categories(): void
    {
        for ($day = 1; $day <= 10; $day++) {
            $this->writePost('en', 'post-' . $day, [
                'date' => sprintf('2026-08-%02d', $day),
                'categories' => $day <= 3 ? ['financing'] : ['adus'],
            ]);
        }

        $service = new BlogService($this->repository(), new MarkdownRenderer());
        $firstPage = $service->listing('en', 1, null);
        $secondPage = $service->listing('en', 2, null);
        $filtered = $service->listing('en', 1, 'financing');

        self::assertCount(8, $firstPage['posts']);
        self::assertCount(2, $secondPage['posts']);
        self::assertSame(2, $firstPage['totalPages']);
        self::assertCount(3, $filtered['posts']);
        self::assertSame('financing', $filtered['selectedCategory']);
        self::assertSame(3, $filtered['categories'][1]['count']);
    }

    #[Test]
    public function it_builds_translation_links_and_related_posts(): void
    {
        $this->writePost('en', 'english-post', [
            'translation' => 'articulo-espanol',
            'categories' => ['adus'],
        ]);
        $this->writePost('es', 'articulo-espanol', [
            'translation' => 'english-post',
            'categories' => ['adus'],
        ]);
        $this->writePost('en', 'related-post', ['categories' => ['adus']]);
        $this->writePost('en', 'unrelated-post', ['categories' => ['financing']]);

        $service = new BlogService($this->repository(), new MarkdownRenderer());
        $post = $service->find('en', 'english-post');

        self::assertNotNull($post);
        self::assertSame('/es/blog/articulo-espanol', $service->languageUrls($post)['es']);
        self::assertSame(['related-post'], array_column($service->related($post), 'slug'));
    }

    #[Test]
    public function missing_translation_falls_back_to_the_other_blog_index(): void
    {
        $this->writePost('en', 'english-only', ['translation' => 'missing-post']);

        $service = new BlogService($this->repository(), new MarkdownRenderer());
        $post = $service->find('en', 'english-only');

        self::assertNotNull($post);
        self::assertSame('/es/blog', $service->languageUrls($post)['es']);
    }
}
