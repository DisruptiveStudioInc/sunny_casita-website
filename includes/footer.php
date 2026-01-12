</main>

<footer class="c-b-dark all-tc-0">
  <div class="mw-1440 <?= ($user_replica) ? '' : 'pt-60 pb-0' ?>">

    <div class="med-fd-col ai-start jc-center">
      <div class="w-100 fd-col ai-start med-ai-center med-mb-40">
        <img src="/images/logo/logo.svg" class="mw-200 med-m-center" alt="<?= $company_name; ?>">
        <ul class="fw-wrap med-jc-center g-10 mt-20">
          <li><a target="_blank" href="#" class="v-white icon small br-2 icon-facebook"></a></li>
          <li><a target="_blank" href="#" class="v-white icon small br-2 icon-instagram"></a></li>
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
  </div>
</footer>

<script src="/js/lozad.min.js"></script>
<script src="/js/script.js"></script>
</body>
</html>
