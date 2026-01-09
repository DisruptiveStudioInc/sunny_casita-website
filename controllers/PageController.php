<?php
namespace Controllers;

use Includes\Localization;

class PageController extends BaseController {

  private function setup($lang, $pageName) {
    $this->setLang($lang);
    Localization::setCurrentRoute($pageName);
  }

  public function home($lang) {
    $this->setup($lang, 'home');
    $data = $this->loadPageData('home_data.php');
    $this->view('home', $data);
  }

  public function about($lang) {
    $this->setup($lang, 'about');
    $data['page_title'] = $GLOBALS['Journey_title'];
    $this->view('about', $data);
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
    $dataPath = __DIR__ . "/../includes/pagesData/$path";
    if (file_exists($dataPath)) {
      // Extract global language variables into local scope BEFORE including
      extract($GLOBALS, EXTR_SKIP);
      include $dataPath;
    }

    $allVars = get_defined_vars();
    unset($allVars['path'], $allVars['vars'], $allVars['dataPath']);
    return $allVars;
  }
}
