<?php

function e(?string $value): string {
  return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function esc(?string $value): string {
  return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function formatCurrency($number) {
  return number_format($number, 0, '.', ',');
}

function getConfig($key, $default = null) {
  $config = require __DIR__ . '/../config.php';
  return $config[$key] ?? $default;
}
