<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup: Services hub (/services/) --------------------------------------------------------------
 * Lists every service in config.php (4) with the required services-grid component, a "which service fits"
 * table and the shared request process. Copy traces to config.php and the client's own services page.
 * No client photos on disk yet: cards use the icon fallback, the hero is type-led.
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-cards.php';
$pageTitle       = 'Electrical Services in Newberry, FL | Jordan Electric';
$pageDescription = 'Residential and commercial electrical services, generator installation and repairs from Jordan Electric in Newberry, FL. Call (352) 472-5511 to start.';
$metaDescription = $pageDescription;
$canonicalUrl    = $siteUrl . '/services/';
$ogImage         = '';
$currentPage     = 'services';
$pageType        = 'other';
$bodyClass       = 'svc-page page-services-hub';

/* Which service fits: situation -> service slug (all from the client's own service descriptions) */
$hubFit = [
    ['Building a new home', 'residential-electrical', 'New construction wiring, planned with the build'],
    ['An outdated panel, or adding an EV charger', 'residential-electrical', 'Panel upgrades and system improvements'],
    ['Building or fitting out a commercial space', 'commercial-electrical', 'Commercial new construction and installations'],
    ['A business system that cannot keep up', 'commercial-electrical', 'Commercial system upgrades'],
    ['Keeping the power on through storms and outages', 'generator-installation', 'Backup generator systems for homes and businesses'],
    ['An outlet, light or circuit that stopped working', 'electrical-repairs', 'Troubleshooting and repair, residential or commercial'],
];
$hubNames = array_column($services, 'name', 'slug');

$hubSteps = [
    ['Request a quote', 'Send the form or call ' . $phone . ' with the address and what you need.'],
    ['We review it', 'Every request is reviewed promptly.'],
    ['We follow up to schedule', 'You get a quote and a time that works for you.'],
    ['Work completed to code', 'Residential or commercial, the standard is the same.'],
];

$hubItems = [];
foreach ($services as $hubPos => $hubSvc) {
    $hubItems[] = ['@type' => 'ListItem', 'position' => $hubPos + 1, 'name' => $hubSvc['name'], 'url' => $canonicalUrl . $hubSvc['slug'] . '/'];
}
$schemaBlocks = [[
    "@context" => "https://schema.org",
    "@graph"   => [
        ['@type' => 'CollectionPage', '@id' => $canonicalUrl . '#webpage', 'url' => $canonicalUrl, 'name' => $pageTitle, 'description' => $pageDescription,
         'about' => ['@id' => p1_org_id()], 'mainEntity' => ['@id' => $canonicalUrl . '#services'],
         'speakable' => ['@type' => 'SpeakableSpecification', 'cssSelector' => ['h1', '.hero-answer', '.answer-block']]],
        ['@type' => 'ItemList', '@id' => $canonicalUrl . '#services', 'name' => 'Jordan Electric services', 'itemListElement' => $hubItems],
        ['@type' => 'BreadcrumbList', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => rtrim($siteUrl, '/') . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Services', 'item' => $canonicalUrl],
        ]],
    ],
]];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?>

/* ==========================================================================
   Services hub — page-specific composition (.hub-)
   Signature: the four-card services grid as an index, plus the "which service fits" router table.
   ========================================================================== */
.hub-hero .hero-copy { max-width: 44rem; }
.hub-hero__cta { background: var(--color-accent); border-color: var(--color-accent); color: var(--color-white); box-shadow: 0 6px 0 var(--color-accent-dark), var(--shadow); }
.hub-hero__cta:hover { background: color-mix(in srgb, var(--color-accent) 88%, var(--color-white)); transform: translateY(-1px); }
.hub-hero__cta:active { transform: translateY(4px); box-shadow: 0 2px 0 var(--color-accent-dark); }
.hub-hero__grid { grid-template-columns: minmax(0, 1.4fr) minmax(0, 1fr); }
.hub-hero__index {
  list-style: none;
  margin: 0;
  padding: var(--space-lg);
  display: grid;
  gap: var(--space-xs);
  border-radius: var(--radius-lg);
  background: color-mix(in srgb, var(--color-white) 6%, transparent);
  border: 1px solid color-mix(in srgb, var(--color-white) 14%, transparent);
  counter-reset: hubidx;
}
.hub-hero__index li { counter-increment: hubidx; }
.hub-hero__index a {
  display: grid;
  grid-template-columns: auto 1fr auto;
  gap: var(--space-md);
  align-items: center;
  min-height: 48px;
  padding: var(--space-sm) var(--space-md);
  border-radius: var(--radius);
  color: var(--color-white);
  text-decoration: none;
  font-weight: 600;
  transition: background var(--transition), transform var(--transition);
}
.hub-hero__index a::before { content: counter(hubidx, decimal-leading-zero); font-family: var(--font-accent); color: var(--color-accent-bright); letter-spacing: .08em; }
.hub-hero__index a svg { color: color-mix(in srgb, var(--color-white) 60%, transparent); transition: transform var(--transition), color var(--transition); }
.hub-hero__index a:hover { background: color-mix(in srgb, var(--color-white) 8%, transparent); }
.hub-hero__index a:hover svg { transform: translateX(3px); color: var(--color-accent-bright); }

/* Services grid: all four, full width */
.hub-services { background: var(--color-paper); }
.hub-services .services-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); }
.hub-services .service-card-with-image h3 { font-size: var(--fs-h3); }

/* Hub cards share the related-services card treatment */
.hub-services .service-card-with-image{border-top:3px solid var(--color-primary);box-shadow:var(--shadow-sm)}
.hub-services .card-tint-2{border-top-color:var(--color-secondary)}
.hub-services .card-tint-3{border-top-color:var(--color-accent)}
.hub-services .service-card__body{padding:var(--space-xl) var(--space-lg) var(--space-lg);display:flex;flex-direction:column;align-items:flex-start;gap:var(--space-sm)}
.hub-services .service-card__icon{width:52px;height:52px;border-radius:var(--radius);display:grid;place-items:center;color:var(--color-accent-dark);background:var(--color-surface);border:1px solid var(--color-line);transition:transform var(--transition),background var(--transition),color var(--transition)}
.hub-services .service-card-with-image:hover .service-card__icon{transform:translateY(-2px) rotate(-4deg);background:var(--color-accent);color:var(--color-white)}
.hub-services .service-card__desc{color:var(--color-ink-2);font-size:var(--fs-small);margin:0}
.hub-services .service-card-with-image ul{list-style:none;margin:0;padding:var(--space-md) 0 0;width:100%;display:grid;gap:var(--space-xs);border-top:1px solid var(--color-line)}
.hub-services .service-card-with-image ul li{position:relative;padding-inline-start:var(--space-lg);font-size:var(--fs-small)}
.hub-services .service-card-with-image ul li::before{content:"";position:absolute;left:0;top:.45em;width:10px;height:10px;background:var(--color-accent);clip-path:polygon(55% 0,0 60%,45% 60%,35% 100%,100% 38%,55% 38%)}
.hub-services .service-card__cta{margin-top:auto;padding-top:var(--space-md);font-weight:600;color:var(--color-accent-dark);text-decoration:none}

/* Router table */
.hub-fit .svc-table tbody th { width: 34%; }
.hub-fit .svc-table td:last-child { font-weight: 600; }
.hub-fit .svc-table td:last-child a { color: var(--color-accent-dark); text-decoration: none; display: inline-flex; align-items: center; gap: var(--space-xs); }
.hub-fit .svc-table td:last-child a:hover { text-decoration: underline; }

/* Process strip: horizontal on desktop */
.hub-process { background: var(--color-surface); }
.hub-process__grid { display: grid; grid-template-columns: minmax(0, 2fr) minmax(0, 3fr); gap: clamp(var(--space-xl), 5vw, var(--space-4xl)); align-items: start; }
.hub-process__grid > div { display: grid; gap: var(--space-md); }
.hub-process .process-steps li span { font-size: var(--fs-small); }

@media (max-width: 1100px) {
  .hub-services .services-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}
@media (max-width: 900px) {
  .hub-hero__grid, .hub-process__grid { grid-template-columns: 1fr; }
}
@media (max-width: 600px) {
  .hub-services .services-grid { grid-template-columns: 1fr; }
}
@media (prefers-reduced-motion: reduce) {
  .hub-hero__index a, .hub-hero__index a svg { transition: none; }
}
</style>

<!-- ============ 1. HERO (interior, type-led, no form on the hub) ============ -->
<section class="hero hero--interior svc-hero hub-hero" aria-labelledby="svc-hero-title">
  <span class="grain" aria-hidden="true"></span>
  <div class="container">
    <div class="hero-grid hub-hero__grid">
      <div class="hero-copy">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <ol>
            <li><a href="/">Home</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li><span aria-current="page">Services</span></li>
          </ol>
        </nav>
        <span class="eyebrow">Electrical services · <?php echo p1_esc($address['city'] . ', ' . $address['state']); ?></span>
        <h1 class="hero-title" id="svc-hero-title">Electrical services in <span class="text-accent">Newberry, FL</span></h1>
        <p class="hero-answer">Jordan Electric offers residential and commercial electrical work, backup generator installation, and service calls and repairs for homes and businesses across Alachua County.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg hub-hero__cta" data-open-estimate>Request a quote</button>
          <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php icon('badge-check', 16); ?>License <?php echo p1_esc($licenseNumber); ?></li>
          <li><?php icon('building-2', 16); ?>Residential + commercial</li>
          <li><?php icon('map-pin', 16); ?><?php echo p1_esc($primaryCounty); ?></li>
        </ul>
      </div>
      <ol class="hub-hero__index" aria-label="Service pages">
        <?php foreach ($services as $hubSvc): ?>
        <li><a href="/services/<?php echo p1_esc($hubSvc['slug']); ?>/"><?php echo p1_esc($hubSvc['name']); ?><?php icon('arrow-right', 18); ?></a></li>
        <?php endforeach; ?>
      </ol>
    </div>
  </div>
</section>

<!-- ============ 2. SERVICES GRID (required component — all services) ============ -->
<section class="section hub-services" aria-label="Electrician services">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow-label">What We Do</span>
      <h2>What <span class="text-accent">electrical work</span> can Jordan Electric take on for your home or business?</h2>
      <p class="hero-answer">Jordan Electric, a Newberry electrical contractor serving Alachua County, takes on four kinds of work: residential electrical from new construction wiring to panel upgrades, commercial new construction and system upgrades, backup generator installation for homes and businesses, and service calls that troubleshoot and repair faulty outlets, lighting and system failures.</p>
      <span class="section-subtitle">Wired for Excellence</span>
      <p class="prose">Each service below has its own page covering the signs it is time, what the work includes, how it runs and the questions customers ask.</p>
    </div>
    <div class="services-grid">
      <?php foreach ($services as $hubIdx => $hubSvc):
        $hubCopy = $serviceCardCopy[$hubSvc['slug']] ?? ['icon' => 'zap', 'desc' => $hubSvc['description'], 'bullets' => []];
        $hubTint = ($hubIdx % 3) + 1; ?>
      <article class="service-card-with-image card-tint-<?php echo $hubTint; ?> reveal-up reveal-delay-<?php echo $hubTint; ?>">
        <div class="service-card__body">
          <div class="service-card__icon"><?php icon($hubCopy['icon'], 26); ?></div>
          <h3><?php echo p1_esc($hubSvc['name']); ?></h3>
          <p class="service-card__desc"><?php echo p1_esc($hubCopy['desc']); ?></p>
          <ul>
            <?php foreach ($hubCopy['bullets'] as $hubBullet): ?>
            <li><?php echo p1_esc($hubBullet); ?></li>
            <?php endforeach; ?>
          </ul>
          <a href="/services/<?php echo p1_esc($hubSvc['slug']); ?>/" class="service-card__cta">Learn more<span class="sr-only"> about <?php echo p1_esc(strtolower($hubSvc['name'])); ?></span></a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ 3. WHICH SERVICE FITS (router table) ============ -->
<section class="section svc-compare hub-fit edge-wave-top" aria-labelledby="hub-fit-title">
  <div class="container">
    <div class="svc-head reveal-up">
      <span class="eyebrow">Find your service</span>
      <h2 id="hub-fit-title">Which Jordan Electric service fits the job you have?</h2>
      <p class="answer-block">Match the job to the service: new homes, panels and EV chargers fall under residential electrical; commercial buildings and business systems under commercial; outage protection under generator installation; and anything that has stopped working under service calls and repairs. Not sure? Describe it and Jordan Electric will sort it.</p>
    </div>
    <div class="svc-table-wrap reveal-up">
      <table class="svc-table">
        <caption>One job can touch more than one service, such as a panel upgrade with a generator tie-in. One request covers both.</caption>
        <thead>
          <tr><th scope="col">Your situation</th><th scope="col">What it usually involves</th><th scope="col">Service page</th></tr>
        </thead>
        <tbody>
          <?php foreach ($hubFit as $hubRow): ?>
          <tr>
            <th scope="row"><?php echo p1_esc($hubRow[0]); ?></th>
            <td data-label="What it usually involves"><?php echo p1_esc($hubRow[2]); ?></td>
            <td data-label="Service page"><a href="/services/<?php echo p1_esc($hubRow[1]); ?>/"><?php echo p1_esc($hubNames[$hubRow[1]] ?? ''); ?> <?php icon('arrow-right', 16); ?></a></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- ============ 4. HOW A REQUEST WORKS ============ -->
<section class="section hub-process" aria-labelledby="hub-process-title">
  <div class="container">
    <div class="hub-process__grid">
      <div class="reveal-left">
        <span class="eyebrow">Getting started</span>
        <h2 id="hub-process-title">How does a job with Jordan Electric get started?</h2>
        <p class="answer-block">A job with Jordan Electric starts with a quote request by form or phone. Jordan Electric reviews every request promptly, follows up to scope the work and schedule it, and completes residential and commercial work alike to current electrical code.</p>
      </div>
      <ol class="process-steps reveal-right">
        <?php foreach ($hubSteps as $hubStep): ?>
        <li><b><?php echo p1_esc($hubStep[0]); ?></b><span><?php echo p1_esc($hubStep[1]); ?></span></li>
        <?php endforeach; ?>
      </ol>
    </div>
  </div>
</section>

<!-- ============ 5. FINAL CTA (dark, slant edge) ============ -->
<section class="cta-banner texture-grain slant-top svc-final" aria-labelledby="hub-final-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container reveal-up">
    <div>
      <span class="eyebrow">Request a quote</span>
      <h2 id="hub-final-title">Not sure which service you need?</h2>
      <p>Describe the job in a sentence or two. Jordan Electric reviews every request and follows up to schedule.</p>
    </div>
    <div class="actions">
      <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Request a quote</button>
      <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
    </div>
  </div>
  <svg class="svc-final__mark" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/></svg>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
