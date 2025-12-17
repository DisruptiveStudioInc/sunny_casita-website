<?php

use Bramus\Router\Router;
use Includes\Localization;

$router = new Router();
$router->setNamespace('Controllers');

// Custom 404 Handler
$router->set404(function() {
  header('HTTP/1.1 404 Not Found');

  // Detect language from URL
  $uri = $_SERVER['REQUEST_URI'] ?? '/';
  $lang = Localization::detectLangFromUri($uri);

  // Set Language context
  Localization::setLang($lang);
  $_SESSION['language'] = Localization::getLegacyLang();

  include __DIR__ . '/header.php';
  include __DIR__ . '/../pages/404.inc.php';
  include __DIR__ . '/footer.php';
});

// Dynamic Route Registration
foreach (Localization::$routes as $key => $config) {
  $handler = $config['handler'];
  foreach ($config['languages'] as $lang => $path) {
    list($controllerName, $method) = explode('@', $handler);

    $router->get($path, function(...$params) use ($controllerName, $method, $lang) {
      $fullControllerName = "Controllers\\$controllerName";
      $controller = new $fullControllerName();
      // Inject language as the first argument, followed by route parameters
      call_user_func_array([$controller, $method], array_merge([$lang], $params));
    });
  }
}

$router->run();
