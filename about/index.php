<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup: About (/about/) -------------------------------------------------------------------------
 * Facts trace to config.php and the client's own site (jordanelectricllc.net/about, read 2026-10-19): family-managed,
 * locally connected to Alachua County, over 20 years of hands-on experience, established 2026, the five values and
 * the habits they list (show up when expected, communicate clearly, respect each property, do the work right the first
 * time). The owner is deliberately NOT named: the client's site says Jeff Jordan, intake says Mallory Jordan, and that
 * is an open question in /content-confirmations.json. No personal biography, no team photos, no insurance claim.
 * No client photos exist on disk yet (assets.images is empty), so this page is type-led like the homepage; the story
 * section has room for a split photo once job photos arrive. No gradient stand-ins are used.
 * Lead form: one mid-page .cta-band (v6.3), never a hero form on About.
 */
$pageTitle       = 'About Jordan Electric | Family-Managed Electrician in Newberry, FL';
$pageDescription = 'Jordan Electric is a family-managed electrical contractor in Newberry, FL with over 20 years of hands-on experience, serving homes and businesses across Alachua County.';
$metaDescription = $pageDescription;
$canonicalUrl    = $siteUrl . '/about/';
$ogImage         = '';
$currentPage     = 'about';
$pageType        = 'about';
$bodyClass       = 'svc-page page-about';

$aboutValues = [
    ['handshake',   'Honesty',            'You hear what was found and what it will take, in plain language, before the work starts.'],
    ['clock',       'Reliability',        'Jordan Electric shows up when expected and does what it said it would do.'],
    ['search',      'Attention to detail', 'Safety and precision on every connection, because the work stays behind a wall for decades.'],
    ['home',        'Respect',            'Every home and business is treated as someone&rsquo;s property, not just a job site.'],
    ['shield-check', 'Work that lasts',   'The job is done right the first time and finished to current electrical code.'],
];

$aboutMilestones = [
    ['Over ' . (int) $yearsExperience . ' years', 'Hands-on electrical experience', 'Residential service calls, new construction homes, commercial projects, system upgrades, troubleshooting, EV charger installations and backup generator systems.'],
    [(string) (int) $yearEstablished, 'Jordan Electric opens in Newberry', 'A personal and professional goal, opening a local shop, becomes a family-managed electrical contractor serving Alachua County.'],
    ['Today', 'Four service lines, one standard', 'Residential, commercial, generator installation and service calls and repairs, all held to the same safety-first standard.'],
];

$aboutCredentials = [
    ['badge-check', 'Florida electrical contractor license ' . $licenseNumber, 'Verify it yourself on the Florida DBPR public license search before you hire anyone for electrical work.'],
    ['map-pin',     'Based in ' . $address['city'] . ', ' . $address['state'], 'Family-managed and locally connected to ' . $primaryCounty . ', serving the surrounding areas too.'],
    ['users',       'Residential and commercial', 'One contractor for a new home, a business build-out, a generator or a repair call.'],
];

$schemaBlocks = [[
    '@context' => 'https://schema.org',
    '@graph'   => [
        ['@type' => 'AboutPage', '@id' => $canonicalUrl . '#webpage', 'url' => $canonicalUrl, 'name' => $pageTitle, 'description' => $pageDescription,
         'isPartOf' => ['@type' => 'WebSite', 'name' => $siteName, 'url' => rtrim($siteUrl, '/') . '/'],
         'about' => ['@id' => p1_org_id()], 'mainEntity' => ['@id' => p1_org_id()],
         'speakable' => ['@type' => 'SpeakableSpecification', 'cssSelector' => ['h1', '.hero-answer', '.answer-block']]],
        ['@type' => 'BreadcrumbList', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => rtrim($siteUrl, '/') . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'About', 'item' => $canonicalUrl],
        ]],
    ],
]];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/cta-band.css'; ?>

/* ==========================================================================
   About — page-specific composition (.ab-)
   Signature: milestone rail (C7) that runs left to right on desktop; story + spec plate asymmetric split;
   values as a staggered tinted row. Photos are not on disk yet, so nothing here depends on an image.
   ========================================================================== */
.page-about .svc-hero::before {
  inset: -30% auto auto -15%;
  background:
    radial-gradient(closest-side, color-mix(in srgb, var(--color-accent) 22%, transparent), transparent 70%),
    radial-gradient(50% 60% at 100% 100%, color-mix(in srgb, var(--color-secondary) 26%, transparent), transparent 70%);
}
.page-about .svc-hero .hero-grid { grid-template-columns: minmax(0, 1fr); }
.page-about .svc-hero .hero-title { max-width: 22ch; }
.ab-hero__spark { position: absolute; right: 6%; top: 18%; z-index: -1; color: var(--color-accent); opacity: .12; pointer-events: none; }

/* ---- Story: asymmetric 7/5 with a sticky spec plate ---- */
.ab-story { background: var(--color-paper); }
.ab-story__grid { display: grid; grid-template-columns: minmax(0, 7fr) minmax(0, 5fr); gap: clamp(var(--space-xl), 6vw, var(--space-4xl)); align-items: start; }
.ab-story__copy { display: grid; gap: var(--space-md); }
.ab-story__copy > p { margin: 0; max-width: 62ch; color: var(--color-ink-2); }
.ab-story__copy h2 { margin: 0; }
.ab-plate {
  position: sticky;
  top: calc(var(--nav-height) + var(--space-xl));
  display: grid;
  gap: var(--space-md);
  padding: var(--space-xl);
  border-radius: var(--radius-lg);
  background: var(--color-dark);
  color: var(--color-white);
  box-shadow: var(--shadow-lg);
  border-top: 4px solid var(--color-accent);
  margin: 0;
}
.ab-plate__head { display: flex; align-items: center; justify-content: space-between; gap: var(--space-md); font-family: var(--font-heading); font-size: var(--fs-h3); }
.ab-plate__head svg { color: var(--color-accent-bright); }
.ab-plate dl { margin: 0; display: grid; gap: 0; }
.ab-plate dl > div { display: grid; grid-template-columns: 7.5rem 1fr; gap: var(--space-sm); padding: var(--space-sm) 0; border-top: 1px solid color-mix(in srgb, var(--color-white) 14%, transparent); }
.ab-plate dt { font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .14em; text-transform: uppercase; color: color-mix(in srgb, var(--color-white) 62%, transparent); }
.ab-plate dd { margin: 0; color: color-mix(in srgb, var(--color-white) 92%, transparent); font-size: var(--fs-small); }
.ab-plate__stat { display: flex; align-items: baseline; gap: var(--space-sm); padding-top: var(--space-md); border-top: 1px solid color-mix(in srgb, var(--color-white) 14%, transparent); }
.ab-plate__stat b { font-family: var(--font-accent); font-size: clamp(3rem, 2rem + 3vw, 4.5rem); line-height: .9; color: var(--color-accent-bright); }
.ab-plate__stat span { font-family: var(--font-accent); font-size: var(--fs-small); letter-spacing: .12em; text-transform: uppercase; color: color-mix(in srgb, var(--color-white) 75%, transparent); }

/* ---- Values: five tinted tiles, alternating lift ---- */
.ab-values { background: var(--color-surface); }
.ab-values__grid { list-style: none; margin: 0; padding: 0; display: grid; grid-template-columns: repeat(5, minmax(0, 1fr)); gap: var(--space-md); align-items: start; }
.ab-value {
  display: grid;
  gap: var(--space-xs);
  align-content: start;
  padding: var(--space-lg);
  border-radius: var(--radius-lg);
  border: 1px solid var(--color-line);
  box-shadow: var(--shadow-sm);
  transition: transform var(--transition), box-shadow var(--transition);
}
.ab-value:nth-child(5n+1) { background: var(--color-card-tint-1); }
.ab-value:nth-child(5n+2) { background: var(--color-card-tint-3); }
.ab-value:nth-child(5n+3) { background: var(--color-card-tint-2); }
.ab-value:nth-child(5n+4) { background: var(--color-card-tint-1); }
.ab-value:nth-child(5n) { background: var(--color-card-tint-3); }
.ab-value:nth-child(even) { transform: translateY(var(--space-lg)); }
.ab-value:hover { box-shadow: var(--shadow); }
.ab-value svg { color: var(--color-accent-dark); }
.ab-value h3 { margin: 0; font-size: var(--fs-h3); }
.ab-value p { margin: 0; font-size: var(--fs-small); color: var(--color-ink-2); }
.ab-values .svc-head { margin-bottom: clamp(var(--space-xl), 4vw, var(--space-3xl)); }

/* ---- Signature: milestone rail ---- */
.ab-miles { background: var(--color-paper-2); }
.ab-rail { list-style: none; margin: 0; padding: 0; display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: var(--space-lg); position: relative; counter-reset: abmile; }
.ab-rail::before { content: ""; position: absolute; left: 0; right: 0; top: 21px; height: 2px; background: linear-gradient(90deg, var(--color-accent), var(--color-line)); }
.ab-rail li { position: relative; display: grid; gap: var(--space-xs); padding-top: var(--space-3xl); counter-increment: abmile; }
.ab-rail li::before {
  content: counter(abmile, decimal-leading-zero);
  position: absolute;
  top: 0;
  left: 0;
  width: 44px;
  height: 44px;
  border-radius: 50%;
  display: grid;
  place-items: center;
  font-family: var(--font-accent);
  color: var(--color-white);
  background: var(--color-primary);
  box-shadow: 0 0 0 6px var(--color-paper-2);
  z-index: 1;
}
.ab-rail li:last-child::before { background: var(--color-accent); }
.ab-rail__when { font-family: var(--font-accent); font-size: clamp(1.6rem, 1.2rem + 1.4vw, 2.4rem); line-height: 1; letter-spacing: -.01em; color: var(--color-ink); }
.ab-rail h3 { margin: 0; font-size: var(--fs-h3); }
.ab-rail p { margin: 0; color: var(--color-ink-2); font-size: var(--fs-small); max-width: 38ch; }

/* ---- Credentials ---- */
.ab-creds__grid { display: grid; grid-template-columns: minmax(0, 2fr) minmax(0, 3fr); gap: clamp(var(--space-xl), 5vw, var(--space-4xl)); align-items: start; }
.ab-creds__list { list-style: none; margin: 0; padding: 0; display: grid; gap: var(--space-md); }
.ab-creds__list li { display: grid; grid-template-columns: auto 1fr; gap: var(--space-xs) var(--space-md); padding: var(--space-md) var(--space-lg); border-radius: var(--radius-lg); border: 1px solid var(--color-line); background: var(--color-paper); }
.ab-creds__list li:first-child { border-inline-start: 4px solid var(--color-accent); background: var(--color-card-tint-3); }
.ab-creds__list svg { grid-row: span 2; color: var(--color-accent-dark); margin-top: var(--space-1); }
.ab-creds__list b { font-family: var(--font-heading); color: var(--color-ink); }
.ab-creds__list span { font-size: var(--fs-small); color: var(--color-ink-2); }
.ab-creds__list a { color: var(--color-accent-dark); text-decoration: underline; text-underline-offset: .18em; }

/* ---- Services row ---- */
.ab-services { background: var(--color-paper); }
.ab-services__grid { list-style: none; margin: 0; padding: 0; display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: var(--space-md); }
.ab-services__grid a { display: grid; gap: var(--space-xs); padding: var(--space-lg); height: 100%; border-radius: var(--radius-lg); border: 1px solid var(--color-line); background: var(--color-surface); text-decoration: none; transition: transform var(--transition), border-color var(--transition), box-shadow var(--transition); }
.ab-services__grid a:hover { transform: translateY(-3px); border-color: color-mix(in srgb, var(--color-accent) 45%, var(--color-line)); box-shadow: var(--shadow); }
.ab-services__grid svg { color: var(--color-accent-dark); }
.ab-services__grid b { font-family: var(--font-heading); }
.ab-services__grid span { font-size: var(--fs-small); color: var(--color-ink-2); }

@media (max-width: 1000px) {
  .ab-values__grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
  .ab-value:nth-child(even) { transform: none; }
  .ab-value:last-child { grid-column: span 2; }
}
@media (max-width: 900px) {
  .ab-story__grid, .ab-creds__grid { grid-template-columns: 1fr; }
  .ab-plate { position: static; }
  .ab-rail { grid-template-columns: 1fr; gap: var(--space-xl); }
  .ab-rail::before { left: 21px; right: auto; top: 0; bottom: 0; width: 2px; height: auto; background: linear-gradient(var(--color-accent), var(--color-line)); }
  .ab-rail li { padding-top: 0; padding-inline-start: var(--space-4xl); }
  .ab-rail p { max-width: none; }
}
@media (max-width: 560px) {
  .ab-values__grid { grid-template-columns: 1fr; }
  .ab-value:last-child { grid-column: auto; }
  .ab-plate dl > div { grid-template-columns: 1fr; gap: 0; }
}
@media (prefers-reduced-motion: reduce) {
  .ab-value, .ab-services__grid a { transition: none; }
}
</style>

<!-- ============ 1. HERO (interior, type-led — no hero form on About) ============ -->
<section class="hero hero--interior svc-hero" aria-labelledby="ab-hero-title">
  <span class="grain" aria-hidden="true"></span>
  <span class="ab-hero__spark" aria-hidden="true"><?php icon('zap', 160); ?></span>
  <div class="container">
    <div class="hero-grid">
      <div class="hero-copy">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <ol>
            <li><a href="/">Home</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li><span aria-current="page">About</span></li>
          </ol>
        </nav>
        <span class="eyebrow">About Jordan Electric · <?php echo p1_esc($address['city'] . ', ' . $address['state']); ?></span>
        <h1 class="hero-title" id="ab-hero-title">A family-managed electrician in <span class="text-accent">Newberry, FL</span></h1>
        <p class="hero-answer">Jordan Electric is a family-managed electrical contractor with over <?php echo (int) $yearsExperience; ?> years of hands-on experience, wiring homes and businesses across Alachua County.</p>
        <div class="hero-actions">
          <a class="btn btn-primary btn-lg hero-cta" href="#estimate">Request a quote</a>
          <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php icon('badge-check', 16); ?>License <?php echo p1_esc($licenseNumber); ?></li>
          <li><?php icon('zap', 16); ?>Over <?php echo (int) $yearsExperience; ?> years hands-on</li>
          <li><?php icon('map-pin', 16); ?>Alachua County</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<article class="svc-article" aria-labelledby="ab-hero-title">

<!-- ============ 2. COMPANY STORY (asymmetric, sticky spec plate) ============ -->
<section class="section ab-story" aria-labelledby="ab-story-title">
  <div class="container">
    <div class="ab-story__grid">
      <div class="ab-story__copy reveal-left">
        <span class="eyebrow">Our story</span>
        <h2 id="ab-story-title">Who is behind Jordan Electric in Newberry?</h2>
        <p class="answer-block">Jordan Electric is a family-managed electrical contractor based in Newberry, FL, established in <?php echo (int) $yearEstablished; ?> and locally connected to Alachua County. The company is new, and the experience behind it is not: over <?php echo (int) $yearsExperience; ?> years of hands-on electrical work.</p>
        <p>An early interest in electricity turned into a career, and opening a local shop became both a personal and a professional goal. Jordan Electric is that shop: a family-managed company rooted in Alachua County.</p>
        <p>That experience spans residential service calls, new construction homes, commercial projects, system upgrades, troubleshooting, EV charger installations and backup generator systems. Whether the job is a single circuit or a whole building, the approach is the same: safety first, precision on every connection, and work that lasts.</p>
        <p>Being local matters in practice. Jordan Electric works in the same Alachua County neighborhoods, on the same kinds of homes and businesses, and under the same local building departments as the people it serves, so a question about a job in Newberry gets an answer from someone who works here.</p>
        <p class="prose">Not sure which service fits? Start with the <a href="/services/">electrical services overview</a>, or read the answers on the <a href="/faq/">frequently asked questions</a> page.</p>
      </div>
      <aside class="ab-plate reveal-right" aria-label="Jordan Electric at a glance">
        <div class="ab-plate__head"><span><?php echo p1_esc($siteName); ?></span><?php icon('zap', 28); ?></div>
        <dl>
          <div><dt>Established</dt><dd><?php echo (int) $yearEstablished; ?></dd></div>
          <div><dt>Based in</dt><dd><?php echo p1_esc($address['city'] . ', ' . $address['state'] . ' ' . $address['zip']); ?></dd></div>
          <div><dt>Serving</dt><dd><?php echo p1_esc($primaryCounty); ?> and surrounding areas</dd></div>
          <div><dt>Managed</dt><dd>Family-managed, locally connected</dd></div>
          <div><dt>Work</dt><dd>Residential · Commercial · Generators · Service calls</dd></div>
          <div><dt>License</dt><dd><?php echo p1_esc($licenseNumber); ?> (Florida)</dd></div>
        </dl>
        <div class="ab-plate__stat"><b><?php echo (int) $yearsExperience; ?>+</b><span>years of hands-on experience</span></div>
      </aside>
    </div>
  </div>
</section>

<!-- ============ 3. MID-PAGE QUOTE BAND (the one lead form on About) ============ -->
<?php
$ctaBandEyebrow = 'Request a quote';
$ctaBandTitle   = 'Have a project in mind for Newberry or Alachua County?';
$ctaBandText    = 'Send the details and Jordan Electric will review your request and follow up to schedule.';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/cta-band.php';
?>

<!-- ============ 4. VALUES ============ -->
<section class="section ab-values" aria-labelledby="ab-values-title">
  <div class="container">
    <div class="svc-head reveal-up">
      <span class="eyebrow">What we stand for</span>
      <h2 id="ab-values-title">What does Jordan Electric promise every Newberry customer?</h2>
      <p class="answer-block">Jordan Electric promises five things on every job: honesty, reliability, attention to detail, respect for your property, and work done right the first time. They are the habits a family-managed company is judged on by its neighbors.</p>
    </div>
    <ul class="ab-values__grid">
      <?php foreach ($aboutValues as $abI => $abVal): ?>
      <li class="ab-value reveal-up reveal-delay-<?php echo ($abI % 4) + 1; ?>">
        <?php icon($abVal[0], 28); ?>
        <h3><?php echo $abVal[1]; ?></h3>
        <p><?php echo $abVal[2]; ?></p>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<!-- ============ 5. MILESTONES (signature rail) ============ -->
<section class="section ab-miles edge-parallelogram-top" aria-labelledby="ab-miles-title">
  <div class="container">
    <div class="svc-head reveal-up">
      <span class="eyebrow">Milestones</span>
      <h2 id="ab-miles-title">How did Jordan Electric get from a trade career to a Newberry shop?</h2>
      <p class="answer-block">Jordan Electric grew out of more than <?php echo (int) $yearsExperience; ?> years in the electrical trade and opened in <?php echo (int) $yearEstablished; ?> as a local, family-managed company.</p>
    </div>
    <ol class="ab-rail">
      <?php foreach ($aboutMilestones as $abM): ?>
      <li class="reveal-up">
        <span class="ab-rail__when"><?php echo p1_esc($abM[0]); ?></span>
        <h3><?php echo p1_esc($abM[1]); ?></h3>
        <p><?php echo p1_esc($abM[2]); ?></p>
      </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>

<!-- ============ 6. CERTIFICATIONS + CREDENTIALS (dark, slant edge) ============ -->
<section class="section texture-grain slant-top ab-creds" aria-labelledby="ab-creds-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="ab-creds__grid">
      <div class="svc-head reveal-left">
        <span class="eyebrow">Credentials</span>
        <h2 id="ab-creds-title">Is Jordan Electric a licensed electrician in Florida?</h2>
        <p class="answer-block">Yes. Jordan Electric holds Florida electrical contractor license <?php echo p1_esc($licenseNumber); ?>, and you can confirm it on the Florida DBPR license search. Checking a license takes a minute and is worth doing before any electrical job.</p>
        <p class="prose"><a href="<?php echo p1_esc($licenseLookupUrl); ?>" target="_blank" rel="noopener">Open the DBPR license search</a> and look up the number above. Jordan Electric lists only credentials it can point you to.</p>
      </div>
      <ul class="ab-creds__list reveal-right">
        <?php foreach ($aboutCredentials as $abC): ?>
        <li><?php icon($abC[0], 24); ?><b><?php echo p1_esc($abC[1]); ?></b><span><?php echo p1_esc($abC[2]); ?></span></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<!-- ============ 7. WHAT WE DO (internal links to the four services) ============ -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/service-cards.php'; ?>
<section class="section ab-services" aria-labelledby="ab-services-title">
  <div class="container">
    <div class="svc-head reveal-up">
      <span class="eyebrow">What we do</span>
      <h2 id="ab-services-title">Which electrical services does Jordan Electric offer in Alachua County?</h2>
      <p class="answer-block">Jordan Electric offers four services in Newberry and across Alachua County: residential electrical work, commercial electrical work, generator installation, and service calls and repairs. Each has its own page with the details.</p>
    </div>
    <ul class="ab-services__grid">
      <?php foreach ($services as $abS => $abSvc):
        $abCopy = $serviceCardCopy[$abSvc['slug']] ?? ['icon' => 'zap', 'desc' => $abSvc['description']]; ?>
      <li class="reveal-up reveal-delay-<?php echo ($abS % 4) + 1; ?>"><a href="/services/<?php echo p1_esc($abSvc['slug']); ?>/">
        <?php icon($abCopy['icon'], 26); ?>
        <b><?php echo p1_esc($abSvc['name']); ?></b>
        <span><?php echo p1_esc($abCopy['desc']); ?></span>
      </a></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

</article>

<!-- ============ 8. FINAL CTA (dark, curved edge) ============ -->
<section class="cta-banner texture-grain edge-curve-top svc-final" aria-labelledby="ab-final-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container reveal-up">
    <div>
      <span class="eyebrow">Work with a local electrician</span>
      <h2 id="ab-final-title">Ready to meet the electrician behind the work?</h2>
      <p>Call Jordan Electric or send a request. We review every one and follow up to schedule a time that works for you.</p>
    </div>
    <div class="actions">
      <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Request a quote</button>
      <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
    </div>
  </div>
  <svg class="svc-final__mark" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/></svg>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
