<?php

declare(strict_types=1);

namespace Controllers;

use Services\BlogRepository;
use Services\SitemapService;
use Throwable;

final class SitemapController
{
    public function index(): void
    {
        try {
            $root = dirname(__DIR__);
            $service = new SitemapService(
                new BlogRepository(
                    $root . '/content/blog',
                    $root . '/images/body/blog',
                ),
            );

            header('Content-Type: application/xml; charset=UTF-8');
            echo $service->generate($this->baseUrl());
        } catch (Throwable $exception) {
            error_log('Sitemap error: ' . $exception->getMessage());
            http_response_code(500);
            header('Content-Type: application/xml; charset=UTF-8');
            echo '<?xml version="1.0" encoding="UTF-8"?><error>Sitemap unavailable</error>';
        }
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
}
