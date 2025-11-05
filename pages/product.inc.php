<!-- ============================================== -->
<!-- ONE -->
<!-- ============================================== -->
<?php

$Subtitulo_map = [
    $link_01     => $Products_title_01,
    $link_02     => $Products_title_02
];

$Text_map = [
    $link_01     => $Products_text_inner_01,
    $link_02     => $Products_text_inner_02
];

$Text_price = [
    $link_01     => $Products_price_01,
    $link_02     => $Products_price_02
];

$Ingredients_map = [
    $link_01     => $Ingredients_01,
    $link_02     => $Ingredients_02
];

$Ingredients_list_map = [
    $link_01 => [
        $Ingredients_01_01, $Ingredients_01_02, $Ingredients_01_03,
        $Ingredients_01_04, $Ingredients_01_05, $Ingredients_01_06
    ],
    $link_02 => [
        $Ingredients_02_01, $Ingredients_02_02, $Ingredients_02_03,
        $Ingredients_02_04, $Ingredients_02_05, $Ingredients_02_06
    ]
];

$Benefits_list_map = [
    $link_01 => [
        $Benefits_01_tit_01, $Benefits_01_01, $Benefits_01_02, $Benefits_01_03, $Benefits_01_04
    ],
    $link_02 => [
        $Benefits_02_tit_01, $Benefits_02_01, $Benefits_02_02, $Benefits_02_03, $Benefits_02_04, $Benefits_02_05
    ]
];

$Benefits_sub_map = [
    $link_01    => $Benefits_sub_01,
    $link_02    => $Benefits_sub_02
];

$Benefits_sub_texts = [
    $link_01    => $Benefits_sub_p_01,
    $link_02    => $Benefits_sub_p_02
];

$Benefits_titles_map = [
    $link_01 => [$Benefits_01_tit_01, $Benefits_01_tit_02, $Benefits_01_tit_03, $Benefits_01_tit_04],
    $link_02 => [$Benefits_02_tit_01, $Benefits_02_tit_02, $Benefits_02_tit_03, $Benefits_02_tit_04, $Benefits_02_tit_05]
];

$Started_title_map = [
    $link_01 => $Satarted_title_01,
    $link_02 => $Satarted_title_02
];

$Started_sub_map = [
    $link_01 => $Satarted_sub_01,
    $link_02 => $Satarted_sub_02
];

$Started_sub_tit = [
    $link_01 => $Satarted_title_01_01,
    $link_02 => $Satarted_title_02_01
];


$Started_list_map = [
    $link_01 => [$Satarted_list_01_01, $Satarted_list_02_01, $Satarted_list_03_01, $Satarted_list_04_01, $Satarted_list_05_01],
    $link_02 => [$Satarted_list_01_02, $Satarted_list_02_02, $Satarted_list_03_02, $Satarted_list_04_02, $Satarted_list_05_02]
];

$Started_sub_footnote = [
    $link_01 => $Satarted_footnote_01,
    $link_02 => $Satarted_footnote_02
];

$Started_plans_tit = [
  $link_01 => $Satarted_title_plans_01,
  $link_02 => $Satarted_title_plans_02
];

$Started_plans_map = [
    $link_01 => [$Satarted_plans_list_01_01, $Satarted_plans_list_02_01, $Satarted_plans_list_03_01, $Satarted_plans_list_04_01, $Satarted_plans_list_05_01, $Satarted_plans_list_06_01, $Satarted_plans_list_07_01],
    $link_02 => [$Satarted_plans_list_01_02, $Satarted_plans_list_02_02, $Satarted_plans_list_03_02, $Satarted_plans_list_04_02, $Satarted_plans_list_05_02, $Satarted_plans_list_06_02, $Satarted_plans_list_07_02]
];

$Started_plans_texts_map = [
  $link_01 => [$Satarted_plans_text_01_01, $Satarted_plans_text_01_02],
  $link_02 => [$Satarted_plans_text_02_01, $Satarted_plans_text_02_02]
];

$Started_bonuses_title = [
  $link_01 => $Satarted_title_bonus_01,
  $link_02 => $Satarted_title_bonus_02
];

$Started_bonuses_map = [
  $link_01 => [$Satarted_bonus_text_01_01, $Satarted_bonus_text_02_01, $Satarted_bonus_text_03_01, $Satarted_bonus_text_04_01],
  $link_02 => [$Satarted_bonus_text_01_02, $Satarted_bonus_text_02_02, $Satarted_bonus_text_03_02, $Satarted_bonus_text_04_02]
];

$Started_bonuses_footnote = [
  $link_01 => $Satarted_bonus_footnote_01,
  $link_02 => $Satarted_bonus_footnote_02
];

$Started_link_map = [
    $link_01 => [
        $Satarted_title_link_01_01,
        $Satarted_title_link_01_02,
        $Satarted_title_link_01_03,
        $Satarted_title_link_01_04
    ],
    $link_02 => [
        $Satarted_title_link_02_01,
        $Satarted_title_link_02_02,
        $Satarted_title_link_02_03,
        $Satarted_title_link_02_04
    ]
];

$Started_subpage_map = [
    $link_01 => $Satarted_subpage_01,
    $link_02 => $Satarted_subpage_02
];

// ====================
// ASIGNACIÓN SEGURA
// ====================
$Subtitulo          = $Subtitulo_map[$id]            ?? "";
$Text               = $Text_map[$id]                 ?? "";
$Price              = $Text_price[$id]               ?? "";
$Ingredients        = $Ingredients_map[$id]          ?? "";
$Ingredients_list   = $Ingredients_list_map[$id]     ?? [];
$Benefits_Sub       = $Benefits_sub_map[$id]         ?? "";
$Benefits_Text      = $Benefits_sub_texts[$id]       ?? "";
$Benefits_list      = $Benefits_list_map[$id]        ?? [];
$Benefits_titles    = $Benefits_titles_map[$id]      ?? [];
$Started_title      = $Started_title_map[$id]        ?? "";
$Started_sub        = $Started_sub_map[$id]          ?? "";
$Started_tit        = $Started_sub_tit[$id]          ?? "";
$Started_list       = $Started_list_map[$id]         ?? [];
$Started_list_foot  = $Started_sub_footnote[$id]     ?? "";
$Started_plan_tit   = $Started_plans_tit[$id]        ?? "";
$Started_plans      = $Started_plans_map[$id]        ?? [];
$Started_plan_txt   = $Started_plans_texts_map[$id]  ?? [];
$Started_bonus_tit  = $Started_bonuses_title[$id]    ?? "";
$Started_bonuses    = $Started_bonuses_map[$id]      ?? [];
$Started_bonus_foot = $Started_bonuses_footnote[$id] ?? "";
$Started_subpage    = $Started_subpage_map[$id]      ?? "";

$Condicion =($id == $link_01 || $id == $link_02)? 'tc-100':'';

?>

<section>
    <div class="block-box-bg overlay o-70">
        <div class="mw-1440 jc-center ai-center dh-100 small-fd-col-rev g-20 p-30">

            <div class="info w-60 med-w-100 all-tc-0 small-t-c">
                <h1 class="h1-special"><?php echo $Subtitulo; ?></h1>
                <p class="small-d-none"><?php echo $Text; ?></p>
                <p class="h3"><?php echo $Price; ?></p>

                <div class="btns g-10 small-jc-center">
                    <?php
                    $wrap_product = "<div class='wrap-get subpage'>
                      <div class='btn-get'>{$Btn_buy}</div>
                      <div class='get'>";

                    foreach ($links_product as $link) {
                        $wrap_product .= "
                        <a href='{$link['url']}{$id}{$ref}'
                           target='_blank'
                           class='{$link['class']}'
                           aria-label='{$link['label']}'>{$link['text']}</a>";
                    }

                    $wrap_product .= "
                      </div>
                    </div>";

                    //echo $wrap_product;
                    ?>
                    <?php if($user_replica): ?>
                      <div class="wrap-get subpage">
                        <a href="<?= $Register; ?>" target="_blank" class="btn-get"><?= $Btn_buy; ?></a>
                      </div>
                    <?php endif; ?>
                </div>
            </div>

            <img class="w-40 med-w-30 small-w-80 small-mt-40" src="./images/body/products/<?php echo $id; ?>.webp" alt="<?php echo $id; ?> Product" />
        </div>
        <img class="full-img-abs" src="./images/body/subpage/bg_<?php echo $id; ?>.webp" alt="<?php echo $id; ?> background" />
    </div>
</section>

<!-- ============================================== -->
<!-- ONE -->
<!-- ============================================== -->

<section class="c-sub <?php echo $id; ?>">
    <div class="h-100 of-h rel small-h-0 p-20 d-flex fd-col ai-center jc-center">

      <h2 class="abs-text h1 t-c <?php echo $Condicion; ?>"><?php echo $Ingredients; ?></h2>
      <img class="img-middle br-20 small-d-none" src="./images/body/products/<?php echo $id; ?>.webp" alt="<?php echo $id; ?> Product" />

      <div class="ingredients_wrap">
        <ul class="ingredients m-center">
          <?php foreach ($Ingredients_list as $index => $ingredient): ?>
            <li>
              <div class="ingredient-pill">
                <span class="v-custom icon icon-<?php echo $index+1; ?> c-<?php echo $id; ?> br-50 <?php echo $id; ?>"></span>
                <?php echo $ingredient; ?>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

    </div>
</section>

<!-- ============================================== -->
<!-- TWO -->
<!-- ============================================== -->

<section>
    <div class="img_med of-h">
        <div class="h-100 rel all-tc-0 overlay o-60 custom">
            <div class="center">
                <h2 class="h1"><?php echo $Benefits; ?></h2>
                <p><?php echo $Benefits_Sub; ?></p>
                <p><?= $Benefits_Text ; ?></p>
            </div>

            <ul class="benefits-list med-d-none">
                <?php
                $titles = $Benefits_titles_map[$id] ?? [];
                $benefits = $Benefits_list_map[$id] ?? [];

                foreach ($titles as $index => $title) {
                    // Cada título tiene su correspondiente descripción en $benefits
                    $desc = $benefits[$index + 1] ?? ''; // +1 porque en $Benefits_list_map, el primer elemento es el título
                    ?>
                    <li class="benefits b-<?php echo $index + 1; ?>">
                        <span class="v-custom icon icon-<?php echo 7 + $index; ?> <?php echo $id; ?> i-big"></span>
                        <h4><?php echo $title; ?></h4>
                        <p><?php echo $desc; ?></p>
                    </li>
                <?php } ?>
            </ul>

            <img class="full-img" src="./images/body/subpage/bg_middle_<?php echo $id; ?>.webp" alt="<?php echo $id; ?>">

        </div>
    </div>
</section>

<!-- ============================================== -->
<!-- THREE -->
<!-- ============================================== -->

<section>
	<div class="mw-1280 g-40 fd-col">

		<div class="t-c">
            <h2 class="h2"><?php echo $Started_title; ?></h2>
            <p class="h4"><?php echo $Started_sub; ?></p>
        </div>

        <div class="jc-center g-20 ai-stretch small-fd-col">

            <div class="w-100 rel">
              <div class="banner" style="position:sticky;top:80px;">
                <ul>
                  <?php
                    $Service = array(
                      array('Designed to support your body’s natural rhythms—cognitive, physical, and hormonal—24 hours a day.','Sofía R.',$id),
                      array('I can focus for hours without getting burned out. Revive works.','Leo M.',$id),
                      array('In one week, my memory and mental energy improved','Andrea T.',$id)
                    );

                    $counter = 1;
                    foreach ($Service as $item){
                      echo "
                      <li>
                        <img src='./images/body/banner/{$counter}.webp' alt='{$item[0]}'/>
                      </li>
                      ";
                      $counter++;
                    }
                  ?>
                </ul>
              </div>
            </div>

            <!-- Textos dinámicos -->
            <div class="w-100 text_spirit <?php echo $id; ?>">
              <?php foreach($productBonuses as $bonus): ?>
                <div>
                  <h3 class="h4"><?= $bonus['title']; ?></h3>
                  <p><?= $bonus['text_01']; ?></p>
                  <ul class="menu-list icon-check v-white">
                    <?php foreach ($bonus['list'] as $li): ?>
                      <li>
                        <?= (gettype($li) === 'array') ?
                        "{$Bonus_level_list_level} {$li['level']}: {$li['percentage']}%" :
                        $li; ?>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                  <p class="fw-700"><?= $bonus['text_02']; ?></p>
                </div>
              <?php endforeach; ?>
            </div>

        </div>

	</div>
</section>

<section class="c-<?php echo $id; ?>">
    <div class="mw-1280 t-c big">
        <h2 class="h1 med-mt-50"><?php echo $Started_subpage; ?></h2>
        <?php if(false): ?>
          <a href="<?php echo $Login; ?>" target="_blank" class="btn big c-acc br-50 mt-40 small-mt-20"><?php echo $Btn_start; ?></a>
        <?php endif; ?>
    </div>
</section>

<script>

/* ============================================== */
/* SCROLL-MAGIC */
/* ============================================== */

document.addEventListener("DOMContentLoaded", function() {

    // Solo ejecutar si ancho >= 1080px
    if (window.innerWidth >= 1080) {

        // Función para cargar scripts dinámicamente
        function loadScript(src) {
            return new Promise((resolve, reject) => {
                const script = document.createElement('script');
                script.src = src;
                script.onload = resolve;
                script.onerror = reject;
                document.head.appendChild(script);
            });
        }

        // Cargar librerías en orden
        Promise.all([
            loadScript("https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"),
            loadScript("https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/ScrollMagic.min.js")
        ])
        .then(() => Promise.all([
            loadScript("https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/plugins/animation.gsap.min.js"),
            loadScript("https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js")
        ]))
        .then(() => {

            var controller = new ScrollMagic.Controller();
            var animationSpeed = 0.75;
            var animationLinear = Power3.easeInOut;
            var animationIn = Expo.easeIn;

            $('.ingredients_wrap').each(function() {
                var ingredientsElement = this.querySelector('.ingredients');
                if (ingredientsElement) {
                    var scene = new ScrollMagic.Scene({
                        triggerElement: this,
                        triggerHook: 0.8,
                        duration: "80%"
                    })
                    .setClassToggle(ingredientsElement, 'fade-in')
                    //.addIndicators()
                    .addTo(controller);
                }
            });

            new ScrollMagic.Scene({
                triggerElement: '.img_med',
                duration: "150%",
                triggerHook: 1
            })
            .setTween(
                new TimelineMax()
                .fromTo('.img_med img', 1, { y: "-20%" }, { y: "3%" })
                )
            //.addIndicators()
            .addTo(controller);

        });

    }

});


/* ============================================== */
/* BANNER */
/* ============================================== */

document.addEventListener("DOMContentLoaded", () => {
  const slides = document.querySelectorAll(".banner li");
  let current = 0;
  let interval;

  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.classList.remove("active", "fade-out");
      if (i === index) slide.classList.add("active");
    });
  }

  function nextSlide() {
    slides[current].classList.add("fade-out"); // Fade-out texto antes de salir
    setTimeout(() => {
      current = (current + 1) % slides.length;
      showSlide(current);
    }, 600);
  }

  function startSlider() {
    interval = setInterval(nextSlide, 4000); // cada 4s
  }

  function stopSlider() {
    clearInterval(interval);
  }

  // Inicialización
  showSlide(current);
  startSlider();

  // Detener al hacer hover
  const banner = document.querySelector(".banner");
  banner.addEventListener("mouseenter", stopSlider);
  banner.addEventListener("mouseleave", startSlider);
});

/* ============================================== */
/* TILT */
/* ============================================== */

const imgContainer = document.querySelector('.c-sub .h-100');
const img = document.querySelector('.c-sub .img-middle');

imgContainer.addEventListener('mousemove', (e) => {
    const rect = imgContainer.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    const centerX = rect.width / 2;
    const centerY = rect.height / 2;

    const deltaX = (x - centerX) / centerX; // -1 a 1
    const deltaY = (y - centerY) / centerY; // -1 a 1

    // inclinación
    const rotateX = deltaY * 15;
    const rotateY = deltaX * -15;

    img.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.05)`;
});

imgContainer.addEventListener('mouseleave', () => {
    img.style.transform = 'rotateX(0deg) rotateY(0deg) scale(1)';
});


</script>



