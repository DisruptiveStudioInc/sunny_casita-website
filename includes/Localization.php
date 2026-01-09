<?php

namespace Includes;

class Localization {
  public static $lang = 'es';
  public static $currentRoute = 'home';
  public static $currentParams = [];
  private static $langLoaded = false;

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
      if ($lang === $config['default_lang']) continue;
      if (preg_match('#^/' . preg_quote($lang) . '(/|$)#', $uri)) {
        return $lang;
      }
    }

    // Default
    return $config['default_lang'] ?? 'es';
  }

  public static function setLang($lang) {
    self::$lang = $lang;
  }

  public static function getLang() {
    return self::$lang;
  }

  public static function loadLanguage() {
    if (self::$langLoaded) {
      return; // Already loaded
    }

    $langMap = [
      'es' => 'esp.php',
      'en' => 'eng.php'
    ];

    $langFile = $langMap[self::$lang] ?? 'esp.php';
    $langPath = __DIR__ . '/languages/' . $langFile;

    if (file_exists($langPath)) {
      self::includeInGlobalScope($langPath);
      self::$langLoaded = true;
    }
  }

  private static function includeInGlobalScope($filePath) {
    // Extract current globals so they're available in the included file
    extract($GLOBALS, EXTR_REFS | EXTR_SKIP);

    // Include the file - variables will be created in this function's scope
    include $filePath;

    // Get all newly defined variables and push them to global scope
    $vars = get_defined_vars();
    unset($vars['filePath'], $vars['GLOBALS']);

    foreach ($vars as $key => $value) {
      $GLOBALS[$key] = $value;
    }
  }

  public static function setCurrentRoute($key, $params = []) {
    self::$currentRoute = $key;
    self::$currentParams = $params;
  }

  public static function getCurrentRoute() {
    return self::$currentRoute;
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
