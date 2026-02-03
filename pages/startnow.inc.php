<!-- FORM -->
<section>
  <div class="mw-1080 min-h-dvh fd-col ai-center jc-center pt-150 pb-60">
    <h2 class="h1 t-c tc-sec m-0"><?= $StartNow_heroTitle ?></h2>
    <p class="h5 t-balance tc-gray mb-50 med-mb-30"><?= $StartNow_heroText ?></p>
    <div class="c-ter-h p-50 br-20 w-100 med-p-30 small-p-20">
      <form action="/api/form/startnow" method="POST" id="contact-form" class="form-grid" data-alerts="<?= $Alerts ?>">
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
          <label for="address" class="tc-gray mt-0"><?= $Form_address ?></label>
          <input type="text" id="address" name="address" required class="input tc-gray" autocomplete="address-line1">
        </div>
        <div class="form-group">
          <label for="city" class="tc-gray mt-0"><?= $Form_city ?></label>
          <input type="text" id="city" name="city" required class="input tc-gray" autocomplete="address-level2">
        </div>
        <div class="form-group">
          <label for="state" class="tc-gray mt-0"><?= $Form_state ?></label>
          <input type="text" id="state" name="state" required class="input tc-gray" autocomplete="address-level1">
        </div>
        <div class="form-group span-2 med-span-1">
          <label class="d-flex ai-center fd-row g-10 tc-gray m-0 cursor-pointer" style="width:fit-content">
            <input class="checkbox" type="checkbox" name="acceptance" value="accept" checked required style="appearance:checkbox;">
            <span class="checkbox-mark d-flex ai-center jc-center flex-shrink-0">
              <svg class="checkbox-mark-svg m-0" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="checkbox-mark-path" d="M12.472 18.3808L21.241 9.32071C21.448 9.1069 21.6894 9 21.9653 9C22.2412 9 22.4827 9.1069 22.6896 9.32071C22.8965 9.53452 23 9.7886 23 10.0829C23 10.3773 22.8965 10.631 22.6896 10.8441L13.1962 20.6793C12.9893 20.8931 12.7479 21 12.472 21C12.196 21 11.9546 20.8931 11.7477 20.6793L7.29847 16.0824C7.09153 15.8686 6.9922 15.6149 7.00048 15.3212C7.00876 15.0276 7.11671 14.7735 7.32434 14.559C7.53197 14.3445 7.77788 14.2376 8.06208 14.2383C8.34627 14.239 8.59184 14.3459 8.79878 14.559L12.472 18.3808Z" fill="white"/>
              </svg>
            </span>
            <?= $Form_acceptance ?>
          </label>
        </div>
        <div class="form-group span-2 med-span-1 t-c">
          <button type="submit" class="btn big c-acc br-50 m-center"><?= $StartNow_submit ?></button>
        </div>
      </form>
    </div>
    <p class="t-balance t-c mt-20 mb-0"><?= $StartNow_footNote ?></p>
  </div>
</section>
