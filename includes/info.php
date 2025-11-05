<?php

//-------------------------------------------//
// OBTENER PÁGINA ACTUAL Y PARÁMETROS
//-------------------------------------------//

$Actual_Page = !empty($_GET['p']) ? $_GET['p'] : '';
$Actual_Page_Lan = $Actual_Page ? '&p=' . $Actual_Page : '';
$Client_Page_Id = (empty($_GET['id'])) ? '' : '&id=' . $_GET['id'];
$Hide = ($Actual_Page === 'home' || $Actual_Page === '') ? '' : 'none';

//-------------------------//
// CLIENT
//-------------------------//

$Company_Name  = "Client";
$Company_Fullname = "Client full name";

//-------------------------//
// BONUSES
//-------------------------//

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

// $Register = "https://my.domain.com/register/$user_replica";
// $Login    = "https://my.domain.com/login";
$Register = "#";
$Login    = "#";

// ---------------------------
// Armar bloque HTML dinámico
// ---------------------------

$ref = isset($user_replica) ? "?ref=$user_replica" : '';

//-------------------------//
// VIDEO VIMEO
//-------------------------//

$Video_vimeo = "1112334525";

//-------------------------//
// MENU
//-------------------------//

$Menu = array(
  array('#home','active',$Menu_01),
  array('#odl','',$Menu_02),
  array('#experience','',$Menu_03),
  // array('?p=product&id=basic','',$Products_title_01)
  // array('','', $Menu_05)
);

//-------------------------//
// SUBMENU
//-------------------------//

$Sub = array(
  array($Menu_03, array(
    array($link_01, $Products_title_01, $Products_01),
    array($link_02, $Products_title_02, $Products_02)
  ))
);

$Sub_reg = array(
  array($Shop_us,'USA'),
  array($Shop_mx,'MEX'),
  array($Shop_in,'INT'),
  array($Shop_co,'COL'),
  array($Shop_eu,'EUR')
);

//-------------------------//
// CONDITIONS
//-------------------------//

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

//-------------------------//
// LOOPS
//-------------------------//

$sec01 = array(
  [
    'title' => $Journey_button_1,
    'text' => $Journey_text_1
  ],
  [
    'title' => $Journey_button_2,
    'text' => $Journey_text_2
  ],
  [
    'title' => $Journey_button_3,
    'text' => $Journey_text_3
  ],
  [
    'title' => $Journey_button_4,
    'text' => $Journey_text_4
  ]
);

$verticalSlides = array(
  [
    'id' => 1,
    'title' => $Letters_title_01,
    'text' => $Letters_text_01
  ],
  [
    'id' => 2,
    'title' => $Letters_title_02,
    'text' => $Letters_text_02
  ],
  [
    'id' => 3,
    'title' => $Letters_title_03,
    'text' => $Letters_text_03
  ],
  [
    'id' => 4,
    'title' => $Letters_title_04,
    'text' => $Letters_text_04
  ],
  [
    'id' => 5,
    'title' => $Letters_title_05,
    'text' => $Letters_text_05
  ]
);

$sec03 = array(
  [
    'id' => 1,
    'title' => $Vision_title_01,
    'text' => $Vision_text_01
  ],
  [
    'id' => 2,
    'title' => $Vision_title_02,
    'text' => $Vision_text_02
  ],
  [
    'id' => 3,
    'title' => $Vision_title_03,
    'text' => $Vision_text_03
  ],
  [
    'id' => 4,
    'title' => $Vision_title_04,
    'text' => $Vision_text_04
  ]
);

$Modal = array(
	array(
		$Products_title_01,
		$Products_sub_01,
		$Products_text_01
	)
);
$homeProducts = array(
  [
    'id' => 1,
    'number' => 'one',
    'link' => $link_01,
    'title' => $Products_title_01,
    'text' => $Products_text_01
  ],
  [
    'id' => 3,
    'number' => 'two',
    'link' => $link_02,
    'title' => $Products_title_02,
    'text' => $Products_text_02
  ],
  [
    'id' => 3,
    'number' => 'three',
    'link' => $link_03,
    'title' => $Products_title_03,
    'text' => $Products_text_03
  ],
  [
    'id' => 4,
    'number' => 'four',
    'link' => $link_04,
    'title' => $Products_title_04,
    'text' => $Products_text_04
  ]
);

$sec04 = array(
  [
    'title' => $Slogan_title_01,
    'text' => $Slogan_text_01
  ],
  [
    'title' => $Slogan_title_02,
    'text' => $Slogan_text_02
  ],
  [
    'title' => $Slogan_title_03,
    'text' => $Slogan_text_03
  ]
);

$sec07 = array(
  [
    'id' => 1,
    'title' => $Truth_title_01,
    'text' => $Truth_text_01
  ],
  [
    'id' => 2,
    'title' => $Truth_title_02,
    'text' => $Truth_text_02
  ],
  [
    'id' => 3,
    'title' => $Truth_title_03,
    'text' => $Truth_text_03
  ],
  [
    'id' => 4,
    'title' => $Truth_title_04,
    'text' => $Truth_text_04
  ],
  [
    'id' => 5,
    'title' => $Truth_title_05,
    'text' => $Truth_text_05
  ]
);

$sec08 = array(
  [
    'id' => 1,
    'small_img' => 'revive.webp',
    'name' => 'revive',
    'title'=> $Spirit_title_01,
    'list' => [$Spirit01_list_01,$Spirit01_list_02,$Spirit01_list_03,$Spirit01_list_04],
    'list_type' => 'ul'
  ],
  [
    'id' => 2,
    'small_img' => 'rejuvenate.webp',
    'name' => 'rejuvenate',
    'title'=> $Spirit_title_02,
    'list' => [$Spirit02_list_01,$Spirit02_list_02,$Spirit02_list_03,$Spirit02_list_04],
    'list_type' => 'ul'
  ],
  [
    'id' => 3,
    'small_img' => 'restore.webp',
    'name' => 'restore',
    'title'=> $Spirit_title_03,
    'list' => [$Spirit03_list_01,$Spirit03_list_02,$Spirit03_list_03,$Spirit03_list_04,$Spirit03_list_05,$Spirit03_list_06],
    'list_type' => 'ol'
  ],
);

$sec10 = array(
  [
    'year' => 2025,
    'text' => $Roadmap_text_2025
  ],
  [
    'year' => 2026,
    'text' => $Roadmap_text_2026
  ]
);

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
