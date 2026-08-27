<!-- HERO -->
<section class="hero-pin d-flex fd-col jc-center ai-center overlay o-30">
  <div class="anchor" id="home"></div>

  <div class="dh of-h rel">
    <div class="video-placeholder h-full">
      <picture>
        <source type="image/avif" srcset="/images/hero/hero-640.avif 640w, /images/hero/hero-960.avif 960w, /images/hero/hero-1280.avif 1280w, /images/hero/hero-1920.avif 1920w" sizes="100vw">
        <source type="image/webp" srcset="/images/hero/hero-640.webp 640w, /images/hero/hero-960.webp 960w, /images/hero/hero-1280.webp 1280w, /images/hero/hero-1920.webp 1920w" sizes="100vw">
        <img class="background visible" src="<?= e(assetUrl('/images/hero/hero.webp')); ?>" width="1920" height="1080" fetchpriority="high" decoding="sync" alt="">
      </picture>
    </div>

    <div
      class="video-iframe-wrapper"
      data-vimeo-id="<?= e((string) $Hero_vimeo); ?>"
      aria-hidden="true"
    ></div>
  </div>

  <div class="text-hero t-c hero-text">
    <h1 class="h1-special first mt-0 mb-0 m-center" style="max-width:18ch"><?= $Hero_01; ?></h1>
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
      <button
        type="button"
        class="video-facade js-vimeo-facade br-10"
        data-vimeo-id="<?= e((string) $Video_vimeo); ?>"
        aria-label="<?= e($Video_title); ?>"
      >
        <picture>
          <source type="image/avif" srcset="/images/body/video/cover-video-640.avif 640w, /images/body/video/cover-video-960.avif 960w, /images/body/video/cover-video-1280.avif 1280w" sizes="(max-width: 1080px) calc(100vw - 40px), 1080px">
          <source type="image/webp" srcset="/images/body/video/cover-video-640.webp 640w, /images/body/video/cover-video-960.webp 960w, /images/body/video/cover-video-1280.webp 1280w" sizes="(max-width: 1080px) calc(100vw - 40px), 1080px">
          <img src="<?= e(assetUrl('/images/body/video/cover-video.webp')); ?>" width="1280" height="720" loading="lazy" decoding="async" alt="">
        </picture>
        <span class="video-facade-play" aria-hidden="true"></span>
      </button>
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
      <img class="letter-bg img_0<?= $slide['id']; ?>" src="/images/body/letters/<?= $slide['id']; ?>-960.webp" srcset="/images/body/letters/<?= $slide['id']; ?>-640.webp 640w, /images/body/letters/<?= $slide['id']; ?>-960.webp 960w, /images/body/letters/<?= $slide['id']; ?>-1440.webp 1440w, /images/body/letters/<?= $slide['id']; ?>-1920.webp 1920w" sizes="100vw" width="1920" height="1080" loading="lazy" decoding="async" alt="<?= e($slide['title']); ?>">
      <div class="letter-content word_0<?= $slide['id']; ?> abs w-100 p-40 med-p-10-20 med-pt-50 med-pb-50 t-c">
        <h2 class="letter-title tc-0 t-balance"><?= $slide['title']; ?></h2>
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
		<h2 class="h1-special steps tc-sec mt-0 mb-50 med-mb-30"><?= $Vision_text; ?></h2>
    <ul class="d-flex fw-wrap jc-center mw-1080 g-40 med-g-20 pt-0 pb-0">
      <?php foreach($sec03 as $k => $item): ?>
        <li class="box step rel d-flex fd-col jc-center ai-center g-0 p-30 pt-20 pb-20 br-999 w-100 c-pri box_<?= $item['id']; ?>">
          <h3 class="h5 uppercase box-number m-0 tc-acc"><?= $Vision_step ?> <?= $k + 1; ?></h3>
          <p class="h2 tc-0 m-0"><?= $item['text']; ?></p>
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
          <li class="p-10 br-10 c-ter tc-gray t-c"><?= $li; ?></li>
        <?php endforeach; ?>
      </ul>
      <?php if(isset($item['video'])): ?>
        <button type="button" class="btn c-pri br-30 mt-20 js-product-video" data-video="<?= htmlspecialchars($item['video'], ENT_QUOTES, 'UTF-8'); ?>"><?= $Btn_video; ?></button>
      <?php endif; ?>
    </div>
	</div>
<?php endforeach; ?>

<section class="products">

	<div class="overlay of-h o-60 custom">

	<div class="anchor" id="solutions"></div>
	<div class="h-100 med-h-0 med-fd-col-rev content-scroll jc-center ai-center rel wrap_products">
    <div class="section-arrows">
        <button class="arrow up"></button>
        <button class="arrow down"></button>
    </div>

    <?php foreach($homeProducts as $item): ?>
      <div class="box_product img-<?= $item['number']; ?> rel flex ai-center jc-center fd-col">
        <picture class="product-mobile-background" aria-hidden="true">
          <source type="image/avif" srcset="/images/body/subpage/<?= pathinfo($item['background'], PATHINFO_FILENAME); ?>-640.avif 640w, /images/body/subpage/<?= pathinfo($item['background'], PATHINFO_FILENAME); ?>-960.avif 960w" sizes="100vw">
          <source type="image/webp" srcset="/images/body/subpage/<?= pathinfo($item['background'], PATHINFO_FILENAME); ?>-640.webp 640w, /images/body/subpage/<?= pathinfo($item['background'], PATHINFO_FILENAME); ?>-960.webp 960w" sizes="100vw">
          <img src="/images/body/subpage/<?= $item['background']; ?>" width="1920" height="1080" loading="lazy" decoding="async" alt="">
        </picture>
        <div class="rel t-c z-index-2">
          <img src="/images/body/products/<?= $item['image']; ?>" srcset="/images/body/products/<?= pathinfo($item['image'], PATHINFO_FILENAME); ?>-350.webp 350w, /images/body/products/<?= pathinfo($item['image'], PATHINFO_FILENAME); ?>-700.webp 700w" sizes="(max-width: 1080px) 70vw, 370px" width="700" height="400" loading="lazy" decoding="async" class="product m-center cursor-pointer" alt="<?= e($item['title']); ?>" onclick="openModal('Modal<?= $item['id']; ?>')"/>
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
      <img class="background anim-scale med-d-none img_product_<?= $item['number']; ?>" src="/images/body/subpage/<?= pathinfo($item['background'], PATHINFO_FILENAME); ?>-1440.webp" srcset="/images/body/subpage/<?= pathinfo($item['background'], PATHINFO_FILENAME); ?>-960.webp 960w, /images/body/subpage/<?= pathinfo($item['background'], PATHINFO_FILENAME); ?>-1440.webp 1440w, /images/body/subpage/<?= pathinfo($item['background'], PATHINFO_FILENAME); ?>-1920.webp 1920w" sizes="100vw" width="1920" height="1080" loading="lazy" decoding="async" alt="<?= e($item['title']); ?> background">
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
    <h2 class="h1-special slogan tc-sec mt-0 mb-40 small-mb-20"><?= $Slogan_title ?></h2>
    <p class="h3 tc-gray serif-italic-font"><?= $Slogan_text; ?></p>
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
          <img src='/images/body/evolvers/<?= $item['id']; ?>.webp' width="100" height="100" loading="lazy" decoding="async" alt='<?= e($item['name']); ?>'>
          <p class="tc-gray h5 mt-0 mb-10"><?= $item['text']; ?></p>
          <h5 class="m-0"><?= $item['name']; ?></h5>
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
            <img src="/images/body/truth/<?= $item['image']; ?>" width="400" height="300" alt="<?= e($item['title']); ?>" loading="lazy" decoding="async"/>
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
						<img src="/images/body/the_spirit/circle/<?= $item['small_img']?>" width="400" height="400" class="img_reference" alt="<?= e($item['name']); ?>" loading="lazy" decoding="async"/>
						<img src="/images/body/the_spirit/<?= $item['image']?>" width="400" height="520" class="product" alt="<?= e($item['name']); ?>" loading="lazy" decoding="async"/>
					</div>
				</span>
        <?php endforeach; ?>
			</div>

			<img src="/images/body/the_spirit/plano.webp" width="400" height="520" class="mw-300 br-20 m-center med-d-block d-none" alt="all products" loading="lazy" decoding="async"/>

			<!-- Textos -->
			<div class="text_spirit" id="text-spirit-wrap">
				<h2 class="h2 tc-sec med-t-c mb-30 small-mb-20"><?= $Spirit_title; ?></h2>
        <?php foreach($sec08 as $item): ?>
          <div class="texts-home text_<?= $item['id']?>">
            <h3 class="h4 tc-gray"><?= $item['title']?></h3>
            <p class="tc-gray"><?= $item['text']?></p>
          </div>
        <?php endforeach; ?>
			</div>


	</div>
</section>

<!-- BANNER -->
<section class="c-pri rel">

	<div class="section-arrows">
    <button class="arrow up"></button>
	</div>

  <img src="/images/hero/hero-960.webp" srcset="/images/hero/hero-640.webp 640w, /images/hero/hero-960.webp 960w, /images/hero/hero-1280.webp 1280w" sizes="100vw" width="1920" height="1080" loading="lazy" decoding="async" alt="" class="background" style="opacity:0.1">
	<div class="mw-1280 t-c big rel banner-padding">
		<h2 class="h1 m-center tc-0"><?= $Traits_title; ?></h2>
    <a href="https://wa.me/<?= $constants['wame'] ?>" target="_blank" rel="noopener noreferrer" class="btn big c-acc br-50 mt-40 small-mt-20"><?= $Btn_connect; ?></a>
	</div>
</section>
