<?php
  include("info.php");
  $page_title = ($page_title) ? "$company_name | $page_title" : $company_name;
  $page_description = $page_description ?? $Description_Site;
  $page_keywords = $page_keywords ?? $Keywords_Site;
  $page_type = $page_type ?? 'website';
  $availableLangs = getConfig('available_langs');
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?= $Lang; ?>" xml:lang="<?= $Lang; ?>">

<head>

  <meta name="twitter:card"        content="summary">
  <meta name="twitter:site"        content="<?= $Host_Site; ?>">
  <meta name="twitter:title"       content="<?= $page_title; ?>">
  <meta name="twitter:description" content="<?= $page_description; ?>">
  <meta name="twitter:creator"     content="<?= $company_name; ?>">
  <meta name="twitter:image"       content="<?= $Host_Site; ?>/images/facebook/facebook.jpg">

  <meta property="og:site_name"    content="<?= $company_name; ?>" />
  <meta property="og:url"          content="<?= $Host_Site; ?>" />
  <meta property="og:title"        content="<?= $page_title; ?>" />
  <meta property="og:type"         content="<?= $page_type; ?>" />
  <meta property="og:description"  content="<?= $page_description; ?>" />
  <meta property="og:image"        content="<?= $Host_Site; ?>/images/facebook/facebook.jpg" />
  <meta property="og:image:width"  content="1200" />
  <meta property="og:image:height" content="675" />

  <meta name="viewport"            content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Content-Type"  content="text/html; charset=UTF-8" />
  <meta name="description"         content="<?= $page_description; ?>" />
  <meta name="keywords"            content="<?= $page_keywords; ?>" />
  <meta name="autor"               content="<?= $company_name; ?>" />
  <link rel="canonical" href="<?= $Host_Site . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>" />

  <title><?= $page_title; ?></title>

  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,400..700;1,14..32,400..700&family=Prompt:wght@600;700&family=STIX+Two+Text:ital@1&display=swap" rel="stylesheet">

  <!-- STYLES-->
  <link rel="stylesheet" type="text/css" href="/css/min/reset.min.css" />
  <link rel="stylesheet" type="text/css" href="/css/min/main.min.css" />
  <link rel="stylesheet" type="text/css" href="/css/min/root.min.css" />

  <link rel="stylesheet" type="text/css" href="/css/body/style.min.css" />
  <link rel="stylesheet" type="text/css" href="/css/body/navigation.min.css" />
  <link rel="stylesheet" type="text/css" href="/css/body/slick.min.css" />

  <!-- FAVICON -->
  <link rel="icon" type="image/svg+xml" href="/images/logo/favicon.svg">

  <!-- jQuery y Slick -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

</head>
<body id="page-content">
  <?php if($user_replica): ?>
    <div class="wrap-get">
      <a href="<?= $Register; ?>" target="_blank" class="btn-get"><?= $Btn_started; ?></a>
    </div>
  <?php endif; ?>

  <!-- ============================================== -->
  <!-- PRELOADER -->
  <!-- ============================================== -->

  <div id="preloader">
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
            <a href="/"><img src="/images/logo/logo.svg" alt="<?= $company_name; ?>"></a>
          </div>
          <div class="rel">
            <div class="btn-lan <?= strtolower($availableLangs[$Current_lang]); ?>"><?= $availableLangs[$Current_lang]; ?></div>
            <div class="lan">
              <?php
                foreach ($availableLangs as $langCode => $label) {
                  $activeClass = (\Includes\Localization::getLang() === $langCode) ? 'selected' : '';
                  $flag = strtolower($label);
                  $url = \Includes\Localization::getCurrentUrl($langCode);
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
