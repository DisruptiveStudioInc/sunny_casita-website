<article class="blog-article">
  <header class="blog-post-hero c-b-dark">
    <img
      src="<?= e($post['cover']); ?>"
      alt="<?= e($post['coverAlt']); ?>"
      class="blog-post-cover"
      width="1600"
      height="900"
      fetchpriority="high"
    >
    <div class="blog-post-shade"></div>

    <div class="mw-1080 med blog-post-heading">
      <nav class="blog-breadcrumbs" aria-label="Breadcrumb">
        <a href="<?= e(\Includes\Localization::url('home')); ?>"><?= e($GLOBALS['Menu_01'] ?? 'Home'); ?></a>
        <span aria-hidden="true">/</span>
        <a href="<?= e(\Includes\Localization::url('blog')); ?>">Blog</a>
      </nav>

      <?php if (!empty($post['categories'])): ?>
        <ul class="blog-tags light" aria-label="<?= e($labels['categories']); ?>">
          <?php foreach ($post['categories'] as $category): ?>
            <li><a href="<?= e($category['url']); ?>"><?= e($category['label']); ?></a></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>

      <h1 class="h1-special blog-post-title tc-0 t-balance"><?= e($post['name']); ?></h1>
      <div class="blog-post-meta">
        <span><?= e($labels['by']); ?> <?= e($post['author']); ?></span>
        <span aria-hidden="true">•</span>
        <time datetime="<?= e($post['dateRaw']); ?>"><?= e($post['date']); ?></time>
      </div>
    </div>
  </header>

  <section class="c-0">
    <div class="mw-1080 blog-prose-wrap">
      <div class="blog-prose">
        <?= $post['content']; ?>
      </div>

      <footer class="blog-article-footer">
        <a href="<?= e(\Includes\Localization::url('blog')); ?>" class="blog-back-link">
          <span aria-hidden="true">←</span><?= e($labels['back']); ?>
        </a>
      </footer>
    </div>
  </section>

  <?php if (!empty($relatedPosts)): ?>
    <section class="blog-related c-ter">
      <div class="mw-1440">
        <h2 class="h2 tc-sec t-c t-balance mt-0"><?= e($labels['related']); ?></h2>

        <div class="blog-related-grid">
          <?php foreach ($relatedPosts as $related): ?>
            <article class="blog-related-card c-0 br-20">
              <a href="<?= e($related['url']); ?>" class="blog-card-media d-block of-h">
                <img
                  src="<?= e($related['cover']); ?>"
                  alt="<?= e($related['coverAlt']); ?>"
                  loading="lazy"
                  width="560"
                  height="360"
                >
              </a>
              <div class="p-20">
                <time datetime="<?= e($related['dateRaw']); ?>"><?= e($related['date']); ?></time>
                <h3 class="h4 t-balance"><a href="<?= e($related['url']); ?>"><?= e($related['name']); ?></a></h3>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
</article>

<?php if (!empty($structuredData)): ?>
  <script type="application/ld+json"><?= $structuredData; ?></script>
<?php endif; ?>
