<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Services\MarkdownRenderer;

final class MarkdownRendererTest extends TestCase
{
    #[Test]
    public function it_renders_gfm_and_removes_unsafe_html_and_links(): void
    {
        $markdown = "## Safe heading\n\n<script>alert('x')</script>\n\n"
            . "[Unsafe](javascript:alert('x'))\n\n| A | B |\n| - | - |\n| 1 | 2 |";

        $html = (new MarkdownRenderer())->render($markdown);

        self::assertStringContainsString('<h2>Safe heading</h2>', $html);
        self::assertStringContainsString('<table>', $html);
        self::assertStringNotContainsString('<script', $html);
        self::assertStringNotContainsString('javascript:', $html);
    }
}
