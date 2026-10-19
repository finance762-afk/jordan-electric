<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup: Service areas hub (/service-areas/) ----------------------------------------------------------
 * build-plan.json lists ONE service area (Newberry), so the hub has one area card plus the county-level coverage the
 * client's own site states ("homeowners across Alachua County"). No other town is named: the research brief marks the
 * exact radius and town list as "confirm with owner", so none is invented. Add towns to config.php $areaPages (and
 * build their pages) when the owner confirms them; this hub renders every entry automatically.
 * The coverage graphic is a schematic (no GBP map embed or geo in the plan) and says so.
 */
$pageTitle       = 'Newberry & Alachua County Service Areas | Jordan Electric';
$pageDescription = 'Jordan Electric is an electrician based in Newberry, FL, serving homes and businesses across Alachua County. Call (352) 472-5511 to confirm your address.';
$metaDescription = $pageDescription;
$canonicalUrl    = $siteUrl . '/service-areas/';
$ogImage         = '';
$currentPage     = 'areas';
$pageType        = 'other';
$bodyClass       = 'svc-page page-areas-hub';

$hubAreaCopy = [
    'newberry' => [
        'blurb' => 'Home base. New-construction wiring in a growing town, upgrades in the historic downtown, and service runs on rural acreage toward the Gilchrist County line.',
        'facts' => ['Population 7,342 (2020 census)', 'National Register historic district', 'City permits through SmartGov'],
    ],
];
$hubAreas = p1_area_links();

$hubItems = [];
foreach ($hubAreas as $hubPos => $hubA) {
    $hubItems[] = ['@type' => 'ListItem', 'position' => $hubPos + 1, 'name' => $hubA['name'] . ', ' . $address['state'],
                   'url' => $siteUrl . '/service-areas/' . $hubA['slug'] . '/'];
}
$schemaMarkup = [
    "@context" => "https://schema.org",
    '@graph'   => [
        ['@type' => 'CollectionPage', '@id' => $canonicalUrl . '#webpage', 'url' => $canonicalUrl, 'name' => $pageTitle,
         'description' => $pageDescription, 'about' => ['@id' => p1_org_id()], 'mainEntity' => ['@id' => $canonicalUrl . '#areas'],
         'speakable' => ['@type' => 'SpeakableSpecification', 'cssSelector' => ['h1', '.hero-answer', '.answer-block']]],
        ['@type' => 'ItemList', '@id' => $canonicalUrl . '#areas', 'name' => 'Jordan Electric service areas', 'itemListElement' => $hubItems],
        ['@type' => 'Electrician', '@id' => p1_org_id(), 'name' => $siteName, 'url' => rtrim($siteUrl, '/') . '/',
         'telephone' => $phoneE164, 'areaServed' => p1_area_served()],
        ['@type' => 'BreadcrumbList', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => rtrim($siteUrl, '/') . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Service Areas', 'item' => $canonicalUrl],
        ]],
    ],
];
$schemaBlocks = [$schemaMarkup];   // head.php renders $schemaBlocks
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?>

/* ==========================================================================
   Service areas hub — page-specific composition (.ar-)
   Signature: the coverage schematic (rings around the home base) beside the area cards.
   ========================================================================== */
.ar-hero .hero-copy { max-width: 46rem; }
.ar-hero__cta { background: var(--color-accent); border-color: var(--color-accent); color: var(--color-white); box-shadow: 0 6px 0 var(--color-accent-dark), var(--shadow); }
.ar-hero__cta:hover { background: color-mix(in srgb, var(--color-accent) 88%, var(--color-white)); transform: translateY(-1px); }
.ar-hero__cta:active { transform: translateY(4px); box-shadow: 0 2px 0 var(--color-accent-dark); }
.ar-hero__grid { grid-template-columns: minmax(0, 1.25fr) minmax(0, 1fr); }

/* Coverage schematic */
.ar-map { margin: 0; display: grid; gap: var(--space-sm); justify-items: center; }
.ar-map svg { width: min(100%, 420px); height: auto; overflow: visible; }
.ar-map .ring { fill: none; stroke: color-mix(in srgb, var(--color-white) 28%, transparent); stroke-width: 1.5; }
.ar-map .ring--county { stroke-dasharray: 6 7; fill: color-mix(in srgb, var(--color-accent) 8%, transparent); }
.ar-map .ring--core { stroke: var(--color-accent-bright); stroke-width: 2; fill: color-mix(in srgb, var(--color-accent) 16%, transparent); }
.ar-map .tick { stroke: color-mix(in srgb, var(--color-white) 14%, transparent); stroke-width: 1; }
.ar-map .pin { fill: var(--color-accent-bright); }
.ar-map .pulse { fill: none; stroke: var(--color-accent-bright); stroke-width: 2; transform-origin: 50% 50%; transform-box: fill-box; animation: ar-pulse 2.8s var(--ease) infinite; }
.ar-map text { font-family: var(--font-accent); letter-spacing: .14em; text-transform: uppercase; fill: var(--color-white); font-size: 12px; }
.ar-map text.dim { fill: color-mix(in srgb, var(--color-white) 62%, transparent); font-size: 10.5px; }
.ar-map figcaption { font-size: var(--fs-small); color: color-mix(in srgb, var(--color-white) 70%, transparent); text-align: center; max-width: 34ch; }
@keyframes ar-pulse { 0% { transform: scale(.6); opacity: .9; } 100% { transform: scale(2.4); opacity: 0; } }

/* Area cards */
.ar-areas { background: var(--color-paper); }
.ar-areas__grid { display: grid; grid-template-columns: minmax(0, 7fr) minmax(0, 5fr); gap: clamp(var(--space-xl), 4vw, var(--space-3xl)); align-items: stretch; }
.ar-cards { display: grid; gap: var(--space-md); align-content: start; }
.ar-card { position: relative; display: grid; gap: var(--space-sm); padding: var(--space-xl); border-radius: var(--radius-lg); background: var(--color-card-tint-1); border: 1px solid var(--color-line); border-top: 4px solid var(--color-accent); box-shadow: var(--shadow-sm); transition: transform var(--transition), box-shadow var(--transition); }
.ar-card:hover { transform: translateY(-3px); box-shadow: var(--shadow); }
.ar-card__pin { width: 48px; height: 48px; border-radius: var(--radius); display: grid; place-items: center; background: var(--color-surface); border: 1px solid var(--color-line); color: var(--color-accent-dark); }
.ar-card h3 { margin: 0; font-size: var(--fs-h3); }
.ar-card p { margin: 0; color: var(--color-ink-2); }
.ar-card ul { list-style: none; margin: 0; padding: var(--space-md) 0 0; display: flex; flex-wrap: wrap; gap: var(--space-xs); border-top: 1px solid var(--color-line); }
.ar-card li { font-size: var(--fs-small); padding: .25rem .7rem; border-radius: 999px; background: var(--color-surface); border: 1px solid var(--color-line); }
.ar-card__cta { justify-self: start; display: inline-flex; align-items: center; gap: var(--space-xs); font-weight: 600; color: var(--color-accent-dark); text-decoration: none; min-height: 44px; }
.ar-card__cta:hover { text-decoration: underline; }
.ar-card--soon { background: var(--color-card-tint-2); border-top-color: var(--color-secondary); }

.ar-county { padding: var(--space-xl); border-radius: var(--radius-lg); background: var(--color-surface); border: 1px solid var(--color-line); display: grid; gap: var(--space-md); align-content: start; }
.ar-county h3 { margin: 0; font-size: var(--fs-h3); }
.ar-county p { margin: 0; color: var(--color-ink-2); }
.ar-county .btn { justify-self: start; }

/* Confirm-your-address strip */
.ar-confirm { background: var(--color-surface); }
.ar-confirm__grid { display: grid; grid-template-columns: minmax(0, 2fr) minmax(0, 3fr); gap: clamp(var(--space-xl), 5vw, var(--space-4xl)); align-items: start; }
.ar-confirm__grid > div { display: grid; gap: var(--space-md); }

@media (max-width: 900px) {
  .ar-hero__grid, .ar-areas__grid, .ar-confirm__grid { grid-template-columns: 1fr; }
}
@media (prefers-reduced-motion: reduce) {
  .ar-map .pulse { animation: none; opacity: 0; }
  .ar-card { transition: none; }
}
</style>

<!-- ============ 1. HERO (interior, type-led, coverage schematic) ============ -->
<section class="hero hero--interior svc-hero ar-hero" aria-labelledby="svc-hero-title">
  <span class="grain" aria-hidden="true"></span>
  <div class="container">
    <div class="hero-grid ar-hero__grid">
      <div class="hero-copy">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <ol>
            <li><a href="/">Home</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li><span aria-current="page">Service Areas</span></li>
          </ol>
        </nav>
        <span class="eyebrow">Service areas · <?php echo p1_esc($primaryCounty); ?></span>
        <h1 class="hero-title" id="svc-hero-title">Electrical services in <span class="text-accent">Newberry, FL</span> &amp; surrounding communities</h1>
        <p class="hero-answer">Jordan Electric is based in Newberry and serves homes and businesses across Alachua County. Start with the Newberry page, or call to confirm your address.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg ar-hero__cta" data-open-estimate>Request a quote</button>
          <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php icon('badge-check', 16); ?>License <?php echo p1_esc($licenseNumber); ?></li>
          <li><?php icon('map-pin', 16); ?>Based in Newberry</li>
          <li><?php icon('building-2', 16); ?>Residential + commercial</li>
        </ul>
      </div>
      <figure class="ar-map">
        <svg viewBox="0 0 400 400" role="img" aria-labelledby="ar-map-title ar-map-desc">
          <title id="ar-map-title">Schematic of the Jordan Electric service area</title>
          <desc id="ar-map-desc">Concentric rings centered on Newberry, the home base, inside the wider Alachua County service area. Not drawn to scale.</desc>
          <line class="tick" x1="200" y1="10" x2="200" y2="390"/>
          <line class="tick" x1="10" y1="200" x2="390" y2="200"/>
          <circle class="ring ring--county" cx="200" cy="200" r="180"/>
          <circle class="ring" cx="200" cy="200" r="120"/>
          <circle class="ring ring--core" cx="200" cy="200" r="58"/>
          <circle class="pulse" cx="200" cy="200" r="14"/>
          <circle class="pin" cx="200" cy="200" r="9"/>
          <text x="200" y="236" text-anchor="middle">Newberry</text>
          <text class="dim" x="200" y="46" text-anchor="middle">Alachua County</text>
        </svg>
        <figcaption>Schematic, not to scale: Newberry is the home base; the service area is Alachua County.</figcaption>
      </figure>
    </div>
  </div>
</section>

<article class="svc-article" aria-labelledby="svc-hero-title">

<!-- ============ 2. AREA CARDS ============ -->
<section class="section ar-areas" aria-labelledby="ar-areas-title">
  <div class="container-wide">
    <div class="section-title reveal-up">
      <span class="eyebrow">Where we work</span>
      <h2 id="ar-areas-title">Which communities does Jordan Electric serve around Newberry?</h2>
      <p class="answer-block">Jordan Electric serves Newberry, Florida and homes and businesses across Alachua County. Newberry is the home base and has its own page with local permit, power and storm details; call <?php echo p1_esc($phone); ?> to confirm availability elsewhere in the county.</p>
    </div>
    <div class="ar-areas__grid">
      <div class="ar-cards">
        <?php foreach ($hubAreas as $hubI => $hubA):
          $hubCopy = $hubAreaCopy[$hubA['slug']] ?? ['blurb' => 'Electrical service for homes and businesses in ' . $hubA['name'] . '.', 'facts' => []]; ?>
        <article class="ar-card <?php echo $hubI % 2 ? 'reveal-right' : 'reveal-left'; ?>" id="<?php echo p1_esc($hubA['slug']); ?>">
          <span class="ar-card__pin"><?php icon('map-pin', 24); ?></span>
          <h3><?php echo p1_esc($hubA['name'] . ', ' . $address['state']); ?></h3>
          <p><?php echo p1_esc($hubCopy['blurb']); ?></p>
          <?php if (!empty($hubCopy['facts'])): ?>
          <ul>
            <?php foreach ($hubCopy['facts'] as $hubFact): ?><li><?php echo p1_esc($hubFact); ?></li><?php endforeach; ?>
          </ul>
          <?php endif; ?>
          <?php if ($hubA['built']): ?>
          <a class="ar-card__cta" href="<?php echo p1_esc($hubA['href']); ?>">Electrician in <?php echo p1_esc($hubA['name']); ?>, <?php echo p1_esc($address['state']); ?> <?php icon('arrow-right', 18); ?></a>
          <?php endif; ?>
        </article>
        <?php endforeach; ?>
      </div>
      <aside class="ar-county reveal-right" aria-labelledby="ar-county-title">
        <span class="eyebrow">Beyond Newberry</span>
        <h3 id="ar-county-title">Is my Alachua County address covered?</h3>
        <p>Jordan Electric works for homeowners and businesses across Alachua County, not only inside Newberry city limits. Properties differ, so the quickest check is a call or a quote request with the address.</p>
        <p>Rural properties outside town often mean longer service runs and detached buildings. Mention them when you ask for a quote.</p>
        <a class="btn btn-secondary" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>Call <?php echo p1_esc($phone); ?></a>
      </aside>
    </div>
  </div>
</section>

<!-- ============ 3. WHAT YOU GET (dark, slant edge) ============ -->
<section class="section texture-grain slant-top svc-expert" aria-labelledby="ar-what-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <span class="floating-ring" aria-hidden="true"></span>
  <div class="container">
    <div class="svc-expert__grid">
      <div class="svc-expert__stat reveal-left">
        <b class="tabular"><?php echo count($services); ?></b>
        <span>electrical services, offered across the whole service area</span>
      </div>
      <div class="svc-expert__body reveal-right">
        <span class="eyebrow">Same service everywhere</span>
        <h2 id="ar-what-title">What electrical services does Jordan Electric offer in its service area?</h2>
        <p class="answer-block">Jordan Electric offers the same four services across Newberry and Alachua County: residential electrical, commercial electrical, generator installation, and electrical service calls and repairs. Each is handled by a Florida licensed contractor, license <?php echo p1_esc($licenseNumber); ?>.</p>
        <ul class="svc-diffs">
          <?php foreach ($services as $arSvc): ?>
          <li><?php icon('zap', 22); ?><b><a href="/services/<?php echo p1_esc($arSvc['slug']); ?>/"><?php echo p1_esc($arSvc['name']); ?></a></b><span><?php echo p1_esc($arSvc['description']); ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ============ 4. CONFIRM YOUR ADDRESS ============ -->
<section class="section ar-confirm edge-wave-top" aria-labelledby="ar-confirm-title">
  <div class="container">
    <div class="ar-confirm__grid">
      <div class="reveal-left">
        <span class="eyebrow">Next step</span>
        <h2 id="ar-confirm-title">How do I confirm Jordan Electric covers my property?</h2>
        <p class="answer-block">Call <?php echo p1_esc($phone); ?> or send a quote request with your address and what you need. Jordan Electric reviews every request promptly and follows up to confirm the area and schedule the work.</p>
      </div>
      <ol class="svc-steps reveal-right">
        <li><h3>Send the address</h3><p>Use the quote form or call. Include the town or road and the kind of job.</p></li>
        <li><h3>We review it</h3><p>Every request is reviewed promptly.</p></li>
        <li><h3>We follow up</h3><p>You hear back to confirm the area and set a time to look at the work.</p></li>
      </ol>
    </div>
  </div>
</section>

</article>

<!-- ============ 5. FINAL CTA ============ -->
<section class="cta-banner texture-grain edge-curve-top svc-final" aria-labelledby="ar-final-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container reveal-up">
    <div>
      <span class="eyebrow">Alachua County</span>
      <h2 id="ar-final-title">Need an electrician in Newberry or Alachua County?</h2>
      <p>Tell Jordan Electric where the job is and what it involves, and we will follow up to confirm the area and schedule a visit.</p>
    </div>
    <div class="actions">
      <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Request a quote</button>
      <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
    </div>
  </div>
  <svg class="svc-final__mark" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/></svg>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
