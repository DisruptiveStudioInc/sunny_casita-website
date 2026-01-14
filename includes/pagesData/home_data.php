<?php

use Includes\Localization;

$Hero_vimeo = "1153774357";
$Video_vimeo = Localization::getLang() === 'es' ? '1153673650' : '1153670564';

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
    'text' => $Vision_01
  ],
  [
    'id' => 2,
    'text' => $Vision_02
  ],
  [
    'id' => 3,
    'text' => $Vision_03
  ],
  [
    'id' => 4,
    'text' => $Vision_04
  ]
);

$homeProducts = array(
  [
    'id' => 1,
    'number' => 'one',
    'background' => 'adus-bg.webp',
    'image' => Localization::getLang() === 'en' ? 'adus-en.webp' : 'adus.webp',
    'url' => Localization::url('product', ['adus']),
    'title' => $Product1_title,
    'text' => $Product1_text,
    'phrase' => $Product1_phrase,
    'list' => [
      $Product1_list1, $Product1_list2, $Product1_list3, $Product1_list4
    ]
  ],
  [
    'id' => 2,
    'number' => 'two',
    'background' => 'remodelaciones-bg.webp',
    'image' => Localization::getLang() === 'en' ? 'remodelaciones-en.webp' : 'remodelaciones.webp',
    'url' => Localization::url('product', ['adus']),
    'title' => $Product2_title,
    'text' => $Product2_text,
    'phrase' => $Product2_phrase,
    'list' => [
      $Product2_list1, $Product2_list2, $Product2_list3, $Product2_list4
    ]
  ],
  [
    'id' => 3,
    'number' => 'three',
    'background' => 'techos-bg.webp',
    'image' => Localization::getLang() === 'en' ? 'techos-en.webp' : 'techos.webp',
    'url' => Localization::url('product', ['adus']),
    'title' => $Product3_title,
    'text' => $Product3_text,
    'phrase' => $Product3_phrase,
    'list' => [
      $Product3_list1, $Product3_list2, $Product3_list3, $Product3_list4
    ]
  ],
  [
    'id' => 4,
    'number' => 'four',
    'background' => 'aires-bg.webp',
    'image' => Localization::getLang() === 'en' ? 'aires-en.webp' : 'aires.webp',
    'url' => Localization::url('product', ['adus']),
    'title' => $Product4_title,
    'text' => $Product4_text,
    'phrase' => $Product4_phrase,
    'list' => [
      $Product4_list1, $Product4_list2, $Product4_list3, $Product4_list4
    ]
  ],
  [
    'id' => 5,
    'number' => 'five',
    'background' => 'mejoras-bg.webp',
    'image' => Localization::getLang() === 'en' ? 'mejoras-en.webp' : 'mejoras.webp',
    'url' => Localization::url('product', ['adus']),
    'title' => $Product5_title,
    'text' => $Product5_text,
    'phrase' => $Product5_phrase,
    'list' => [
      $Product5_list1, $Product5_list2, $Product5_list3, $Product5_list4
    ]
  ]
);

$testimonials = array(
  [
    'id' => 1,
    'name' => 'María G.',
    'text' => $Testimonial1
  ],
  [
    'id' => 2,
    'name' => 'Carlos R.',
    'text' => $Testimonial2
  ],
  [
    'id' => 3,
    'name' => 'Ana P.',
    'text' => $Testimonial3
  ],
  [
    'id' => 4,
    'name' => 'José M.',
    'text' => $Testimonial4
  ],
  [
    'id' => 5,
    'name' => 'Laura T.',
    'text' => $Testimonial5
  ],
  [
    'id' => 6,
    'name' => 'Alexander H.',
    'text' => $Testimonial6
  ]
);

$sec07 = array(
  [
    'id' => 1,
    'image' => 'tranquilidad.webp',
    'title' => $Truth_title_01,
    'text' => $Truth_text_01
  ],
  [
    'id' => 2,
    'image' => 'claridad.webp',
    'title' => $Truth_title_02,
    'text' => $Truth_text_02
  ],
  [
    'id' => 3,
    'image' => 'acompanamiento.webp',
    'title' => $Truth_title_03,
    'text' => $Truth_text_03
  ],
  [
    'id' => 4,
    'image' => 'seguridad.webp',
    'title' => $Truth_title_04,
    'text' => $Truth_text_04
  ]
);

$sec08 = array(
  [
    'id' => 1,
    'image' => 'plano.webp',
    'small_img' => 'plano_circulo.webp',
    'name' => $Spirit_title_01,
    'title'=> $Spirit_title_01,
    'text'=> $Spirit_text_01
  ],
  [
    'id' => 2,
    'image' => 'preparacion.webp',
    'small_img' => 'preparacion_circulo.webp',
    'name' => $Spirit_title_02,
    'title'=> $Spirit_title_02,
    'text'=> $Spirit_text_02
  ],
  [
    'id' => 3,
    'image' => 'ejecucion.webp',
    'small_img' => 'ejecucion_circulo.webp',
    'name' => $Spirit_title_03,
    'title'=> $Spirit_title_03,
    'text'=> $Spirit_text_03
  ],
  [
    'id' => 4,
    'image' => 'entregar.webp',
    'small_img' => 'entregar_circulo.webp',
    'name' => $Spirit_title_04,
    'title'=> $Spirit_title_04,
    'text'=> $Spirit_text_04
  ]
);
