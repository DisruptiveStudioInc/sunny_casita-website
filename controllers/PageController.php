<?php
namespace Controllers;

use Includes\Localization;

class PageController extends BaseController {

  private function setup($lang, $pageName) {
    $this->setLang($lang);
    Localization::setCurrentRoute($pageName);
    // Legacy: header/info.php relies on $_GET['p'] for menu highlighting
    $_GET['p'] = $pageName;
  }

  public function home($lang) {
    $this->setup($lang, 'home');
    $data = $this->loadPageData('home_data.php');
    $this->view('home', $data);
  }

  public function about($lang) {
    $this->setup($lang, 'about');
    $this->view('about');
  }

  public function privacy($lang) {
    $this->setup($lang, 'privacy');
    $this->view('privacy_policy');
  }

  public function terms($lang) {
    $this->setup($lang, 'terms');
    $this->view('terms');
  }



  public function notFound() {
    http_response_code(404);
    include __DIR__ . '/../pages/404.inc.php';
  }

  private function loadPageData( $path ) {
    $vars = $this->loadLegacyData();

    extract($vars);

    $dataPath = __DIR__ . "/../includes/pagesData/$path";
    if (file_exists($dataPath)) {
      include $dataPath;
    }

    $allVars = get_defined_vars();
    unset($allVars['path'], $allVars['vars'], $allVars['dataPath']);
    return $allVars;
  }
}
