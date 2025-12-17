<?php
namespace Controllers;

use Includes\Localization;

class ProductController extends BaseController {

  private function translateId($id, $lang) {
    return Localization::getCanonicalParam('product', $id, $lang);
  }

  public function show($lang, $id) {
    $this->setLang($lang);
    $realId = $this->translateId($id, $lang);

    if (!$realId) {
      $this->notFound();
      return;
    }

    $this->loadData($realId);
  }

  private function loadData($id) {
    // Legacy compatibility
    $_GET['p'] = 'product';
    $_GET['id'] = $id;

    Localization::setCurrentRoute('product', [$id]);

    $vars = $this->loadLegacyData();
    extract($vars);

    $dataPath = __DIR__ . '/../includes/pagesData/product_data.php';

    if (file_exists($dataPath)) {
      include $dataPath;
    }

    // Validate ID exists in productContent
    if (!isset($productContent) || !isset($productContent[$id])) {
      $this->notFound();
      return;
    }

    $this->view('product', [
      'product' => $productContent[$id],
      'productContent' => $productContent
    ]);
  }

  private function notFound() {
    http_response_code(404);
    include __DIR__ . '/../pages/404.inc.php';
  }
}
