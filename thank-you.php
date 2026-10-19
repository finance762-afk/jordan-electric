<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup: Thank-you (/thank-you, every form's _next target) ---------------------------------------------
 * Noindexed utility page. "What to expect" says only what the site already promises elsewhere (requests are reviewed
 * promptly, then followed up to schedule) — no response-time figure, because that is an open question in
 * /content-confirmations.json. The Google-review button renders only once config.php has a review URL.
 */
$pageTitle       = 'Thank You | Jordan Electric, Newberry, FL';
$pageDescription = 'Thanks for contacting Jordan Electric in Newberry, FL. We received your request and will follow up to schedule.';
$metaDescription = $pageDescription;
$canonicalUrl    = $siteUrl . '/thank-you';
$ogImage         = '';
$noindex         = true;
$currentPage     = '';
$pageType        = 'other';
$bodyClass       = 'svc-page page-thanks';

$tyNext = [
    ['We review your request', 'Your details go straight to Jordan Electric, and every request is reviewed promptly.'],
    ['We follow up to schedule', 'Expect a call, text or email at the contact details you gave, to talk through the job and set a time.'],
    ['The work is planned with you', 'You hear what the job involves before it starts, and the work is completed to code.'],
];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?>

/* ---- Thank-you — page-specific (.ty-) ---- */
.page-thanks .svc-hero .hero-grid { grid-template-columns: minmax(0, 1fr); }
.page-thanks .svc-hero .hero-title { max-width: 18ch; }
.ty-check { display: grid; place-items: center; width: 64px; height: 64px; border-radius: 50%; background: var(--color-accent); color: var(--color-white); box-shadow: 0 0 0 8px color-mix(in srgb, var(--color-accent) 25%, transparent); margin-bottom: var(--space-xs); }
.ty-next { background: var(--color-paper); }
.ty-next__grid { display: grid; grid-template-columns: minmax(0, 2fr) minmax(0, 3fr); gap: clamp(var(--space-xl), 5vw, var(--space-4xl)); align-items: start; }
.ty-aside { display: grid; gap: var(--space-md); padding: var(--space-xl); border-radius: var(--radius-lg); background: var(--color-dark); color: var(--color-white); border-top: 4px solid var(--color-accent); box-shadow: var(--shadow-lg); }
.ty-aside h3 { margin: 0; color: var(--color-white); }
.ty-aside p { margin: 0; color: color-mix(in srgb, var(--color-white) 82%, transparent); }
.ty-aside .btn { justify-self: start; }
.ty-more { background: var(--color-surface); }
.ty-more__grid { list-style: none; margin: 0; padding: 0; display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: var(--space-md); }
.ty-more__grid a { display: grid; gap: var(--space-xs); height: 100%; padding: var(--space-lg); border-radius: var(--radius-lg); border: 1px solid var(--color-line); background: var(--color-paper); text-decoration: none; transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition); }
.ty-more__grid a:hover { transform: translateY(-3px); box-shadow: var(--shadow); border-color: color-mix(in srgb, var(--color-accent) 45%, var(--color-line)); }
.ty-more__grid li:nth-child(odd) a { background: var(--color-card-tint-1); }
.ty-more__grid li:nth-child(even) a { background: var(--color-card-tint-3); }
.ty-more__grid svg { color: var(--color-accent-dark); }
.ty-more__grid b { font-family: var(--font-heading); color: var(--color-ink); }
.ty-more__grid span { font-size: var(--fs-small); color: var(--color-ink-2); }
@media (max-width: 900px) { .ty-next__grid { grid-template-columns: 1fr; } }
@media (max-width: 480px) { .ty-aside .btn { justify-self: stretch; } }
@media (prefers-reduced-motion: reduce) { .ty-more__grid a { transition: none; } }
</style>

<!-- ============ 1. CONFIRMATION ============ -->
<section class="hero hero--interior svc-hero" aria-labelledby="ty-title">
  <span class="grain" aria-hidden="true"></span>
  <div class="container">
    <div class="hero-grid">
      <div class="hero-copy">
        <span class="ty-check"><?php icon('check', 32); ?></span>
        <span class="eyebrow">Request received</span>
        <h1 class="hero-title" id="ty-title">Thank you. We have your <span class="text-accent">request</span></h1>
        <p class="hero-answer">Jordan Electric received your message and will follow up to schedule. If it is urgent, call <a href="tel:<?php echo p1_esc($phoneE164); ?>"><?php echo p1_esc($phone); ?></a>.</p>
        <div class="hero-actions">
          <a class="btn btn-primary btn-lg hero-cta" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 20); ?>Call <?php echo p1_esc($phone); ?></a>
          <a class="link-call" href="/"><?php icon('arrow-left', 18); ?>Back to the homepage</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ 2. WHAT TO EXPECT ============ -->
<section class="section ty-next" aria-labelledby="ty-next-title">
  <div class="container">
    <div class="ty-next__grid">
      <div class="svc-head">
        <span class="eyebrow">What to expect next</span>
        <h2 id="ty-next-title">What happens after you contact Jordan Electric?</h2>
        <p class="answer-block">After you send a request, Jordan Electric reviews it promptly and follows up to schedule. You will hear from us using the phone number or email you provided.</p>
        <?php if (!empty($gbp['review_url'])): ?>
        <aside class="ty-aside">
          <h3>Worked with Jordan Electric before?</h3>
          <p>A Google review helps neighbors in Newberry find a local electrician.</p>
          <a class="btn btn-secondary" href="<?php echo p1_esc($gbp['review_url']); ?>" target="_blank" rel="noopener">Leave us a Google review</a>
        </aside>
        <?php endif; ?>
      </div>
      <ol class="svc-steps">
        <?php foreach ($tyNext as $tyStep): ?>
        <li><h3><?php echo p1_esc($tyStep[0]); ?></h3><p><?php echo p1_esc($tyStep[1]); ?></p></li>
        <?php endforeach; ?>
      </ol>
    </div>
  </div>
</section>

<!-- ============ 3. KEEP BROWSING ============ -->
<section class="section ty-more edge-parallelogram-top" aria-labelledby="ty-more-title">
  <div class="container">
    <div class="svc-head">
      <span class="eyebrow">While you wait</span>
      <h2 id="ty-more-title">Which Jordan Electric services can you read about now?</h2>
      <p>Jordan Electric offers four electrical services in Newberry and across Alachua County. Read about the one you asked about, or the others, while we get back to you.</p>
    </div>
    <ul class="ty-more__grid">
      <?php foreach ($services as $tySvc): ?>
      <li><a href="/services/<?php echo p1_esc($tySvc['slug']); ?>/"><?php icon('zap', 24); ?><b><?php echo p1_esc($tySvc['name']); ?></b><span><?php echo p1_esc($tySvc['description']); ?></span></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
