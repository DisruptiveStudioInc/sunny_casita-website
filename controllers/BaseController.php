<?php

namespace Controllers;

use Includes\Localization;

class BaseController {
  protected $lang = 'es';

  public function __construct() {
    // Basic init if needed
  }

  protected function setLang($lang) {
    $this->lang = $lang;
    Localization::setLang($lang);

    // Legacy Compatibility
    $_SESSION['language'] = Localization::getLegacyLang();
  }

  protected function loadLegacyData() {
    // Load the language file essentially to define variables in current scope

    $langCode = Localization::getLegacyLang();
    $path = __DIR__ . "/../includes/idiomas/{$langCode}.php";

    if (file_exists($path)) {
      require $path;
      // Get all defined variables in this scope
      $vars = get_defined_vars();
      // Remove internal vars
      unset($vars['langCode'], $vars['path']);
      return $vars;
    }
    return [];
  }


  protected function view($viewName, $data = []) {
    // Expose variables to the view
    extract($data);

    // Expose helper variables
    $lang = $this->lang;

    // Make user_replica available in view scope
    $user_replica = $GLOBALS['user_replica'] ?? null;

    // Define views path
    $viewPath = __DIR__ . '/../pages/' . $viewName . '.inc.php';

    // Header
    include __DIR__ . '/../includes/header.php';

    if (file_exists($viewPath)) {
      include $viewPath;
    } else {
      include __DIR__ . '/../pages/404.inc.php';
    }

    // Footer
    include __DIR__ . '/../includes/footer.php';
  }
}
