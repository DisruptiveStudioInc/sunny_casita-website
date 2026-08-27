<?php
  // require('./controllers/productController.php'); // Removed
  $content = $product ?? $productContent[$id] ?? [];
?>

<!-- ============================================== -->
<!-- HERO -->
<!-- ============================================== -->

<section>
  <div class="block-box-bg overlay o-70">
    <div class="mw-1440 jc-center ai-center dh-100 small-fd-col-rev g-20 p-30">

      <div class="info w-60 med-w-100 all-tc-0 small-t-c">
        <h1 class="h1-special"><?= $content['subtitle']; ?></h1>
        <p class="small-d-none"><?= $content['text']; ?></p>
        <p class="h3"><?= $content['price']; ?></p>

        <div class="btns g-10 small-jc-center">
          <?php if($user_replica): ?>
            <div class="wrap-get subpage">
              <a href="<?= $Register; ?>" target="_blank" class="btn-get"><?= $Btn_buy; ?></a>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <img class="w-40 med-w-30 small-w-80 small-mt-40" src="./images/body/products/<?= $content['id'] ?>.webp" alt="<?= $content['id'] ?> Product" />
    </div>
    <img class="full-img-abs" src="./images/body/subpage/bg_<?= $content['id'] ?>.webp" alt="<?= $content['id'] ?> background" />
  </div>
</section>

<!-- ============================================== -->
<!-- ONE -->
<!-- ============================================== -->

<section class="c-sub <?= $content['id'] ?>">
  <div class="h-100 of-h rel small-h-0 p-20 d-flex fd-col ai-center jc-center">

    <h2 class="abs-text h1 t-c <?= $content['ingredient_cls']; ?>"><?= $content['ingredients']; ?></h2>
    <img class="img-middle br-20 small-d-none" src="./images/body/products/<?= $content['id'] ?>.webp" alt="<?= $content['id'] ?> Product" />

    <div class="ingredients_wrap">
      <ul class="ingredients m-center">
        <?php foreach ($content['ingredients_list'] as $index => $ingredient): ?>
          <li>
            <div class="ingredient-pill">
              <span class="v-custom icon icon-<?= $index+1; ?> c-<?= $content['id'] ?> br-50 <?= $content['id'] ?>"></span>
              <?= $ingredient; ?>
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
        <h2 class="h1"><?= $Benefits; ?></h2>
        <p><?= $content['benefits_sub']; ?></p>
        <p><?= $content['benefits_text']; ?></p>
      </div>

      <ul class="benefits-list med-d-none">
        <?php
          $benefits = $content['benefits_list'] ?? [];

          foreach ($content['benefits_titles'] as $index => $title):
            // Cada título tiene su correspondiente descripción en $benefits
            $desc = $benefits[$index + 1] ?? ''; // +1 porque en $Benefits_list_map, el primer elemento es el título
        ?>
          <li class="benefits b-<?= $index + 1; ?>">
            <span class="v-custom icon icon-<?= 7 + $index; ?> <?= $content['id'] ?> i-big"></span>
            <h4><?= $title; ?></h4>
            <p><?= $desc; ?></p>
          </li>
        <?php endforeach; ?>
      </ul>

      <img class="full-img" src="./images/body/subpage/bg_middle_<?= $content['id'] ?>.webp" alt="<?= $content['id'] ?>">

    </div>
  </div>
</section>

<!-- ============================================== -->
<!-- THREE -->
<!-- ============================================== -->

<section>
	<div class="mw-1280 g-40 fd-col">

		<div class="t-c">
      <h2 class="h2"><?= $content['started_title']; ?></h2>
      <p class="h4"><?= $content['started_sub']; ?></p>
    </div>

    <div class="jc-center g-20 ai-stretch small-fd-col">

      <div class="w-100 rel">
        <div class="banner" style="position:sticky;top:80px;">
          <ul>
            <?php
              $Service = array(
                array('Designed to support your body’s natural rhythms—cognitive, physical, and hormonal—24 hours a day.','Sofía R.',$content['id']),
                array('I can focus for hours without getting burned out. Revive works.','Leo M.',$content['id']),
                array('In one week, my memory and mental energy improved','Andrea T.',$content['id'])
              );

              foreach ($Service as $k => $item){
                $counter = $k + 1;
                echo "
                <li>
                  <img src='./images/body/banner/{$counter}.webp' alt='{$item[0]}'/>
                </li>
                ";
              }
            ?>
          </ul>
        </div>
      </div>

      <!-- Textos dinámicos -->
      <div class="w-100 text_spirit <?= $content['id'] ?>">
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

<section class="c-<?= $content['id'] ?>">
  <div class="mw-1280 t-c big">
    <h2 class="h1 med-mt-50"><?= $content['started_subpage']; ?></h2>
    <?php if(false): ?>
      <a href="<?= $Login; ?>" target="_blank" class="btn big c-acc br-50 mt-40 small-mt-20"><?= $Btn_start; ?></a>
    <?php endif; ?>
  </div>
</section>
