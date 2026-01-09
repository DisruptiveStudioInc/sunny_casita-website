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
$Footer_Rights  = $company_fullname." © ".date("Y").". All rights reserved.";

//-------------------------//
// LINKS
//-------------------------//

$link_01 = "inspiration";
$link_02 = "immersion";
$link_03 = "connection";
$link_04 = "essence";

$slugMap = [
    'inspiration' => ['es' => 'inspiracion', 'en' => 'inspiration'],
    'immersion' => ['es' => 'inmersion', 'en' => 'immersion'],
    'connection' => ['es' => 'conexion', 'en' => 'connection'],
    'essence' => ['es' => 'esencia', 'en' => 'essence']
];

$l = \Includes\Localization::getLang();
$s_link_01 = $slugMap[$link_01][$l] ?? $link_01;
$s_link_02 = $slugMap[$link_02][$l] ?? $link_02;
$s_link_03 = $slugMap[$link_03][$l] ?? $link_03;
$s_link_04 = $slugMap[$link_04][$l] ?? $link_04;

// $Register = "https://my.domain.com/register/$user_replica";
// $Login    = "https://my.domain.com/login";
$Register = "#";
$Login    = "#";

$ref = isset($user_replica) ? "?ref=$user_replica" : '';

//-------------------------//
// MENU
//-------------------------//

$Menu = array(
  [
    'link' => ($Actual_Page === 'home' || $Actual_Page === '') ? '#home' : \Includes\Localization::url('home'),
    'status' => ($Actual_Page === 'home' || $Actual_Page === '') ? 'active' : '',
    'title' => $Menu_01,
    'show' => true,
    'hasSubmenu' => false
  ],
  [
    'link' => '#odl',
    'status' => '',
    'title' => $Menu_02,
    'show' => ($Actual_Page === 'home' || $Actual_Page === '') ? true : false,
    'hasSubmenu' => false
  ],
  [
    'link' => '#experience',
    'status' => ($Actual_Page === 'experience') ? 'active' : '',
    'title' => $Menu_03,
    'show' => ($Actual_Page === 'home' || $Actual_Page === '') ? true : false,
    'hasSubmenu' => false
  ],
  [
    'link' => '#',
    'status' => '',
    'title' => $Menu_04,
    'show' => true,
    'hasSubmenu' => true,
    'submenu' => array(
      [
        'link' => \Includes\Localization::url('product', [$s_link_01]), // Use translated slug
        'title' => $Products_title_01,
        'slogan' => $Products_01
      ],
      [
        'link' => \Includes\Localization::url('product', [$s_link_02]),
        'title' => $Products_title_02,
        'slogan' => $Products_02
      ]
    )
  ]
);

$idiomas = [
  'eng' => 'Eng',
  'esp' => 'Esp'
];

$Condicion_lan = isset($idiomas[$idioma]) ? $idiomas[$idioma] : 'Desconocido';

//-------------------------//
// CONTACT
//-------------------------//

$Email = "client@gmail.com";
// $Schedule = "Mon-Fri: 9 am– 6 pm<br>Saturday: 9 am – 2pm<br>Sunday: Closed";
// $Phone = "(888) 456 7890";
// $Address = "Blvd. Kukulcan 1,<br>Puerto Juarez,<br>Zona Hotelera,<br>77500 Cancún, Q.R. México";
