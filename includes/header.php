<?php
  include("info.php");
  $page_title = !empty($page_title) ? "$company_name | $page_title" : $company_name;
  $page_description = $page_description ?? $Description_Site;
  $page_keywords = $page_keywords ?? $Keywords_Site;
  $page_type = $page_type ?? 'website';
  $page_image = $page_image ?? '/images/facebook/facebook.jpg';
  $page_image_alt = $page_image_alt ?? $page_title;
  $requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
  $page_canonical_path = $page_canonical_path ?? (is_string($requestPath) ? $requestPath : '/');
  $page_url = preg_match('#^https?://#', $page_canonical_path)
    ? $page_canonical_path
    : $Host_Site . '/' . ltrim($page_canonical_path, '/');
  $page_image_url = preg_match('#^https?://#', $page_image)
    ? $page_image
    : $Host_Site . '/' . ltrim($page_image, '/');
  $languageUrls = $languageUrls ?? [];
  $absoluteLanguageUrls = [];
  foreach ($languageUrls as $languageCode => $languageUrl) {
    $absoluteLanguageUrls[$languageCode] = preg_match('#^https?://#', $languageUrl)
      ? $languageUrl
      : $Host_Site . '/' . ltrim($languageUrl, '/');
  }
  $availableLangs = getConfig('available_langs');
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?= e($Lang); ?>" xml:lang="<?= e($Lang); ?>">

<head>

  <meta name="twitter:card"        content="<?= $page_type === 'article' ? 'summary_large_image' : 'summary'; ?>">
  <meta name="twitter:site"        content="<?= e($Host_Site); ?>">
  <meta name="twitter:title"       content="<?= e($page_title); ?>">
  <meta name="twitter:description" content="<?= e($page_description); ?>">
  <meta name="twitter:creator"     content="<?= e($company_name); ?>">
  <meta name="twitter:image"       content="<?= e($page_image_url); ?>">
  <meta name="twitter:image:alt"   content="<?= e($page_image_alt); ?>">

  <meta property="og:site_name"    content="<?= e($company_name); ?>" />
  <meta property="og:url"          content="<?= e($page_url); ?>" />
  <meta property="og:title"        content="<?= e($page_title); ?>" />
  <meta property="og:type"         content="<?= e($page_type); ?>" />
  <meta property="og:description"  content="<?= e($page_description); ?>" />
  <meta property="og:image"        content="<?= e($page_image_url); ?>" />
  <meta property="og:image:alt"    content="<?= e($page_image_alt); ?>" />
  <meta property="og:image:width"  content="1200" />
  <meta property="og:image:height" content="675" />

  <meta name="viewport"            content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Content-Type"  content="text/html; charset=UTF-8" />
  <meta name="description"         content="<?= e($page_description); ?>" />
  <meta name="keywords"            content="<?= e($page_keywords); ?>" />
  <meta name="author"              content="<?= e($company_name); ?>" />
  <meta name="robots"              content="index, follow, max-image-preview:large" />
  <link rel="canonical" href="<?= e($page_url); ?>" />
  <?php foreach ($absoluteLanguageUrls as $languageCode => $languageUrl): ?>
    <link rel="alternate" hreflang="<?= e((string) $languageCode); ?>" href="<?= e((string) $languageUrl); ?>" />
  <?php endforeach; ?>
  <?php if (!empty($absoluteLanguageUrls)): ?>
    <link rel="alternate" hreflang="x-default" href="<?= e((string) ($absoluteLanguageUrls['en'] ?? reset($absoluteLanguageUrls))); ?>" />
  <?php endif; ?>

  <title><?= e($page_title); ?></title>

  <?php if (!empty($pagePreloadImage)): ?>
    <?php
      $preload = is_array($pagePreloadImage)
        ? $pagePreloadImage
        : ['href' => (string) $pagePreloadImage];
    ?>
    <link rel="preload" as="image" href="<?= e((string) $preload['href']); ?>"<?php if (!empty($preload['srcset'])): ?> imagesrcset="<?= e((string) $preload['srcset']); ?>"<?php endif; ?><?php if (!empty($preload['sizes'])): ?> imagesizes="<?= e((string) $preload['sizes']); ?>"<?php endif; ?><?php if (!empty($preload['type'])): ?> type="<?= e((string) $preload['type']); ?>"<?php endif; ?> fetchpriority="high">
  <?php endif; ?>

  <link rel="preload" href="/fonts/Inter-roman-latin.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="/fonts/Prompt-600-latin.woff2" as="font" type="font/woff2" crossorigin>

  <!-- STYLES-->
  <link rel="stylesheet" href="<?= e(assetUrl('/dist/site.min.css')); ?>">

  <!-- FAVICON -->
  <link rel="icon" type="image/svg+xml" href="/images/logo/favicon.svg">

</head>
<body id="page-content">
  <?php if(isset($float_button) && $float_button): ?>
    <div class="wrap-get small-w-100 small-p-20 small-pt-0 small-pb-0">
      <a href="<?= \Includes\Localization::url('startnow') ?>" class="btn-get tc-0"><?= $Btn_started; ?></a>
    </div>
  <?php endif; ?>

  <!-- ============================================== -->
  <!-- PRELOADER -->
  <!-- ============================================== -->

  <div id="preloader" aria-hidden="true">
    <div id="progress">
      <span id="data">0%</span>
    </div>
  </div>

  <!-- ============================================== -->
  <!-- NAVIGATION -->
  <!-- ============================================== -->

  <header>
    <nav class="nav">
      <div class="navigation">

        <div class="jc-center ai-center g-20">
          <div class="logo">
            <a href="<?= e(\Includes\Localization::url('home')); ?>"><img src="<?= e(assetUrl('/images/logo/logo.svg')); ?>" width="199" height="84" alt="<?= e($company_name); ?>"></a>
          </div>
          <div class="rel">
            <div class="btn-lan <?= strtolower($availableLangs[$Current_lang]); ?>"><?= $availableLangs[$Current_lang]; ?></div>
            <div class="lan">
              <?php
                foreach ($availableLangs as $langCode => $label) {
                  $activeClass = (\Includes\Localization::getLang() === $langCode) ? 'selected' : '';
                  $flag = strtolower($label);
                  $url = $languageUrls[$langCode] ?? \Includes\Localization::getCurrentUrl($langCode);
                  echo "<a class='$flag $activeClass' href='$url'>$label</a>";
                }
              ?>
            </div>
          </div>
        </div>

        <div class="menu">
          <ul>
            <?php
              $id = $_GET['id'] ?? '';
              foreach($Menu as $item):
                if(!$item['show']){ continue; }
            ?>
              <li class="<?= $item['hasSubmenu'] ? 'rel' : '' ?>">
                <a href="<?= $item['link'] ?>" class="<?= $item['hasSubmenu'] ? 'btn-sub no-chevron' : $item['status'] ?>"><?= $item['title'] ?></a>
                <?php if($item['hasSubmenu']): ?>
                  <ul class="sub">
                    <?php foreach($item['submenu'] as $subitem): ?>
                      <li>
                        <a href="<?= $subitem['link'] ?>"><?= $subitem['title'] ?><span><?= $subitem['slogan'] ?></span></a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>

            <div class="d-none med-d-block mt-20">
              <div class="mb-10">
                <a href="<?= $Login; ?>" target="_blank" class="btn c-pri br-30 small-w-100"><?= $Menu_log; ?></a>
              </div>
              <?php if($user_replica): ?>
                <div>
                  <a href="<?= $Register ?>" target="_blank" class="btn c-acc br-30 small-w-100"><?= $Menu_reg; ?></a>
                </div>
              <?php endif; ?>
            </div>
          </ul>
        </div>

        <div class="jc-center ai-center">
          <div class="btns m-0 g-10 med-d-none">
            <a href='<?= $Login; ?>' target="_blank" class="btn c-pri br-30"><?= $Menu_log; ?></a>
            <?php if($user_replica): ?>
              <a href='<?= $Register; ?>' target="_blank" class="btn c-acc br-30"><?= $Menu_reg; ?></a>
            <?php endif; ?>
          </div>
          <div class="hamburguer">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>

      </div>
    </nav>
  </header>

  <!-- ============================================== -->
  <!-- PAGE CONTENT -->
  <!-- ============================================== -->

  <main>
