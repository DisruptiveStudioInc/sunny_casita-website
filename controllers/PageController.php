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
    $data['float_button'] = true;
    $data['pagePreloadImage'] = [
      'href' => '/images/hero/hero-960.avif',
      'srcset' => '/images/hero/hero-640.avif 640w, /images/hero/hero-960.avif 960w, /images/hero/hero-1280.avif 1280w, /images/hero/hero-1920.avif 1920w',
      'sizes' => '100vw',
      'type' => 'image/avif',
    ];
    $data['pageScripts'] = ['/js/slider.js', '/js/home.js'];
    $this->view('home', $data);
  }

  public function join($lang) {
    $this->setup($lang, 'join');
     $data = $this->loadPageData('join_data.php');
    $data['page_title'] = $GLOBALS['PartOf_pageTitle'];
    $data['pageScripts'] = ['/js/forms.js'];
    $data['pagePreloadImage'] = [
      'href' => '/images/body/letters/2-960.webp',
      'srcset' => '/images/body/letters/2-640.webp 640w, /images/body/letters/2-960.webp 960w, /images/body/letters/2-1440.webp 1440w, /images/body/letters/2-1920.webp 1920w',
      'sizes' => '100vw',
      'type' => 'image/webp',
    ];
    $this->view('join', $data);
  }

  public function startnow($lang) {
    $this->setup($lang, 'startnow');
     $data = $this->loadPageData('startnow_data.php');
    $data['page_title'] = $GLOBALS['StartNow_pageTitle'];
    $data['pageScripts'] = ['/js/forms.js'];
    $this->view('startnow', $data);
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
