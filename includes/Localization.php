<?php

namespace Includes;

class Localization {
  public static $lang = 'es';
  public static $currentRoute = 'home';
  public static $currentParams = [];

  // Unified Route Definition
  public static $routes = [
    'home' => [
      'languages' => [
        'es' => '/',
        'en' => '/en'
      ],
      'handler' => 'PageController@home'
    ],
    'about' => [
      'languages' => [
        'es' => '/nosotros',
        'en' => '/en/about'
      ],
      'handler' => 'PageController@about'
    ],
    'privacy' => [
      'languages' => [
        'es' => '/politica-de-privacidad',
        'en' => '/en/privacy-policy'
      ],
      'handler' => 'PageController@privacy'
    ],
    'terms' => [
      'languages' => [
        'es' => '/terminos-y-condiciones',
        'en' => '/en/terms-and-conditions'
      ],
      'handler' => 'PageController@terms'
    ],
    'product' => [
      'languages' => [
        'es' => '/producto/{id}',
        'en' => '/en/product/{id}'
      ],
      'handler' => 'ProductController@show'
    ]
  ];

  public static $slugMap = [
    'product' => [
      'inspiration' => ['es' => 'inspiracion', 'en' => 'inspiration'],
      'immersion' => ['es' => 'inmersion', 'en' => 'immersion'],
      'connection' => ['es' => 'conexion', 'en' => 'connection'],
      'essence' => ['es' => 'esencia', 'en' => 'essence']
    ]
  ];

  public static $legacyMap = [
    'es' => 'esp',
    'en' => 'eng'
  ];

  public static function detectLangFromUri($uri) {
    $configPath = __DIR__ . '/../config.php';
    $availableLangs = ['es', 'en']; // Fallback

    if (file_exists($configPath)) {
      $config = require $configPath;
      if (isset($config['available_langs'])) {
        $availableLangs = array_keys($config['available_langs']);
      }
    }

    foreach ($availableLangs as $lang) {
      if ($lang === 'es') continue;
      if (preg_match('#^/' . preg_quote($lang) . '(/|$)#', $uri)) {
        return $lang;
      }
    }

    // Default
    return 'es';
  }

  public static function setLang($lang) {
    self::$lang = $lang;
  }

  public static function getLang() {
    return self::$lang;
  }

  public static function getLegacyLang() {
    return self::$legacyMap[self::$lang] ?? 'esp';
  }

  public static function setCurrentRoute($key, $params = []) {
    self::$currentRoute = $key;
    self::$currentParams = $params;
  }

  public static function getCurrentUrl($lang) {
    $params = self::$currentParams;
    foreach ($params as $k => $v) {
      $params[$k] = self::translateParam(self::$currentRoute, $v, $lang);
    }
    return self::url(self::$currentRoute, $params, $lang);
  }

  public static function translateParam($routeKey, $value, $targetLang) {
    if (isset(self::$slugMap[$routeKey])) {
      if (isset(self::$slugMap[$routeKey][$value][$targetLang])) {
        return self::$slugMap[$routeKey][$value][$targetLang];
      }
    }
    return $value;
  }

  // Reverse translation: Slug -> Canonical
  public static function getCanonicalParam($routeKey, $slug, $sourceLang) {
    if (isset(self::$slugMap[$routeKey])) {
      foreach (self::$slugMap[$routeKey] as $canonical => $translations) {
        if (isset($translations[$sourceLang]) && $translations[$sourceLang] === $slug) {
          return $canonical;
        }
      }
    }
    return null;
  }

  public static function url($routeKey, $params = [], $lang = null) {
    $l = $lang ?? self::$lang;

    $path = self::$routes[$routeKey]['languages'][$l] ?? '/';

    if (!empty($params)) {
      foreach ($params as $param) {
        // Replace {id} or similar placeholders if they exist
        if (strpos($path, '{') !== false) {
          $path = preg_replace('/\{[^}]+\}/', $param, $path, 1);
        } else {
          // Fallback to append
          $path = rtrim($path, '/') . '/' . $param;
        }
      }
    }

    return $path;
  }
}
