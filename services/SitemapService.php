<?php

declare(strict_types=1);

namespace Services;

use Includes\Localization;
use Models\BlogPost;

final readonly class SitemapService
{
    public function __construct(private BlogRepository $repository)
    {
    }

    public function generate(string $baseUrl): string
    {
        $baseUrl = rtrim($baseUrl, '/');
        $entries = [];

        foreach (['home', 'join', 'startnow', 'privacy', 'terms', 'blog'] as $route) {
            $alternates = [
                'en' => $baseUrl . Localization::url($route, [], 'en'),
                'es' => $baseUrl . Localization::url($route, [], 'es'),
            ];
            foreach ($alternates as $language => $url) {
                $entries[] = [
                    'loc' => $url,
                    'lastmod' => null,
                    'alternates' => $alternates,
                    'language' => $language,
                ];
            }
        }

        foreach (['inspiration', 'immersion'] as $product) {
            $alternates = [];
            foreach (['en', 'es'] as $language) {
                $slug = Localization::$slugMap['product'][$product][$language];
                $alternates[$language] = $baseUrl . Localization::url('product', [$slug], $language);
            }
            foreach ($alternates as $language => $url) {
                $entries[] = [
                    'loc' => $url,
                    'lastmod' => null,
                    'alternates' => $alternates,
                    'language' => $language,
                ];
            }
        }

        $posts = $this->repository->allPublished();
        foreach ($posts as $post) {
            $alternates = $this->postAlternates($post, $posts, $baseUrl);
            $entries[] = [
                'loc' => $baseUrl . Localization::url('blog_post', [$post->slug], $post->language),
                'lastmod' => $post->updated->format('Y-m-d'),
                'alternates' => $alternates,
                'language' => $post->language,
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" ';
        $xml .= 'xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";

        foreach ($entries as $entry) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>' . $this->xml((string) $entry['loc']) . "</loc>\n";
            if (is_string($entry['lastmod'])) {
                $xml .= '    <lastmod>' . $this->xml($entry['lastmod']) . "</lastmod>\n";
            }
            foreach ($entry['alternates'] as $language => $url) {
                $xml .= '    <xhtml:link rel="alternate" hreflang="'
                    . $this->xml((string) $language)
                    . '" href="'
                    . $this->xml((string) $url)
                    . '" />'
                    . "\n";
            }
            $default = $entry['alternates']['en'] ?? $entry['loc'];
            $xml .= '    <xhtml:link rel="alternate" hreflang="x-default" href="'
                . $this->xml((string) $default)
                . '" />'
                . "\n";
            $xml .= "  </url>\n";
        }

        return $xml . '</urlset>';
    }

    /**
     * @param list<BlogPost> $posts
     * @return array<string, string>
     */
    private function postAlternates(BlogPost $post, array $posts, string $baseUrl): array
    {
        $alternates = [
            $post->language => $baseUrl
                . Localization::url('blog_post', [$post->slug], $post->language),
        ];

        if ($post->translation === null) {
            return $alternates;
        }

        $otherLanguage = $post->language === 'en' ? 'es' : 'en';
        foreach ($posts as $candidate) {
            if ($candidate->language === $otherLanguage && $candidate->slug === $post->translation) {
                $alternates[$otherLanguage] = $baseUrl
                    . Localization::url('blog_post', [$candidate->slug], $otherLanguage);
                break;
            }
        }

        return $alternates;
    }

    private function xml(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_XML1, 'UTF-8');
    }
}
