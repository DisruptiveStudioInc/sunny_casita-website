<!-- ============================================== -->
<!-- HERO -->
<!-- ============================================== -->

<section class="hero-pin d-flex fd-col jc-center ai-center overlay o-30">
  <div class="anchor" id="home"></div>

  <div class="dh of-h rel">
    <div class="video-placeholder">
      <img src="./images/body/blank_full.svg" alt="Placeholder" />
    </div>

    <div class="video-iframe-wrapper d-none">
      <iframe
        src="https://player.vimeo.com/video/<?= $Video_vimeo; ?>?background=1&autoplay=1&muted=1&loop=1"
        frameborder="0"
        allow="autoplay; fullscreen; picture-in-picture"
        title="Darevita video agosto 2025_1">
      </iframe>
    </div>
  </div>

  <div class="text-hero t-c hero-text">
    <p class="h2 fw-700"><?= $Hero_upper ?></p>
    <h1 class="h1-special first"><?= $Hero_01; ?></h1>
    <p class="h4 w-50 med-w-80 small-w-100 m-center"><?= $Hero_02; ?></p>
  </div>

  <div class="section-arrows">
    <button class="arrow down"></button>
	</div>

</section>

<!-- ============================================== -->
<!-- ONE -->
<!-- ============================================== -->

<section>

	<div class="section-arrows">
	    <button class="arrow up"></button>
	    <button class="arrow down"></button>
	</div>

	<div class="anchor" id="odl"></div>
	<div class="mw-1440 jc-center ai-center min-h-dhv">
		<div class="t-c">
			<h2 class="h1-special mb-50 small-mb-0"><?= $Journey_title; ?></h2>
      <div class="tabs t-c">
        <nav class="tab-header">
          <?php foreach($sec01 as $k => $step): ?>
            <div class="tab <?= $k === 0 ? 'active' : '' ?>"><span>0<?= $k+1 ?></span><?= $step['title'] ?></div>
          <?php endforeach; ?>
          <div class="active-indicator small-d-none"></div>
        </nav>
      </div>
      <div class="tab-content">
        <?php foreach($sec01 as $k => $step): ?>
          <p class="content <?= $k === 0 ? 'active' : '' ?>" data-text="<?= $step['text'] ?>"><?= $step['text'] ?></p>
        <?php endforeach; ?>
      </div>
		</div>
	</div>
</section>

<!-- ============================================== -->
<!-- TWO -->
<!-- ============================================== -->

<section class="c-b-dark">

	<div class="h-100 vertical-slides rel of-h small-h-0 letters" style="--total-items:4">
    <div class="section-arrows">
      <button class="arrow up"></button>
      <button class="arrow down"></button>
    </div>
    <?php foreach($verticalSlides as $k => $slide): ?>
		<div class="letter-wrap" style="--item-index:<?= $k; ?>">
      <!-- <img class="letter-bg img_0<?= $slide['id']; ?>" src="./images/body/letters/<?= $slide['id']; ?>.webp" alt="<?= $slide['title']; ?>"> -->
      <img class="letter-bg img_0<?= $slide['id']; ?>" src="./images/body/blank_full.svg" alt="<?= $slide['title']; ?>">
      <div class="letter-content word_0<?= $slide['id']; ?> abs w-100 p-40 med-p-10-20 med-pt-50 med-pb-50 t-c">
        <h2 class="letter-title tc-0"><?= $slide['title']; ?></h2>
        <p class="h4 letter-text t-pretty h3 tc-0"><?= $slide['text']; ?></p>
      </div>
		</div>
    <?php endforeach; ?>
	</div>
</section>

<!-- ============================================== -->
<!-- THREE -->
<!-- ============================================== -->

<section class="parallax-wrap">

	<div class="section-arrows">
	    <button class="arrow up"></button>
	    <button class="arrow down"></button>
	</div>

	<div class="mw-1440 t-c h-100 med-h-0 fd-col jc-center ai-center parallax">
		<h2 class="h1-special short"><?= $Vision_text; ?></h2>
    <ul class="d-flex fw-wrap jc-center mw-1080 g-40 med-g-20">
      <?php foreach($sec03 as $k => $item): ?>
        <li class="box rel d-flex fd-col jc-center ai-center g-0 p-20 br-20 w-100 c-0 box_<?= $item['id']; ?>">
          <h3 class="box-title h3 m-0"><?= $item['title']; ?></h3>
          <p class="h4 m-0"><?= $item['text']; ?></p>
        </li>
      <?php endforeach; ?>
    </ul>
	</div>
</section>

<!-- ============================================== -->
<!-- FOUR -->
<!-- ============================================== -->

<section class="c-0">
	<div class="section-arrows">
	    <button class="arrow up"></button>
	    <button class="arrow down"></button>
	</div>

	<div class="slogan-wrap mw-1280 t-c h-100 med-h-0 jc-center fd-col small-pb-50 med-pb-80">
    <div class="slogan rel w-full">
      <?php foreach ($sec04 as $item): ?>
        <div class="slogan-content abs w-full d-flex fd-col jc-center">
          <h2 class="h1 m-0"><?= $item['title'] ?></h2>
          <p class="h3 m-0"><?= $item['text'] ?></p>
        </div>
      <?php endforeach; ?>
    </div>
    <p class="h1"><?= $Slogan_text; ?></p>
	</div>
</section>

<!-- ============================================== -->
<!-- FIVE -->
<!-- ============================================== -->

<?php foreach ($homeProducts as $item):?>
	<div id='Modal<?=$item['id']?>' class='modal'>
    <div class='modal-content rel t-c'>
      <span class='v-white c-pri icon icon-close' onclick="closeModal('Modal<?=$item['id']?>')"></span>
      <h2 class='h2 tc-pri t-c med-t-l'><?=$item['title']?></h2>
      <p><?= $item['text']?></p>
    </div>
	</div>
<?php endforeach; ?>

<section class="products">

	<div class="overlay of-h">

	<div class="anchor" id="experience"></div>
	<div class="h-100 med-h-0 med-fd-col-rev content-scroll jc-center ai-center rel wrap_products">
  <div class="abs h-100 w-100 c-pri"></div>
	<div class="section-arrows">
	    <button class="arrow up"></button>
	    <button class="arrow down"></button>
	</div>

  <?php foreach($homeProducts as $item): ?>
    <div class="box_product img-<?= $item['number']; ?> rel flex ai-center jc-center fd-col">
      <div class="rel t-c">
        <!-- <img src="./images/body/products/<?= $item['link']; ?>.webp" class="product m-center cursor-pointer" alt="<?= $item['link']; ?>" onclick="openModal('Modal<?= $item['id']; ?>')"/> -->
        <img src="./images/body/blank_4_3.svg" class="product m-center cursor-pointer" alt="<?= $item['link']; ?>" onclick="openModal('Modal<?= $item['id']; ?>')"/>
        <div class="abs product-plus-wrap d-flex fd-col ai-center g-20">
          <button type="button" class="v-white c-pri icon br-50 icon-more pointer-e-none"></button>
          <a href="?p=product&id=<?= $item['link']; ?>" class="btn c-ter br-50"><?= $Btn_view; ?></a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  <?php foreach($homeProducts as $item): ?>
	  <!-- <img class="background anim-scale med-d-none img_product_<?= $item['link']; ?>" src="./images/body/subpage/bg_<?= $item['link']; ?>.webp" alt="<?= $item['link']; ?> background"> -->
	  <img class="background anim-scale med-d-none img_product_<?= $item['link']; ?>" src="./images/body/blank_full.svg" alt="<?= $item['link']; ?> background">
  <?php endforeach; ?>

	</div>
</section>

<!-- ============================================== -->
<!-- SIX -->
<!-- ============================================== -->

<?php if(false): ?>
<section class="deg">
	<div class="wrap-people">
		<div class="mw-1440 p-30 mb-40">
			<h3 class="h3 t-c"><?= $Envolvers_title; ?></h3>
		</div>

	<?php
	$Logos = array(
		array('1','Mariana Torres',$Logos_testimonials[0]),
    array('2','Andrés Valdivia',$Logos_testimonials[1]),
    array('3','Sofía Ramírez',$Logos_testimonials[2]),
    array('4','Valentina Ríos',$Logos_testimonials[3]),
    array('5','Jorge Medina',$Logos_testimonials[4]),
    array('6','Ricardo Paredes',$Logos_testimonials[5]),
    array('7','Daniel Ortega',$Logos_testimonials[6]),
    array('8','Camila Herrera',$Logos_testimonials[7]),
    array('9','Isabela Núñez',$Logos_testimonials[8]),
    array('10','Mateo Lozano',$Logos_testimonials[9])
	);
	?>

	<ul class="people">
		<?php
		foreach ($Logos as $item){
			echo "
			<li class='item item{$item[0]}'>
				<img src='./images/body/evolvers/{$item[0]}.webp' alt='{$item[1]}'>

					<h5>{$item[1]}</h5>
					<p>{$item[2]}</p>

			</li>
			";
		}
		?>
	</ul>

	</div>
</section>
<?php endif; ?>

<!-- ============================================== -->
<!-- SEVEN -->
<!-- ============================================== -->

<section class="c-sec">

	<div class="section-arrows">
	    <button class="arrow up"></button>
	    <button class="arrow down"></button>
	</div>

	<div class="mw-1440 t-c">
		<h2 class="h2"><?= $Truth_title; ?></h2>
	</div>
	<div class="rel">
		<ul class="textos">
      <?php foreach($sec07 as $item): ?>
        <li>
          <h2 class="h1"><?= $item['title']; ?></h2>
          <span>
            <!-- <img src="./images/body/truth/<?= $item['id']; ?>.webp" alt="<?= $item['title']; ?>" class="" loading="lazy"/> -->
            <img src="./images/body/blank_4_3.svg" alt="<?= $item['title']; ?>" class="" loading="lazy"/>
            <p class="h3 t-pretty"><?= $item['text']; ?></p>
          </span>
        </li>
      <?php endforeach; ?>
		</ul>
	</div>
</section>

<!-- ============================================== -->
<!-- EIGHT -->
<!-- ============================================== -->

<section class="c-0">

	<div class="section-arrows">
	    <button class="arrow up"></button>
	    <button class="arrow down"></button>
	</div>

		<div class="mw-1280 jc-center min-h-dhv med-h-0 g-40 ai-start med-fd-col">

			<div class="img_spirit med-d-none" style="top:180px;min-height:460px;">
        <?php foreach($sec08 as $item): ?>
				<span class="img_product">
					<div class="product_wrapper">
						<!-- <img src="./images/body/the_spirit/circle/<?= $item['id']?>.png" class="img_reference" alt="<?= $item['name']?>" loading="lazy"/>
						<img src="./images/body/the_spirit/<?= $item['id']?>.webp" class="product" alt="<?= $item['name']?>" loading="lazy"/> -->
            <img src="./images/body/blank_square.svg" class="img_reference" alt="<?= $item['name']?>" loading="lazy"/>
						<img src="./images/body/blank_10_13.svg" class="product" alt="<?= $item['name']?>" loading="lazy"/>
					</div>
				</span>
        <?php endforeach; ?>
			</div>

			<img src="./images/body/treo/all.webp" class="mw-300 m-center med-d-block d-none" alt="all products" loading="lazy"/>

			<!-- Textos -->
			<div class="text_spirit">
				<h2 class="h2 med-t-c"><?= $Spirit_title; ?></h2>
        <?php foreach($sec08 as $item): ?>
          <div class="text_<?= $item['id']?>">
            <h3 class="h4 tc-pri"><?= $item['title']?></h3>
            <?= $item['list_type']==='ul' ? "<ul class='menu-list icon-check'>" : "<ol class='menu-list'>" ?>
              <?php foreach($item['list'] as $i): ?>
                <li><?= $i; ?></li>
              <?php endforeach; ?>
            <?= $item['list_type']==='ul' ? "</ul>" : "</ol>" ?>
          </div>
        <?php endforeach; ?>
			</div>


	</div>
</section>

<!-- ============================================== -->
<!-- NINE -->
<!-- ============================================== -->

<section class="c-acc">

	<div class="section-arrows">
	    <button class="arrow up"></button>
      <button class="arrow down"></button>
	</div>

	<div class="mw-1280 t-c big">
		<h2 class="h1 m-center tc-0"><?= $Traits_title; ?></h2>
    <?php if($user_replica): ?>
		  <a href="<?= $Register; ?>" target="_blank" class="btn big c-acc br-50 mt-40 small-mt-20"><?= $Btn_part; ?></a>
    <?php endif; ?>
	</div>
</section>

<!-- ============================================== -->
<!-- TEN -->
<!-- ============================================== -->

<section class="c-sec">

	<div class="section-arrows">
	    <button class="arrow up"></button>
	</div>

	<div class="mw-1280 min-h-dhv med-min-h-auto t-c d-flex fd-col ai-center jc-center small-pt-60 small-pb-60">
		<h2 class="h1 m-center"><?= $Roadmap_title; ?></h2>
    <div class="roadmap d-flex ai-center fd-col g-40 small-g-20 pt-60 small-pt-40">
      <?php foreach($sec10 as $item): ?>
        <article class="roadmap-step p-30 small-p-20 br-20 small-br-10 w-50 small-w-100 z-index-1">
          <h2 class="h2 roadmap-text"><?= $item['year'] ?></h2>
          <p class="h5 t-pretty roadmap-text"><?= $item['text'] ?></p>
        </article>
      <?php endforeach; ?>
    </div>
	</div>
</section>

<script src="/js/slider.js"></script>
<script src="/js/home.js"></script>
