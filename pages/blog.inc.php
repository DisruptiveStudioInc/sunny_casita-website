<section class="blog-hero c-b-dark">
  <div class="mw-1440 med blog-hero-inner">
    <p class="blog-kicker tc-acc uppercase m-0"><?= e($company_name); ?></p>
    <h1 class="h1-special blog-title tc-0 t-balance"><?= $labels['title']; ?></h1>
    <p class="h4 tc-0 t-pretty blog-intro"><?= e($labels['description']); ?></p>
  </div>
</section>

<section class="blog-index c-ter">
  <div class="mw-1440 med">
    <?php if (!empty($error)): ?>
      <div class="blog-notice c-0 br-20 p-30 mb-30" role="status">
        <p class="m-0 tc-gray"><?= e($error); ?></p>
      </div>
    <?php endif; ?>

    <div class="blog-layout">
      <aside class="blog-sidebar" aria-label="<?= e($labels['categories']); ?>">
        <div class="blog-filter-panel c-sec br-20">
          <h3 class="h5 tc-0 mt-0"><?= e($labels['categories']); ?></h3>
          <nav class="blog-filters">
            <a
              class="blog-filter <?= $selectedCategory === null ? 'active' : ''; ?>"
              href="<?= e($blogUrl); ?>"
              <?= $selectedCategory === null ? 'aria-current="page"' : ''; ?>
            >
              <span><?= e($labels['all_posts']); ?></span>
              <strong><?= e((string) $totalPosts); ?></strong>
            </a>
            <?php foreach ($categories as $category): ?>
              <a
                class="blog-filter <?= $selectedCategory === $category['key'] ? 'active' : ''; ?>"
                href="<?= e($blogUrl . '?' . http_build_query(['category' => $category['key']])); ?>"
                <?= $selectedCategory === $category['key'] ? 'aria-current="page"' : ''; ?>
              >
                <span><?= e($category['label']); ?></span>
                <strong><?= e((string) $category['count']); ?></strong>
              </a>
            <?php endforeach; ?>
          </nav>
        </div>
      </aside>

      <div class="blog-results">
        <?php if (!empty($posts)): ?>
          <div class="blog-grid">
            <?php foreach ($posts as $post): ?>
              <article class="blog-card c-0 br-20">
                <a href="<?= e($post['url']); ?>" class="blog-card-media d-block of-h">
                  <img
                    src="<?= e($post['cover']); ?>"
                    alt="<?= e($post['coverAlt']); ?>"
                    loading="lazy"
                    width="720"
                    height="460"
                  >
                </a>
                <div class="blog-card-body">
                  <?php if (!empty($post['categories'])): ?>
                    <ul class="blog-tags" aria-label="<?= e($labels['categories']); ?>">
                      <?php foreach ($post['categories'] as $category): ?>
                        <li><a href="<?= e($category['url']); ?>"><?= e($category['label']); ?></a></li>
                      <?php endforeach; ?>
                    </ul>
                  <?php endif; ?>

                  <h2 class="h3 t-balance">
                    <a href="<?= e($post['url']); ?>"><?= e($post['name']); ?></a>
                  </h2>
                  <p class="tc-gray t-pretty"><?= e($post['description']); ?></p>
                  <div class="blog-card-footer">
                    <time datetime="<?= e($post['dateRaw']); ?>"><?= e($post['date']); ?></time>
                    <a href="<?= e($post['url']); ?>" class="blog-read-link">
                      <?= e($labels['read_more']); ?><span aria-hidden="true">↗</span>
                    </a>
                  </div>
                </div>
              </article>
            <?php endforeach; ?>
          </div>

          <?php if ($totalPages > 1): ?>
            <nav class="blog-pagination" aria-label="<?= e($labels['page']); ?>">
              <?php if ($currentPage > 1): ?>
                <a class="btn small c-pri br-30" href="<?= e($pageHref($currentPage - 1)); ?>" rel="prev">
                  <?= e($labels['previous']); ?>
                </a>
              <?php endif; ?>

              <?php foreach ($pages as $page): ?>
                <?php if (is_string($page)): ?>
                  <span class="blog-page-ellipsis" aria-hidden="true"><?= e($page); ?></span>
                <?php elseif ($page === $currentPage): ?>
                  <span class="btn small c-acc br-30" aria-current="page"><?= e((string) $page); ?></span>
                <?php else: ?>
                  <a class="btn small c-0 br-30" href="<?= e($pageHref($page)); ?>"><?= e((string) $page); ?></a>
                <?php endif; ?>
              <?php endforeach; ?>

              <?php if ($currentPage < $totalPages): ?>
                <a class="btn small c-pri br-30" href="<?= e($pageHref($currentPage + 1)); ?>" rel="next">
                  <?= e($labels['next']); ?>
                </a>
              <?php endif; ?>
            </nav>
          <?php endif; ?>
        <?php else: ?>
          <div class="blog-empty c-0 br-20">
            <span aria-hidden="true">✦</span>
            <p class="h4 tc-sec"><?= e($labels['empty']); ?></p>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
