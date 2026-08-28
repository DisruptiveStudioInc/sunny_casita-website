</main>

<footer class="c-b-dark all-tc-0">
  <div class="mw-1440">

    <div class="med-fd-col ai-start jc-center">
      <div class="w-100 fd-col ai-start med-ai-center med-mb-40">
        <img src="<?= e(assetUrl('/images/logo/logo.svg')); ?>" width="199" height="84" class="mw-200 med-m-center" loading="lazy" decoding="async" alt="<?= e($company_name); ?>">
        <ul class="fw-wrap med-jc-center g-10 mt-20">
          <li><a target="_blank" href="https://www.facebook.com/share/1BqMqwCSw6/?mibextid=wwXIfr" rel="noopener noreferrer" class="v-white icon small br-2 icon-facebook"></a></li>
          <li><a target="_blank" href="https://www.instagram.com/sunny_casita" rel="noopener noreferrer" class="v-white icon small br-2 icon-instagram"></a></li>
        </ul>
      </div>
      <div class="w-100 jc-end med-jc-center med-fd-col g-40 small-g-20 med-t-c">
        <ul class="menu-list link">
          <h3><?= $Footer_title_01; ?></h3>
          <?php foreach($Footer_menu['legal'] as $item): ?>
            <li><a href="<?= $item['link']; ?>"><?= $item['title']; ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
    <div class="t-c p-10 mt-20" style="border-top:1px solid #464f77;">
      <p><?= $Footer_Rights; ?></p>
    </div>
    <?php if (!$user_replica): ?>
      <a href="https://wa.me/<?= $constants['wame'] ?>" target="_blank" rel="noopener noreferrer" class="wa-btn br-50 d-flex ai-center jc-center <?= (isset($float_button) && $float_button) ? 'with-ref' : '' ?>">
        <svg class="d-block m-0" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M32.7578 8.08594C29.4844 4.80469 25.125 3 20.4922 3C10.9297 3 3.14844 10.7812 3.14844 20.3438C3.14844 23.3984 3.94531 26.3828 5.46094 29.0156L3 38L12.1953 35.5859C14.7266 36.9688 17.5781 37.6953 20.4844 37.6953H20.4922C30.0469 37.6953 38 29.9141 38 20.3516C38 15.7188 36.0312 11.3672 32.7578 8.08594ZM20.4922 34.7734C17.8984 34.7734 15.3594 34.0781 13.1484 32.7656L12.625 32.4531L7.17188 33.8828L8.625 28.5625L8.28125 28.0156C6.83594 25.7188 6.07812 23.0703 6.07812 20.3438C6.07812 12.3984 12.5469 5.92969 20.5 5.92969C24.3516 5.92969 27.9688 7.42969 30.6875 10.1562C33.4062 12.8828 35.0781 16.5 35.0703 20.3516C35.0703 28.3047 28.4375 34.7734 20.4922 34.7734ZM28.3984 23.9766C27.9688 23.7578 25.8359 22.7109 25.4375 22.5703C25.0391 22.4219 24.75 22.3516 24.4609 22.7891C24.1719 23.2266 23.3438 24.1953 23.0859 24.4922C22.8359 24.7812 22.5781 24.8203 22.1484 24.6016C19.6016 23.3281 17.9297 22.3281 16.25 19.4453C15.8047 18.6797 16.6953 18.7344 17.5234 17.0781C17.6641 16.7891 17.5937 16.5391 17.4844 16.3203C17.375 16.1016 16.5078 13.9688 16.1484 13.1016C15.7969 12.2578 15.4375 12.375 15.1719 12.3594C14.9219 12.3438 14.6328 12.3438 14.3438 12.3438C14.0547 12.3438 13.5859 12.4531 13.1875 12.8828C12.7891 13.3203 11.6719 14.3672 11.6719 16.5C11.6719 18.6328 13.2266 20.6953 13.4375 20.9844C13.6562 21.2734 16.4922 25.6484 20.8438 27.5312C23.5938 28.7188 24.6719 28.8203 26.0469 28.6172C26.8828 28.4922 28.6094 27.5703 28.9688 26.5547C29.3281 25.5391 29.3281 24.6719 29.2188 24.4922C29.1172 24.2969 28.8281 24.1875 28.3984 23.9766Z" fill="currentcolor"/>
        </svg>
      </a>
    <?php endif; ?>
  </div>
</footer>

<script src="<?= e(assetUrl('/js/site.js')); ?>" defer></script>
<?php if (isset($pageScripts) && is_array($pageScripts)): ?>
  <?php foreach($pageScripts as $script): ?>
    <script src="<?= e(assetUrl((string) $script)); ?>" defer></script>
  <?php endforeach; ?>
<?php endif; ?>
</body>
</html>
