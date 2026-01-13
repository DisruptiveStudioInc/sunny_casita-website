<?php
  use Includes\Localization;

  include("info.php");
  Localization::loadLanguage();
  $Description_Site = $GLOBALS['Soon_Text'];
  $Keywords_Site = $GLOBALS['Keywords_Site'];
  $Soon_Text = $GLOBALS['Soon_Text'];
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?= $Lang; ?>" xml:lang="<?= $Lang; ?>">

<head>

  <!-- X -->
  <meta name="twitter:card"        content="summary">
  <meta name="twitter:site"        content="<?= $Host_Site; ?>">
  <meta name="twitter:title"       content="<?= $company_name; ?>">
  <meta name="twitter:description" content="<?= $Description_Site; ?>">
  <meta name="twitter:creator"     content="<?= $company_name; ?>">
  <meta name="twitter:image"       content="<?= $Host_Site; ?>/images/facebook/facebook-temp.jpg">

  <!-- FACEBOOK -->
  <meta property="og:site_name"    content="<?= $company_name; ?>" />
  <meta property="og:url"          content="<?= $Host_Site; ?>" />
  <meta property="og:title"        content="<?= $company_name; ?>" />
  <meta property="og:type"         content="website" />
  <meta property="og:description"  content="<?= $Description_Site; ?>" />
  <meta property="og:image"        content="<?= $Host_Site; ?>/images/facebook/facebook-temp.jpg" />
  <meta property="og:image:width"  content="1024" />
  <meta property="og:image:height" content="538" />

  <!-- METAS-->
  <meta name="viewport"            content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Content-Type"  content="text/html; charset=UTF-8" />
  <meta name="description"         content="<?= $Description_Site; ?>" />
  <meta name="keywords"            content="<?= $Keywords_Site; ?>" />
  <meta name="autor"               content="<?= $company_name; ?>" />

  <title><?= $company_name; ?></title>

  <!-- STYLES-->
  <link rel="stylesheet" type="text/css" href="/css/min/reset.min.css" />
  <link rel="stylesheet" type="text/css" href="/css/min/main.min.css" />
  <link rel="stylesheet" type="text/css" href="/css/min/root.min.css" />

  <link rel="stylesheet" type="text/css" href="/css/body/style.min.css" />

  <!-- FAVICON -->
  <link rel="apple-touch-icon" sizes="57x57" href="/images/favicon/temp/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/images/favicon/temp/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/images/favicon/temp/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/temp/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/images/favicon/temp/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/images/favicon/temp/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/images/favicon/temp/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/images/favicon/temp/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/temp/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="/images/favicon/temp/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/temp/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="/images/favicon/temp/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/temp/favicon-16x16.png">
  <link rel="manifest" href="/images/favicon/temp/manifest.json">
  <meta name="msapplication-config" content="/images/favicon/temp/browserconfig.xml" />
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/images/favicon/temp/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <Link rel="shortcut icon" href="/images/favicon/temp/favicon.ico" />

</head>
<body id="page-content">
  <main class="rel d-flex jc-center ai-center of-h overlay o-30" style="min-height:100dvh;">
    <img src="/images/hero/soon.webp" alt="Placeholder" class="background" style="opacity:1" />
    <div class="d-flex fd-col ai-center rel p-20" style="z-index:10">
      <h1 class="h1-special t-c tc-0 m-0"><?= $Soon_Text ?></h1>
    </div>
  </main>
</body>
</html>
