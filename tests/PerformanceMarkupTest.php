<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

require_once dirname(__DIR__) . '/includes/helpers.php';

final class PerformanceMarkupTest extends TestCase
{
    public function testAssetUrlVersionsExistingFirstPartyAssets(): void
    {
        $url = assetUrl('/css/body/style.css');

        self::assertMatchesRegularExpression('#^/css/body/style\.css\?v=\d+$#', $url);
        self::assertSame('https://example.com/app.js', assetUrl('https://example.com/app.js'));
        self::assertSame('/missing.js', assetUrl('/missing.js'));
    }

    public function testSharedHeaderHasNoBlockingThirdPartyScripts(): void
    {
        $header = $this->source('includes/header.php');

        self::assertStringNotContainsString('code.jquery.com', $header);
        self::assertStringNotContainsString('three.min.js', $header);
        self::assertStringNotContainsString('fonts.googleapis.com', $header);
        self::assertStringContainsString("assetUrl('/dist/site.min.css')", $header);
    }

    public function testHomepageDoesNotRenderAnEagerVimeoIframe(): void
    {
        $home = $this->source('pages/home.inc.php');

        self::assertStringNotContainsString('src="https://player.vimeo.com', $home);
        self::assertStringContainsString('data-vimeo-id', $home);
        self::assertStringContainsString('js-vimeo-facade', $home);
        self::assertStringContainsString('fetchpriority="high"', $home);
        self::assertStringContainsString('srcset=', $home);
    }

    public function testPageScriptsAreDeferredAndVersioned(): void
    {
        $footer = $this->source('includes/footer.php');

        self::assertStringNotContainsString('lozad.min.js', $footer);
        self::assertStringContainsString('assetUrl((string) $script)', $footer);
        self::assertSame(2, substr_count($footer, ' defer'));
    }

    private function source(string $relativePath): string
    {
        $source = file_get_contents(dirname(__DIR__) . '/' . $relativePath);
        self::assertIsString($source);

        return $source;
    }
}
