<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\Attributes\Test;
use Services\SitemapService;

final class SitemapServiceTest extends BlogTestCase
{
    #[Test]
    public function it_includes_public_routes_and_published_translated_posts_only(): void
    {
        $this->writePost('en', 'english-post', ['translation' => 'articulo-espanol']);
        $this->writePost('es', 'articulo-espanol', ['translation' => 'english-post']);
        $this->writePost('en', 'draft-post', ['published' => false]);

        $xml = (new SitemapService($this->repository()))->generate('https://sunny.example');

        self::assertStringContainsString('<loc>https://sunny.example/blog</loc>', $xml);
        self::assertStringContainsString('https://sunny.example/blog/english-post', $xml);
        self::assertStringContainsString('https://sunny.example/es/blog/articulo-espanol', $xml);
        self::assertStringContainsString('hreflang="es"', $xml);
        self::assertStringNotContainsString('draft-post', $xml);
    }
}
