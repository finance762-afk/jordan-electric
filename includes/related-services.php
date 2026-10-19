<?php
/**
 * includes/related-services.php — "other services" block at the bottom of each /services/<slug>/ page
 * (required services component: services-grid + service-card-with-image, tint rotation 1-2-3).
 * No client photos are on disk yet, so cards use the icon fallback the homepage uses; once photos are
 * staged, add a .service-card__image <picture> above .service-card__body.
 *
 * Set before including:
 *   $relatedCurrent  slug of the page it sits on (excluded from the grid)       required
 *   $relatedHeading  question H2 (may contain <span class="text-accent">)        required, trusted markup
 *   $relatedAnswer   40-60 word answer paragraph                                required
 *   $relatedProse    one or two sentences under the subtitle                      optional
 * Card copy comes from includes/service-cards.php. Loop variables are prefixed $rel*.
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-cards.php';
$relCards = array_values(array_filter($services, function ($relSvc) use ($relatedCurrent) { return $relSvc['slug'] !== $relatedCurrent; }));
?>
<section class="section svc-related" aria-label="Other electrical services">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow-label">What We Do</span>
      <h2><?php echo $relatedHeading; ?></h2>
      <p class="hero-answer"><?php echo p1_esc($relatedAnswer); ?></p>
      <span class="section-subtitle">Wired for Excellence</span>
      <?php if (!empty($relatedProse)): ?><p class="prose"><?php echo p1_esc($relatedProse); ?></p><?php endif; ?>
    </div>
    <div class="services-grid">
      <?php foreach ($relCards as $relIdx => $relSvc):
        $relCopy = $serviceCardCopy[$relSvc['slug']] ?? ['icon' => 'zap', 'desc' => $relSvc['description'], 'bullets' => []];
        $relTint = ($relIdx % 3) + 1; ?>
      <article class="service-card-with-image card-tint-<?php echo $relTint; ?> reveal-up reveal-delay-<?php echo $relTint; ?>">
        <div class="service-card__body">
          <div class="service-card__icon"><?php icon($relCopy['icon'], 26); ?></div>
          <h3><?php echo p1_esc($relSvc['name']); ?></h3>
          <p class="service-card__desc"><?php echo p1_esc($relCopy['desc']); ?></p>
          <ul>
            <?php foreach ($relCopy['bullets'] as $relBullet): ?>
            <li><?php echo p1_esc($relBullet); ?></li>
            <?php endforeach; ?>
          </ul>
          <a href="/services/<?php echo p1_esc($relSvc['slug']); ?>/" class="service-card__cta">Learn more<span class="sr-only"> about <?php echo p1_esc(strtolower($relSvc['name'])); ?></span></a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    <p class="svc-related__hub reveal-up"><a class="btn btn-secondary" href="/services/">See all Jordan Electric services <?php icon('arrow-right', 18); ?></a></p>
  </div>
</section>
