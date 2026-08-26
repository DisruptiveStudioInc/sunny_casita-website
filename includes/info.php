<?php

use Includes\Localization;

// Access the global user_replica variable
$user_replica = $GLOBALS['user_replica'] ?? null;

$Current_lang = Localization::getLang();
$Actual_Page = Localization::getCurrentRoute();

// Import language variables from globals
extract($GLOBALS, EXTR_SKIP);

//-------------------------//
// META
//-------------------------//

$Description_Site  = $Description;
$Keywords_Site     = $Keywords;

//-------------------------//
// GENERAL
//-------------------------//

$isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
  ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https';
$protocol = $isHttps ? "https" : "http";
$Host_Site = $protocol . "://" . $_SERVER["HTTP_HOST"];
$Footer_Rights  = $company_fullname." © 2025. All rights reserved.";

//-------------------------//
// LINKS
//-------------------------//

$Register = "https://my.sunnycasita.com/register/$user_replica";
$Login    = "https://my.sunnycasita.com/login";

$ref = isset($user_replica) ? "?ref=$user_replica" : '';

//-------------------------//
// MENU
//-------------------------//

$Menu = array(
  [
    'link' => ($Actual_Page === 'home') ? '#home' : Localization::url('home'),
    'status' => '',
    'title' => $Menu_01,
    'show' => true,
    'hasSubmenu' => false
  ],
  [
    'link' => '#sunny',
    'status' => '',
    'title' => $Menu_02,
    'show' => ($Actual_Page === 'home') ? true : false,
    'hasSubmenu' => false
  ],
  [
    'link' => '#solutions',
    'status' => '',
    'title' => $Menu_03,
    'show' => ($Actual_Page === 'home') ? true : false,
    'hasSubmenu' => false
  ],
  [
    'link' => Localization::url('blog'),
    'status' => in_array($Actual_Page, ['blog', 'blog_post'], true) ? 'active' : '',
    'title' => $Menu_05,
    'show' => true,
    'hasSubmenu' => false
  ],
  [
    'link' => Localization::url('join'),
    'status' => ($Actual_Page === 'join') ? 'active' : '',
    'title' => $Menu_04,
    'show' => true,
    'hasSubmenu' => false
  ]
);

$Footer_menu = array(
  'legal' => array(
    [
      // 'link' => Localization::url('privacy'),
      'link' => '#',
      'title' => $Footer_link_01
    ]
  )
);
