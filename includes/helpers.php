<?php

declare(strict_types=1);

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function esc(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Return a cache-busted URL for a first-party asset.
 */
function assetUrl(string $path): string
{
    if ($path === '' || preg_match('#^(?:https?:)?//#', $path) === 1) {
        return $path;
    }

    $normalizedPath = '/' . ltrim($path, '/');
    $file = dirname(__DIR__) . $normalizedPath;

    if (!is_file($file)) {
        return $normalizedPath;
    }

    return $normalizedPath . '?v=' . filemtime($file);
}

function formatCurrency(int|float $number): string
{
    return number_format($number, 0, '.', ',');
}

function getConfig(string $key, mixed $default = null): mixed
{
    $config = require __DIR__ . '/../config.php';

    return $config[$key] ?? $default;
}
