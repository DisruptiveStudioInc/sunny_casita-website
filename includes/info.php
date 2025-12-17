<?php

// Access the global user_replica variable
$user_replica = $GLOBALS['user_replica'] ?? null;

$Actual_Page = !empty($_GET['p']) ? $_GET['p'] : '';
$Actual_Page_Lan = $Actual_Page ? '&p=' . $Actual_Page : '';
$Client_Page_Id = (empty($_GET['id'])) ? '' : '&id=' . $_GET['id'];
$Hide = ($Actual_Page === 'home' || $Actual_Page === '') ? '' : 'none';

//-------------------------//
// CLIENT
//-------------------------//

$Company_Name  = "Client";
$Company_Fullname = "Client full name";

$Bonuses = array(
  'flash' => [
    'first_referal' => 700,
    'regular_referal' => 400
  ],
  'speed' => [
    'people' => 3,
    'initial_days' => 7,
    'amount' => 300
  ],
  'level' => array(
    [
      'level' => 1,
      'percentage' => 40
    ],
    [
      'level' => 2,
      'percentage' => 20
    ],
    [
      'level' => 3,
      'percentage' => 5
    ],
    [
      'level' => 4,
      'percentage' => 2
    ],
    [
      'level' => 5,
      'percentage' => 1
    ],
    [
      'level' => 6,
      'percentage' => 1
    ]
  ),
  'infinity' => [
    'people' => 300
  ]
);

//-------------------------//
// LANGUAGES
//-------------------------//

include("idiomas/idiomas.php");
$idioma = $_SESSION["language"];

//-------------------------//
// META
//-------------------------//

$Description_Site  = $Description;
$Keywords_Site     = $Keywords;

//-------------------------//
// GENERAL
//-------------------------//

$Host_Site      = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"];
$Footer_Rights  = $Company_Fullname." © ".date("Y").". All rights reserved.";

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

$Sub = array(
  array($Menu_03, array(
    array(\Includes\Localization::url('product', [$s_link_01]), $Products_title_01, $Products_01),
    array(\Includes\Localization::url('product', [$s_link_02]), $Products_title_02, $Products_02)
  ))
);

$Sub_reg = array(
  array($Shop_us,'USA'),
  array($Shop_mx,'MEX'),
  array($Shop_in,'INT'),
  array($Shop_co,'COL'),
  array($Shop_eu,'EUR')
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



$productBonuses = array(
  'flash' => [
    'title' => $Bonus_flash_title,
    'text_01' => $Bonus_flash_text01,
    'text_02' => $Bonus_flash_text02,
    'list' => [
      $Bonus_flash_list_01,
      $Bonus_flash_list_02
    ]
  ],
  'speed' => [
    'title' => $Bonus_speed_title,
    'text_01' => $Bonus_speed_text01,
    'text_02' => $Bonus_speed_text02,
    'list' => [
      $Bonus_speed_list_01,
      $Bonus_speed_list_02
    ]
  ],
  'level' => [
    'title' => $Bonus_level_title,
    'text_01' => $Bonus_level_text01,
    'text_02' => $Bonus_level_text02,
    'list' => $Bonuses['level'],
  ],
  'infinity' => [
    'title' => $Bonus_infinity_title,
    'text_01' => $Bonus_infinity_text01,
    'text_02' => $Bonus_infinity_text02,
    'list' => [
      $Bonus_infinity_list_01
    ]
  ],
  'rewards' => [
    'title' => $Bonus_rewards_title,
    'text_01' => $Bonus_rewards_text01,
    'text_02' => $Bonus_rewards_text02,
    'list' => [
      $Bonus_rewards_list_01
    ]
  ]
);
