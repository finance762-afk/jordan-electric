<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup: 404 (served by .htaccess ErrorDocument 404 /404.php) ---------------------------------------
 * Sends a real 404 status (before any output) and is noindexed. The site has no search engine, so instead of a search
 * box the page lists where people usually mean to go. Links point only at pages that exist on disk.
 */
http_response_code(404);
$pageTitle       = 'Page Not Found | Jordan Electric, Newberry, FL';
$pageDescription = 'That page could not be found. Jordan Electric in Newberry, FL: browse electrical services, read the FAQ or call ' . $phone . '.';
$metaDescription = $pageDescription;
$canonicalUrl    = $siteUrl . '/404';
$ogImage         = '';
$noindex         = true;
$currentPage     = '';
$pageType        = 'other';
$bodyClass       = 'svc-page page-404';

$nfLinks = [
    ['/services/',                          'zap',          'Electrical services',          'Residential, commercial, generators and repairs'],
    ['/services/residential-electrical/',   'house',        'Residential electrical',       'New homes, panel upgrades and wiring'],
    ['/services/electrical-repairs/',       'wrench',       'Service calls and repairs',    'Outlets, lighting and tripping breakers'],
    ['/faq/',                               'info',         'Electrician FAQ',              'Licensing, permits, pricing and process'],
    ['/about/',                             'users',        'About Jordan Electric',        'A family-managed Newberry electrician'],
    ['/contact/',                           'mail',         'Contact us',                   'Send the form or call ' . $phone],
];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?>

/* ---- 404 — page-specific (.nf-) ---- */
.page-404 .svc-hero .hero-grid { grid-template-columns: minmax(0, 1fr); }
.page-404 .svc-hero .hero-title { max-width: 20ch; }
.nf-code { position: absolute; right: 4%; top: 50%; transform: translateY(-50%); z-index: -1; font-family: var(--font-accent); font-size: clamp(8rem, 5rem + 18vw, 20rem); line-height: .8; color: var(--color-white); opacity: .06; pointer-events: none; user-select: none; }
.nf-links { background: var(--color-paper); }
.nf-links__grid { list-style: none; margin: 0; padding: 0; display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: var(--space-md); }
.nf-links__grid li:nth-child(3n+1) a { background: var(--color-card-tint-1); }
.nf-links__grid li:nth-child(3n+2) a { background: var(--color-card-tint-3); }
.nf-links__grid li:nth-child(3n) a { background: var(--color-card-tint-2); }
.nf-links__grid a { display: grid; grid-template-columns: auto 1fr; gap: var(--space-xs) var(--space-md); height: 100%; padding: var(--space-lg); border-radius: var(--radius-lg); border: 1px solid var(--color-line); text-decoration: none; box-shadow: var(--shadow-sm); transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition); }
.nf-links__grid a:hover { transform: translateY(-3px); box-shadow: var(--shadow); border-color: color-mix(in srgb, var(--color-accent) 45%, var(--color-line)); }
.nf-links__grid svg { grid-row: span 2; color: var(--color-accent-dark); margin-top: var(--space-1); }
.nf-links__grid b { font-family: var(--font-heading); color: var(--color-ink); }
.nf-links__grid span { font-size: var(--fs-small); color: var(--color-ink-2); }
@media (max-width: 900px) { .nf-links__grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
@media (max-width: 560px) { .nf-links__grid { grid-template-columns: 1fr; } }
@media (prefers-reduced-motion: reduce) { .nf-links__grid a { transition: none; } }
</style>

<!-- ============ 1. HERO ============ -->
<section class="hero hero--interior svc-hero" aria-labelledby="nf-title">
  <span class="grain" aria-hidden="true"></span>
  <span class="nf-code" aria-hidden="true">404</span>
  <div class="container">
    <div class="hero-grid">
      <div class="hero-copy">
        <span class="eyebrow">Error 404</span>
        <h1 class="hero-title" id="nf-title">That page isn&rsquo;t on <span class="text-accent">this circuit</span></h1>
        <p class="hero-answer">The page you tried to reach has moved or doesn&rsquo;t exist. Try one of the pages below, or call Jordan Electric at <a href="tel:<?php echo p1_esc($phoneE164); ?>"><?php echo p1_esc($phone); ?></a>.</p>
        <div class="hero-actions">
          <a class="btn btn-primary btn-lg hero-cta" href="/">Back to the homepage</a>
          <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ 2. POPULAR PAGES ============ -->
<section class="section nf-links" aria-labelledby="nf-links-title">
  <div class="container">
    <div class="svc-head">
      <span class="eyebrow">Looking for something?</span>
      <h2 id="nf-links-title">Where do most visitors to Jordan Electric want to go?</h2>
      <p>Most people looking for Jordan Electric want the electrical services, the answers to common questions, or a way to reach the Newberry office. Start with one of these.</p>
    </div>
    <ul class="nf-links__grid">
      <?php foreach ($nfLinks as $nfL): ?>
      <li><a href="<?php echo p1_esc($nfL[0]); ?>"><?php icon($nfL[1], 24); ?><b><?php echo p1_esc($nfL[2]); ?></b><span><?php echo p1_esc($nfL[3]); ?></span></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<!-- ============ 3. CTA ============ -->
<section class="cta-banner texture-grain edge-curve-top svc-final" aria-labelledby="nf-final-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div>
      <span class="eyebrow">Need an electrician?</span>
      <h2 id="nf-final-title">Skip the hunt and tell us what you need</h2>
      <p>Jordan Electric reviews every request and follows up to schedule.</p>
    </div>
    <div class="actions">
      <a class="btn btn-primary btn-lg" href="/contact/">Contact Jordan Electric</a>
      <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
    </div>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
