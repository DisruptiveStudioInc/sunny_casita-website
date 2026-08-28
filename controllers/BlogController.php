<?php

declare(strict_types=1);

namespace Controllers;

use Includes\Localization;
use Models\BlogPost;
use Services\BlogRepository;
use Services\BlogService;
use Services\MarkdownRenderer;
use Throwable;

final class BlogController extends BaseController
{
    public function index(string $lang): void
    {
        $this->setLang($lang);
        Localization::setCurrentRoute('blog');

        $labels = $this->labels();
        $blogUrl = Localization::url('blog');
        $page = $this->queryPage();
        $category = $this->queryCategory();

        try {
            $service = $this->service();
            $listing = $service->listing($lang, $page, $category);
            $cards = array_map(
                fn(BlogPost $post): array => $this->card($service, $post),
                $listing['posts'],
            );
            $pageHref = $this->pageHrefBuilder($listing['selectedCategory'], $blogUrl);
            $canonicalPath = $pageHref($listing['currentPage']);

            $this->view('blog', [
                'page_title' => $labels['title'],
                'page_description' => $labels['description'],
                'page_canonical_path' => $canonicalPath,
                'languageUrls' => [
                    'en' => Localization::url('blog', [], 'en'),
                    'es' => Localization::url('blog', [], 'es'),
                ],
                'labels' => $labels,
                'blogUrl' => $blogUrl,
                'posts' => $cards,
                'totalPosts' => $listing['totalPosts'],
                'categories' => $listing['categories'],
                'selectedCategory' => $listing['selectedCategory'],
                'currentPage' => $listing['currentPage'],
                'totalPages' => $listing['totalPages'],
                'pages' => $listing['pages'],
                'pageHref' => $pageHref,
            ]);
        } catch (Throwable $exception) {
            error_log('Blog index error: ' . $exception->getMessage());
            $this->view('blog', [
                'page_title' => $labels['title'],
                'page_description' => $labels['description'],
                'page_canonical_path' => $blogUrl,
                'languageUrls' => [
                    'en' => Localization::url('blog', [], 'en'),
                    'es' => Localization::url('blog', [], 'es'),
                ],
                'labels' => $labels,
                'blogUrl' => $blogUrl,
                'posts' => [],
                'totalPosts' => 0,
                'categories' => [],
                'selectedCategory' => null,
                'currentPage' => 1,
                'totalPages' => 1,
                'pages' => [],
                'pageHref' => $this->pageHrefBuilder(null, $blogUrl),
                'error' => $labels['error'],
            ]);
        }
    }

    public function show(string $lang, string $slug): void
    {
        $this->setLang($lang);
        Localization::setCurrentRoute('blog_post', [$slug]);

        try {
            $service = $this->service();
            $post = $service->find($lang, $slug);
            if ($post === null) {
                $this->notFound();
                return;
            }

            $labels = $this->labels();
            $url = Localization::url('blog_post', [$post->slug], $lang);
            $languageUrls = $service->languageUrls($post);
            $categories = $service->categoryLabels($post);
            $related = array_map(
                fn(BlogPost $item): array => $this->card($service, $item),
                $service->related($post),
            );

            $this->view('blog-post', [
                'page_title' => $post->name,
                'page_description' => $post->seoDescription,
                'page_type' => 'article',
                'page_image' => $post->coverUrl(),
                'page_image_alt' => $post->coverAlt,
                'pagePreloadImage' => $post->coverUrl(),
                'page_canonical_path' => $url,
                'languageUrls' => $languageUrls,
                'labels' => $labels,
                'post' => [
                    'name' => $post->name,
                    'slug' => $post->slug,
                    'url' => $url,
                    'cover' => $post->coverUrl(),
                    'coverAlt' => $post->coverAlt,
                    'description' => $post->seoDescription,
                    'author' => $post->author,
                    'date' => $service->formatDate($post),
                    'dateRaw' => $post->date->format('Y-m-d'),
                    'updatedRaw' => $post->updated->format('Y-m-d'),
                    'content' => $service->render($post),
                    'categories' => $this->categoryLinks($post, $categories),
                ],
                'relatedPosts' => $related,
                'structuredData' => $this->structuredData($post, $categories, $url),
            ]);
        } catch (Throwable $exception) {
            error_log('Blog post error: ' . $exception->getMessage());
            $this->notFound();
        }
    }

    private function service(): BlogService
    {
        $root = dirname(__DIR__);

        return new BlogService(
            new BlogRepository(
                $root . '/content/blog',
                $root . '/images/body/blog',
            ),
            new MarkdownRenderer(),
        );
    }

    /**
     * @return array<string, string>
     */
    private function labels(): array
    {
        return [
            'title' => $this->globalLabel('Blog_title', 'Blog'),
            'description' => $this->globalLabel('Blog_description', ''),
            'all_posts' => $this->globalLabel('Blog_all_posts', 'All posts'),
            'categories' => $this->globalLabel('Blog_categories', 'Categories'),
            'empty' => $this->globalLabel('Blog_empty', 'There are no posts available yet.'),
            'error' => $this->globalLabel('Blog_error', 'The blog is unavailable right now.'),
            'read_more' => $this->globalLabel('Blog_read_more', 'Read article'),
            'previous' => $this->globalLabel('Blog_previous', 'Previous'),
            'next' => $this->globalLabel('Blog_next', 'Next'),
            'page' => $this->globalLabel('Blog_page', 'Page'),
            'related' => $this->globalLabel('Blog_related', 'Related articles'),
            'back' => $this->globalLabel('Blog_back', 'Back to blog'),
            'published' => $this->globalLabel('Blog_published', 'Published'),
            'by' => $this->globalLabel('Blog_by', 'By'),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function card(BlogService $service, BlogPost $post): array
    {
        $labels = $service->categoryLabels($post);

        return [
            'name' => $post->name,
            'url' => Localization::url('blog_post', [$post->slug], $post->language),
            'cover' => $post->coverUrl(),
            'coverAlt' => $post->coverAlt,
            'description' => $post->seoDescription,
            'date' => $service->formatDate($post),
            'dateRaw' => $post->date->format('Y-m-d'),
            'categories' => $this->categoryLinks($post, $labels),
        ];
    }

    /**
     * @param array<string, string> $labels
     * @return list<array{key: string, label: string, url: string}>
     */
    private function categoryLinks(BlogPost $post, array $labels): array
    {
        $links = [];
        foreach ($labels as $key => $label) {
            $links[] = [
                'key' => $key,
                'label' => $label,
                'url' => Localization::url('blog', [], $post->language)
                    . '?'
                    . http_build_query(['category' => $key]),
            ];
        }

        return $links;
    }

    private function queryPage(): int
    {
        $value = $_GET['page'] ?? 1;

        return is_scalar($value) ? max(1, (int) $value) : 1;
    }

    private function queryCategory(): ?string
    {
        $value = $_GET['category'] ?? null;
        if (!is_string($value) || !preg_match('/\A[a-z0-9]+(?:-[a-z0-9]+)*\z/', $value)) {
            return null;
        }

        return $value;
    }

    /**
     * @return callable(int): string
     */
    private function pageHrefBuilder(?string $category, string $blogUrl): callable
    {
        return static function (int $page) use ($category, $blogUrl): string {
            $query = [];
            if ($category !== null) {
                $query['category'] = $category;
            }
            if ($page > 1) {
                $query['page'] = $page;
            }

            return $blogUrl . ($query === [] ? '' : '?' . http_build_query($query));
        };
    }

    /**
     * @param array<string, string> $categories
     */
    private function structuredData(BlogPost $post, array $categories, string $path): string
    {
        $baseUrl = $this->baseUrl();
        $articleUrl = $baseUrl . $path;
        $imageUrl = $baseUrl . $post->coverUrl();

        $data = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'BlogPosting',
                    'headline' => $post->name,
                    'description' => $post->seoDescription,
                    'image' => $imageUrl,
                    'datePublished' => $post->date->format('Y-m-d'),
                    'dateModified' => $post->updated->format('Y-m-d'),
                    'inLanguage' => $post->language,
                    'articleSection' => array_values($categories),
                    'mainEntityOfPage' => $articleUrl,
                    'author' => [
                        '@type' => $post->author === 'Sunny Casita' ? 'Organization' : 'Person',
                        'name' => $post->author,
                    ],
                    'publisher' => [
                        '@type' => 'Organization',
                        'name' => 'Sunny Casita',
                        'logo' => [
                            '@type' => 'ImageObject',
                            'url' => $baseUrl . '/images/logo/logo.svg',
                        ],
                    ],
                ],
                [
                    '@type' => 'BreadcrumbList',
                    'itemListElement' => [
                        [
                            '@type' => 'ListItem',
                            'position' => 1,
                            'name' => $this->globalLabel('Menu_01', 'Home'),
                            'item' => $baseUrl . Localization::url('home'),
                        ],
                        [
                            '@type' => 'ListItem',
                            'position' => 2,
                            'name' => 'Blog',
                            'item' => $baseUrl . Localization::url('blog'),
                        ],
                        [
                            '@type' => 'ListItem',
                            'position' => 3,
                            'name' => $post->name,
                            'item' => $articleUrl,
                        ],
                    ],
                ],
            ],
        ];

        $json = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        return $json === false ? '' : $json;
    }

    private function globalLabel(string $key, string $fallback): string
    {
        $value = $GLOBALS[$key] ?? null;

        return is_string($value) ? $value : $fallback;
    }

    private function baseUrl(): string
    {
        $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https';
        $host = isset($_SERVER['HTTP_HOST']) && is_string($_SERVER['HTTP_HOST'])
            ? preg_replace('/[^a-zA-Z0-9.:-]/', '', $_SERVER['HTTP_HOST'])
            : 'localhost';

        return ($https ? 'https://' : 'http://') . ($host ?: 'localhost');
    }

    private function notFound(): void
    {
        http_response_code(404);
        $this->view('404', ['page_title' => '404']);
    }
}
