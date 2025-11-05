<?php
  include("idiomas/idiomas.php");
  $idioma = $_SESSION["language"];
  include("info.php");
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo $Lang; ?>" xml:lang="<?php echo $Lang; ?>">

<head>

  <!-- X -->
  <meta name="twitter:card"        content="summary">
  <meta name="twitter:site"        content="<?php echo $Host_Site; ?>">
  <meta name="twitter:title"       content="<?php echo $Company_Name; ?>">
  <meta name="twitter:description" content="<?php echo $Description_Site; ?>">
  <meta name="twitter:creator"     content="<?php echo $Company_Name; ?>">
  <meta name="twitter:image"       content="<?php echo $Host_Site; ?>/images/facebook/facebook.webp">

  <!-- FACEBOOK -->
  <meta property="og:site_name"    content="<?php echo $Company_Name; ?>" />
  <meta property="og:url"          content="<?php echo $Host_Site; ?>" />
  <meta property="og:title"        content="<?php echo $Company_Name; ?>" />
  <meta property="og:type"         content="website" />
  <meta property="og:description"  content="<?php echo $Description_Site; ?>" />
  <meta property="og:image"        content="<?php echo $Host_Site; ?>/images/facebook/facebook.webp" />
  <meta property="og:image:width"  content="1024" />
  <meta property="og:image:height" content="538" />

  <!-- METAS-->
  <meta name="viewport"            content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Content-Type"  content="text/html; charset=UTF-8" />
  <meta name="description"         content="<?php echo $Description_Site; ?>" />
  <meta name="keywords"            content="<?php echo $Keywords_Site; ?>" />
  <meta name="autor"               content="<?php echo $Company_Name; ?>" />

  <title><?php echo $Company_Name; ?></title>

  <!-- STYLES-->
  <link rel="stylesheet" type="text/css" href="./css/min/reset.min.css" />
  <link rel="stylesheet" type="text/css" href="./css/min/main.min.css" />
  <link rel="stylesheet" type="text/css" href="./css/min/root.min.css" />

  <link rel="stylesheet" type="text/css" href="./css/body/style.min.css" />

  <!-- FAVICON -->
  <link rel="apple-touch-icon" sizes="57x57" href="./images/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="./images/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="./images/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="./images/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="./images/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="./images/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="./images/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="./images/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="./images/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="./images/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon/favicon-16x16.png">
  <link rel="manifest" href="./images/favicon/manifest.json">
  <meta name="msapplication-config" content="./images/favicon/browserconfig.xml" />
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="./images/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <Link rel="shortcut icon" href="./images/favicon/favicon.ico" />

</head>
<body id="page-content">
  <main class="rel d-flex jc-center ai-center of-h overlay o-30" style="min-height:100dvh;">
    <img src="./images/hero/hero.webp" alt="Placeholder" class="background" style="opacity:1" />
    <div class="d-flex fd-col ai-center rel p-20" style="z-index:10">
      <img src="./images/logo/logo.svg" alt="logo 5D" class="mb-60" style="width:min(50%,400px);">
      <h1 class="h1-special t-c m-0"><?= $Soon_Text ?></h1>
      <h2 class="h1 t-c mb-20"><?= $Soon_Description1 ?></h2>
      <p class="h3 t-c m-0"><?= $Soon_Description2 ?></p>
      <p class="h3 t-c"><?= $Soon_Description3 ?></p>
    </div>
  </main>
</body>
</html>
