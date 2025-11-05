  </main>

<!-- ============================================== -->
<!-- FOOTER -->
<!-- ============================================== -->

<footer class="c-b-dark all-tc-0">
  <div class="mw-1440">


    <?php $Condicion_1 =(isset($user_replica))? 'g-30 jc-between':''; ?>
    <?php $Condicion =(isset($user_replica))? '':'ai-center t-c fd-col'; ?>
    <div class="med-fd-col ai-start <?php echo $Condicion_1; ?>">
      <div class="w-50 small-w-100 small-jc-center <?php echo $Condicion; ?>">

        <img src="./images/logo/logo_low.png" class="mw-200 med-m-center" alt="Only Doctor Leadres">
        <ul class="fw-wrap med-jc-center g-10 mt-20">
          <li><a target="_blank" href="https://www.facebook.com/stellumglobal" class="v-white icon small br-2 icon-facebook"></a></li>
          <li><a target="_blank" href="https://www.instagram.com/stellumglobal" class="v-white icon small br-2 icon-instagram"></a></li>
          <li><a target="_blank" href="https://www.tiktok.com/@stellumglobal" class="v-white icon small br-2 icon-tiktok"></a></li>
          <li><a target="_blank" href="https://www.youtube.com/@StellumGlobal" class="v-white icon small br-2 icon-youtube"></a></li>
          <!-- <li><a target="_blank" href="https://www.linkedin.com/in/stellumglobal/" class="v-white icon small br-2 icon-linkedin"></a></li> -->
        </ul>
      </div>
      <?php if($user_replica): ?>
        <div class="w-100 jc-end med-jc-center med-fd-col g-40 small-g-20">
          <?php if(false): ?>
            <ul class="menu-list link">
              <h3><?php echo $Footer_title_01; ?></h3>
              <li><?php echo $Schedule; ?></li>
            </ul>
            <ul class="menu-list link">
              <h3><?php echo $Footer_title_02; ?></h3>
              <li><a href="?p=terms"><?php echo $Footer_link_01; ?></a></li>
              <li><a href="?p=politics"><?php echo $Footer_link_02; ?></a></li>
              <li><a href="?p=privacy_policy"><?php echo $Footer_link_03; ?></a></li>
            </ul>
          <?php endif; ?>
          <ul class="menu-list link">
            <h3><?php echo $Footer_title_03; ?></h3>
            <li><?php echo $Email; ?></li>
            <?php if(false): ?>
              <li><?php echo $Phone; ?></li>
              <li><?php echo $Address; ?></li>
            <?php endif; ?>
          </ul>
        </div>
      <?php endif; ?>
    </div>
    <div class="t-c p-10 mt-20" style="border-top:1px solid #464f77;">
      <p><?php echo $Footer_Rights; ?></p>
    </div>
  </div>
</footer>

<!-- ============================================== -->
<!-- SCRIPTS -->
<!-- ============================================== -->

<script src="./js/lozad.min.js"></script>
<script src="./js/script.js"></script>

</body>
</html>
