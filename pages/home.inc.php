<!-- HERO -->
<section class="hero-pin d-flex fd-col jc-center ai-center overlay o-30">
  <div class="anchor" id="home"></div>

  <div class="dh of-h rel">
    <div class="video-placeholder h-full">
      <img class="background visible" src="/images/body/blank_full.svg" alt="Placeholder" />
    </div>

    <div class="video-iframe-wrapper">
      <iframe
        src="https://player.vimeo.com/video/<?= $Hero_vimeo; ?>?background=1&autoplay=1&muted=1&loop=1"
        frameborder="0"
        allow="autoplay; fullscreen; picture-in-picture"
        title="Sunny Casitas Video">
      </iframe>
    </div>
  </div>

  <div class="text-hero t-c hero-text">
    <h1 class="h1-special first m-0"><?= $Hero_01; ?></h1>
  </div>

  <div class="section-arrows">
    <button class="arrow down"></button>
	</div>

</section>

<!-- ABOUT -->
<section>

	<div class="section-arrows">
    <button class="arrow up"></button>
    <button class="arrow down"></button>
	</div>

	<div class="anchor" id="sunny"></div>
	<div class="mw-1440 jc-center ai-center min-h-dvh">
		<div class="t-c">
			<h2 class="h1-special tc-sec mb-50 small-mb-0"><?= $Journey_title; ?></h2>
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
          <p class="content t-balance tc-gray <?= $k === 0 ? 'active' : '' ?>" data-text="<?= $step['text'] ?>"><?= $step['text'] ?></p>
        <?php endforeach; ?>
      </div>
		</div>
	</div>
</section>

<!-- VIDEO -->
<section class="c-0">
  <div class="section-arrows">
    <button class="arrow up"></button>
    <button class="arrow down"></button>
	</div>

  <div class="mw-1440 fd-col jc-center ai-center min-h-dvh t-c">
    <h2 class="h1 tc-sec mt-0 mb-30 small-mb-20"><?= $Video_title; ?></h2>
		<div class="w-100">
      <iframe
        src="https://player.vimeo.com/video/<?= $Video_vimeo; ?>"
        frameborder="0"
        allow="fullscreen; picture-in-picture"
        title="Sunny Casitas How Works Video"
        style="width:100%;height:auto;aspect-ratio:16/9;max-width:1200px;"
        class="br-10">
      </iframe>
		</div>
	</div>
</section>

<!-- VALUE POINTS -->
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

<!-- STEPS -->
<section class="parallax-wrap">

	<div class="section-arrows">
	    <button class="arrow up"></button>
	    <button class="arrow down"></button>
	</div>

	<div class="mw-1440 t-c min-h-dvh fd-col jc-center ai-center parallax">
		<h2 class="h1-special short tc-sec mt-0 mb-50 med-mb-30"><?= $Vision_text; ?></h2>
    <ul class="d-flex fw-wrap jc-center mw-1080 g-40 med-g-20 pt-0 pb-0">
      <?php foreach($sec03 as $k => $item): ?>
        <li class="box step rel d-flex fd-col jc-center ai-center g-0 p-20 br-20 w-100 c-0 box_<?= $item['id']; ?>">
          <h3 class="h5 uppercase box-number m-0"><?= $Vision_step ?> <?= $k + 1; ?></h3>
          <p class="h2 tc-gray m-0"><?= $item['text']; ?></p>
        </li>
      <?php endforeach; ?>
    </ul>
	</div>
</section>

<!-- PRODUCTS -->
<?php foreach ($homeProducts as $item):?>
	<div id='Modal<?=$item['id']?>' class='modal'>
    <div class='modal-content rel t-c'>
      <span class='v-white c-pri icon icon-close' onclick="closeModal('Modal<?=$item['id']?>')"></span>
      <h2 class='h2 tc-sec t-c med-t-l mb-0'><?=$item['title']?></h2>
      <p class="h5 tc-gray mt-0 med-t-l"><?= $item['phrase'] ?></p>
      <p class="t-l mb-20 tc-gray"><?= $item['text']?></p>
      <ul class="modal-list t-l">
        <?php foreach($item['list'] as $li): ?>
          <li class="p-10 br-10 c-ter tc-gray"><?= $li; ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
	</div>
<?php endforeach; ?>

<section class="products">

	<div class="overlay of-h">

	<div class="anchor" id="solutions"></div>
	<div class="h-100 med-h-0 med-fd-col-rev content-scroll jc-center ai-center rel wrap_products">
    <div class="abs h-100 w-100" style="background-color:rgba(0,0,0,0.6)"></div>
    <div class="section-arrows">
        <button class="arrow up"></button>
        <button class="arrow down"></button>
    </div>

    <?php foreach($homeProducts as $item): ?>
      <div class="box_product img-<?= $item['number']; ?> rel flex ai-center jc-center fd-col">
        <div class="rel t-c">
          <img src="/images/body/<?= $item['image']; ?>" class="product m-center cursor-pointer" alt="<?= $item['title']; ?>" onclick="openModal('Modal<?= $item['id']; ?>')"/>
          <div class="abs product-plus-wrap d-flex fd-col ai-center g-20">
            <button type="button" class="v-white c-pri icon br-50 icon-more pointer-e-none"></button>
            <?php if(false): ?>
              <a href="<?= $item['url']; ?>" class="btn c-ter br-50"><?= $Btn_view; ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

    <?php foreach($homeProducts as $item): ?>
      <!-- <img class="background anim-scale med-d-none img_product_<?= $item['number']; ?>" src="/images/body/subpage/<?= $item['class']; ?>" alt="<?= $item['title']; ?> background"> -->
      <img class="background anim-scale med-d-none img_products img_product_<?= $item['number']; ?>" src="/images/body/blank_full.svg" alt="<?= $item['title']; ?> background">
    <?php endforeach; ?>

	</div>
</section>

<!-- SLOGAN -->
<section class="c-0">
	<div class="section-arrows">
	    <button class="arrow up"></button>
	    <button class="arrow down"></button>
	</div>

	<div class="mw-1440 t-c h-100 med-h-0 jc-center fd-col med-pt-100 med-pb-100">
    <h2 class="h1-special short tc-sec m-0"><?= $Slogan_title ?></h2>
    <p class="h3 tc-gray"><?= $Slogan_text; ?></p>
	</div>
</section>

<!-- TESTIMONIAL -->
<section class="deg">
	<div class="wrap-people min-h-dvh d-flex fd-col jc-center">
    <ul class="people" style="--total-items:<?= count($testimonials) ?>;">
      <?php
        foreach ($testimonials as $k => $item):
      ?>
        <li class='item c-0 p-20 br-10' style="--item-index:<?= $k + 1; ?>">
          <img src='/images/body/evolvers/<?= $item['id']; ?>.webp' alt='<?= $item['name']; ?>'>
          <p class="tc-gray h5"><?= $item['text']; ?></p>
          <h5><?= $item['name']; ?></h5>
        </li>
      <?php endforeach; ?>
    </ul>
	</div>
</section>

<!-- COMPROMISE -->
<section class="c-ter">

	<div class="section-arrows">
    <button class="arrow up"></button>
    <button class="arrow down"></button>
	</div>

	<div class="mw-1440 t-c">
		<h2 class="h2 tc-gray"><?= $Truth_title; ?></h2>
	</div>
	<div class="rel">
		<ul class="textos">
      <?php foreach($sec07 as $item): ?>
        <li>
          <h2 class="h1 tc-sec"><?= $item['title']; ?></h2>
          <span>
            <!-- <img src="./images/body/truth/<?= $item['id']; ?>.webp" alt="<?= $item['title']; ?>" class="" loading="lazy"/> -->
            <img src="./images/body/blank_4_3.svg" alt="<?= $item['title']; ?>" class="" loading="lazy"/>
            <p class="h3 t-pretty tc-sec"><?= $item['text']; ?></p>
          </span>
        </li>
      <?php endforeach; ?>
		</ul>
	</div>
</section>

<!-- PROCESS -->
<section class="c-0">

	<div class="section-arrows">
	    <button class="arrow up"></button>
	    <button class="arrow down"></button>
	</div>

		<div class="mw-1280 jc-center min-h-dvh med-h-0 g-40 ai-center med-fd-col">

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

			<img src="./images/body/blank_full.svg" class="mw-300 br-20 m-center med-d-block d-none" alt="all products" loading="lazy"/>

			<!-- Textos -->
			<div class="text_spirit">
				<h2 class="h2 tc-sec med-t-c"><?= $Spirit_title; ?></h2>
        <?php foreach($sec08 as $item): ?>
          <div class="text_<?= $item['id']?>">
            <h3 class="h4 tc-gray"><?= $item['title']?></h3>
            <p class="tc-gray"><?= $item['text']?></p>
          </div>
        <?php endforeach; ?>
			</div>


	</div>
</section>

<!-- BANNER -->
<section class="c-pri">

	<div class="section-arrows">
	    <button class="arrow up"></button>
      <button class="arrow down"></button>
	</div>

	<div class="mw-1280 t-c big">
		<h2 class="h1 m-center tc-0"><?= $Traits_title; ?></h2>
    <a href="<?= \Includes\Localization::url('join') ?>" class="btn big c-acc br-50 mt-40 small-mt-20"><?= $Btn_connect; ?></a>
	</div>
</section>

<script src="/js/slider.js"></script>
<script src="/js/home.js"></script>
