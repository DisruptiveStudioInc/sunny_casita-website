<?php

declare(strict_types=1);

namespace Services;

use Includes\Localization;
use Models\BlogPost;

final readonly class BlogService
{
    public function __construct(
        private BlogRepository $repository,
        private MarkdownRenderer $renderer,
        private int $postsPerPage = 8,
    ) {
    }

    /**
     * @return array{
     *   posts: list<BlogPost>,
     *   totalPosts: int,
     *   categories: list<array{key: string, label: string, count: int}>,
     *   selectedCategory: ?string,
     *   currentPage: int,
     *   totalPages: int,
     *   pages: list<int|string>
     * }
     */
    public function listing(string $language, int $requestedPage, ?string $requestedCategory): array
    {
        $catalog = $this->repository->categories();
        $category = $requestedCategory !== null && isset($catalog[$requestedCategory])
            ? $requestedCategory
            : null;
        $allPosts = $this->repository->published($language);

        $counts = [];
        foreach ($allPosts as $post) {
            foreach ($post->categories as $key) {
                $counts[$key] = ($counts[$key] ?? 0) + 1;
            }
        }

        $categories = [];
        foreach ($catalog as $key => $labels) {
            $count = $counts[$key] ?? 0;
            if ($count > 0) {
                $categories[] = [
                    'key' => $key,
                    'label' => $labels[$language],
                    'count' => $count,
                ];
            }
        }

        $filtered = $category === null
            ? $allPosts
            : array_values(array_filter(
                $allPosts,
                static fn(BlogPost $post): bool => in_array($category, $post->categories, true),
            ));

        $totalPages = max(1, (int) ceil(count($filtered) / $this->postsPerPage));
        $currentPage = min(max(1, $requestedPage), $totalPages);
        $posts = array_slice($filtered, ($currentPage - 1) * $this->postsPerPage, $this->postsPerPage);

        return [
            'posts' => $posts,
            'totalPosts' => count($allPosts),
            'categories' => $categories,
            'selectedCategory' => $category,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'pages' => $this->pageNumbers($currentPage, $totalPages),
        ];
    }

    public function find(string $language, string $slug): ?BlogPost
    {
        return $this->repository->findPublished($language, $slug);
    }

    public function render(BlogPost $post): string
    {
        return $this->renderer->render($post->markdown);
    }

    /**
     * @return list<BlogPost>
     */
    public function related(BlogPost $post, int $limit = 3): array
    {
        if ($post->categories === []) {
            return [];
        }

        $related = array_filter(
            $this->repository->published($post->language),
            static fn(BlogPost $candidate): bool =>
                $candidate->slug !== $post->slug
                && array_intersect($post->categories, $candidate->categories) !== [],
        );

        return array_slice(array_values($related), 0, $limit);
    }

    /**
     * @return array<string, string>
     */
    public function languageUrls(BlogPost $post): array
    {
        $otherLanguage = $post->language === 'en' ? 'es' : 'en';

        $urls = [
            'en' => Localization::url('blog', [], 'en'),
            'es' => Localization::url('blog', [], 'es'),
            $post->language => Localization::url('blog_post', [$post->slug], $post->language),
        ];

        if ($post->translation !== null) {
            $translation = $this->repository->findPublished($otherLanguage, $post->translation);
            if ($translation !== null) {
                $urls[$otherLanguage] = Localization::url(
                    'blog_post',
                    [$translation->slug],
                    $otherLanguage,
                );
            }
        }

        return $urls;
    }

    /**
     * @return array<string, string>
     */
    public function categoryLabels(BlogPost $post): array
    {
        $catalog = $this->repository->categories();
        $labels = [];
        foreach ($post->categories as $key) {
            $labels[$key] = $catalog[$key][$post->language];
        }

        return $labels;
    }

    public function formatDate(BlogPost $post): string
    {
        if ($post->language === 'es') {
            $months = [
                1 => 'enero',
                2 => 'febrero',
                3 => 'marzo',
                4 => 'abril',
                5 => 'mayo',
                6 => 'junio',
                7 => 'julio',
                8 => 'agosto',
                9 => 'septiembre',
                10 => 'octubre',
                11 => 'noviembre',
                12 => 'diciembre',
            ];

            return $post->date->format('j')
                . ' de '
                . $months[(int) $post->date->format('n')]
                . ' de '
                . $post->date->format('Y');
        }

        return $post->date->format('F j, Y');
    }

    /**
     * @return list<int|string>
     */
    private function pageNumbers(int $current, int $total): array
    {
        if ($total <= 1) {
            return [];
        }

        $pages = [1];
        $start = max(2, $current - 2);
        $end = min($total - 1, $current + 2);

        if ($start > 2) {
            $pages[] = '…';
        }
        for ($page = $start; $page <= $end; $page++) {
            $pages[] = $page;
        }
        if ($end < $total - 1) {
            $pages[] = '…';
        }
        $pages[] = $total;

        return $pages;
    }
}
