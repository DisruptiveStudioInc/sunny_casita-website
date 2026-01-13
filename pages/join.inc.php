<!-- HERO -->
<section>
  <div class="block-box-bg overlay o-70">
    <div class="mw-1440 jc-center ai-center dh-100 small-fd-col-rev g-40 small-g-20 p-30 pt-100 med-pt-80">

      <div class="info w-100 all-tc-0 t-c">
        <h1 class="h1-special t-balance"><?= $PartOf_heroTitle ?></h1>
        <p class="h4 t-balance"><?= $PartOf_heroText ?></p>
      </div>

    </div>
    <img class="full-img-abs" src="/images/body/letters/2.webp" alt="background">
  </div>
</section>

<div class="c-join-deg">
  <!-- BELIEVE -->
  <section class="d-flex fd-row med-fd-col jc-end">
    <div class="half med-w-100 left">
      <div class="p-60 all-tc-0 c-pri-h br-believe med-p-30 med-pt-50 med-pb-50">
        <h2 class="h1 mt-0 mb-20 small-mb-10 leading-1"><?= $PartOf_text1 ?></h2>
        <p class="mt-0 mb-20 small-mb-10"><?= $PartOf_text2 ?></p>
        <p class="m-0"><?= $PartOf_text3 ?></p>
      </div>
    </div>
    <div class="w-50 med-w-100 rel med-min-h-40dvh">
      <img src="/images/body/join/join-1.webp" alt="" class="background visible">
    </div>
  </section>

  <section>
    <div class="mw-1440 pt-100 pb-100 med-pt-60 med-pb-60 d-flex jc-end">
      <p class="w-50 med-w-100 h3 m-0 tc-sec pl-believe med-t-c"><?= $PartOf_text4 ?></p>
    </div>
  </section>

  <!-- MEANING -->
  <section class="d-flex fd-row med-fd-col">
    <div class="w-50 med-w-100 c-acc-h d-flex jc-end med-jc-center">
      <div class="half inner left rel med-w-60">
        <img src="/images/body/join/join-2.webp" alt="" class="image-meaning br-20 abs med-min-h-40dvh med-mt-50">
      </div>
    </div>
    <div class="half right med-w-100">
      <div class="c-acc-h all-tc-0 p-50 med-p-20 med-pt-30 med-pb-50 br-l-20">
        <h2 class="h1 tc-sec mt-0 mb-20"><?= $PartOf_meaningTitle ?></h2>
        <ul class="mt-0 mb-20 menu-list icon-check v-white">
          <?php foreach ($PartOf_list as $item): ?>
            <li class="tc-gray"><?= $item ?></li>
          <?php endforeach; ?>
        </ul>
        <div class="br-10 p-20" style="background-color:#9F770D">
          <h3 class="h3 tc-sec mt-0"><?= $PartOf_whoTitle ?></h3>
          <p class="m-0 tc-gray"><?= $PartOf_whoText ?></p>
        </div>
      </div>
    </div>
  </section>

  <!-- FORM -->
  <section>
    <div class="mw-1080 min-h-dvh fd-col ai-center jc-center">
      <h2 class="h1 t-c tc-sec m-0"><?= $PartOf_heroTitle ?></h2>
      <p class="h5 t-balance tc-gray mb-50 med-mb-30"><?= $Form_subtitle ?></p>
      <div class="c-ter-h p-50 br-20 w-100 med-p-30 small-p-20">
        <form action="/api/form/join" method="POST" id="contact-form" class="form-grid" data-alerts="<?= $Alerts ?>">
          <input type="hidden" name="lang" value="<?= $lang ?? 'es' ?>">
          <div class="form-group span-2 med-span-1">
            <label for="name" class="tc-gray mt-0"><?= $Form_name ?></label>
            <input type="text" id="name" name="name" required class="input tc-gray" autocomplete="name">
          </div>
          <div class="form-group">
            <label for="phone" class="tc-gray mt-0"><?= $Form_phone ?></label>
            <input type="tel" id="phone" name="phone" required class="input tc-gray" autocomplete="tel">
          </div>
          <div class="form-group">
            <label for="email" class="tc-gray mt-0"><?= $Form_email ?></label>
            <input type="email" id="email" name="email" required class="input tc-gray" autocomplete="email">
          </div>
          <div class="form-group span-2 med-span-1">
            <p class="tc-gray mt-0"><?= $Form_typeUser ?></p>
            <div class="radio-group d-flex fw-wrap g-20 med-g-10">
              <?php foreach($Form_userType_options as $k => $option): ?>
                <input type="radio" name="usertype" id="<?= $option['id'] ?>" value="<?= $option['value'] ?>" <?= $k === 0 ? 'checked' : '' ?> class="radio">
                <label for="<?= $option['id'] ?>" class="tc-gray radio-label c-ter-s1 p-10 br-50 d-flex ai-center g-10 cursor-pointer m-0">
                  <svg class="radio-check-svg br-50 m-0" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="radio-check-path" d="M12.472 18.3808L21.241 9.32071C21.448 9.1069 21.6894 9 21.9653 9C22.2412 9 22.4827 9.1069 22.6896 9.32071C22.8965 9.53452 23 9.7886 23 10.0829C23 10.3773 22.8965 10.631 22.6896 10.8441L13.1962 20.6793C12.9893 20.8931 12.7479 21 12.472 21C12.196 21 11.9546 20.8931 11.7477 20.6793L7.29847 16.0824C7.09153 15.8686 6.9922 15.6149 7.00048 15.3212C7.00876 15.0276 7.11671 14.7735 7.32434 14.559C7.53197 14.3445 7.77788 14.2376 8.06208 14.2383C8.34627 14.239 8.59184 14.3459 8.79878 14.559L12.472 18.3808Z" fill="white"/>
                  </svg>
                  <span style="padding-right:10px"><?= $option['value'] ?></span>
                </label>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="form-group span-2 med-span-1">
            <label for="message" class="tc-gray mt-0"><?= $Form_message ?></label>
            <textarea id="message" name="message" rows="4" class="input tc-gray" placeholder="<?= $Form_messagePlaceholder ?>"></textarea>
          </div>
          <div class="form-group span-2 med-span-1 t-c">
            <button type="submit" class="btn big c-acc br-50 m-center"><?= $Form_btn ?></button>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>
