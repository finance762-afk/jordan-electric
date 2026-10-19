<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Content deck: Newberry, FL (service-area page) ---------------------------------------------------------
 * RESEARCH (read 2026-10-19). Every local specific on this page traces to one of these:
 *   https://en.wikipedia.org/wiki/Newberry,_Florida        SW corner of Alachua County; borders Gilchrist County to the west;
 *                                                          2020 census 7,342 (2010: 4,950); Newberry Historic District on the
 *                                                          National Register 1987; Watermelon Festival since 1946; Champions Park
 *                                                          (16 fields); Easton Newberry Sports Complex (100 acres); phosphate boom
 *                                                          from the 1880s, railway 1893, agriculture after 1914.
 *   https://www.floridastateparks.org/parks-and-trails/dudley-farm-historic-state-park
 *                                                          18730 W Newberry Rd (State Road 26), ~10 mi west of Gainesville;
 *                                                          National Historic Landmark Jan 13, 2021; 18 original buildings, 1880s-1930s.
 *   https://www.newberryfl.gov/1224/Building               City Building Department (fetched 2026-10-19): enforces the Florida Building
 *                                                          Code, National Electric Code and Fire Prevention Code; permits via the city's
 *                                                          SmartGov portal; inspections scheduled 24 hours ahead (page also says by
 *                                                          4:30 PM the day prior); 352-472-3927; Notice of Commencement for work of
 *                                                          $5,000 or more (F.S. 713.135). The commercial fee schedule PDF lists panel/
 *                                                          service replacement and new service. The copy tells readers to confirm with the city.
 *   https://www.floridapsc.com/library/FILINGS/2017/02056-2017/02056-2017.pdf   Clay Electric / City of Newberry territorial
 *                                                          agreement filed with the Florida PSC (Dec 2016). The city runs its own
 *                                                          electric utility. A 2022 WCJB report names a Duke Energy substation
 *                                                          feeding the city (left out of copy: territory by address is unconfirmed).
 *   https://www.weather.gov/media/jax/TropicalEventSummary/PSHJAX_2023AL10_Idalia_ImpactNarratives.pdf
 *                                                          Aug 30, 2023: spotter reported a large tree and power lines down about
 *                                                          3 miles NNE of Newberry.
 * DROPPED / NOT USED: elevation (Wikipedia says 85 ft; no second source, so no figure is printed - if one is added later it
 * must be a range); USDA zone (third-party maps say 9a on the 2023 map, 8b on 2012; irrelevant to electrical work, left out);
 * housing-stock age (aggregators conflict, no official city figure found); any neighborhood or subdivision name (none verified).
 * COMPANY CLAIMS are only those in config.php / the client's site: license EC 13016035, 20+ years hands-on (flagged in
 * content-confirmations.json), residential + commercial + generators + repairs. No frequency-of-work claims about Newberry.
 * Permits, free quotes and response times are NOT claimed (open questions in content-confirmations.json).
 */
$pageTitle       = 'Electrician in Newberry, FL: Wiring and Generators | Jordan';
$pageDescription = 'Jordan Electric wires new homes and businesses in Newberry, FL, with generators and repairs across Alachua County. License EC 13016035. Call (352) 472-5511.';
$metaDescription = $pageDescription;
$canonicalUrl    = $siteUrl . '/service-areas/newberry/';
$ogImage         = '';
$currentPage     = 'areas';
$pageType        = 'city';
$citySlug        = 'newberry';
$bodyClass       = 'svc-page page-area page-area-newberry';

$nbAngles = [
    ['milestone', 'A town that keeps adding homes',
     'Newberry grew from 4,950 people in the 2010 census to 7,342 in 2020. Growth like that means new-construction wiring: service entrances, panels and circuits sized for what the house will run, planned alongside the build.'],
    ['landmark', 'A historic downtown',
     'The Newberry Historic District has been on the National Register of Historic Places since 1987. Older buildings are a reason to inspect wiring before adding load: a new circuit is only as good as the panel and conductors behind it.'],
    ['trees', 'Acreage out toward the county line',
     'The city borders Gilchrist County to the west, and the land along State Road 26 opens up fast. Longer service runs and detached shops or barns are routine planning questions on rural properties like these.'],
];

/* Permit path: general sequence from the City of Newberry Building Department's own published process */
$nbPermit = [
    ['clipboard-list', 'Apply online', 'Permits are applied for through the city\'s SmartGov portal.'],
    ['shield-check', 'Built to two codes', 'The Building Department enforces the Florida Building Code and the National Electrical Code.'],
    ['hard-hat', 'Work gets done', 'On jobs valued at $5,000 or more, the city asks for a Notice of Commencement before work starts.'],
    ['calendar-check', 'Inspection scheduled', 'Inspections must be scheduled 24 hours ahead, by 4:30 PM the day before, through SmartGov or by calling 352-472-3927.'],
];

$nbLandmarks = [
    ['Dudley Farm Historic State Park', 'On West Newberry Road (State Road 26), about ten miles west of Gainesville. A National Historic Landmark since January 13, 2021, with 18 original buildings from the 1880s to the 1930s.'],
    ['Champions Park of Newberry', 'A 16-field sports park that draws more than 30,000 visitors a year.'],
    ['Easton Newberry Sports Complex', 'A 100-acre multipurpose facility that includes the Easton Foundation Archery Center.'],
    ['Newberry Watermelon Festival', 'Held annually since 1946, a reminder that the town turned to farming after the phosphate boom faded.'],
];

$nbFaqs = [
    ['q' => 'Does electrical work in Newberry need a permit?',
     'a' => 'Many jobs do. The City of Newberry Building Department handles permits through its SmartGov portal and enforces the Florida Building Code and the National Electrical Code. Panel changes and new service are the kind of work its fee schedule lists; swapping a fixture usually is not. Check with the city for your specific job.'],
    ['q' => 'Who supplies electricity in Newberry?',
     'a' => 'It depends on the address. The City of Newberry runs its own electric utility, and Clay Electric Cooperative serves other parts of the area under a territorial agreement filed with the Florida Public Service Commission. Look at your power bill before a panel or generator project, because the provider affects the utility side of the work.'],
    ['q' => 'Does Jordan Electric serve Newberry and the surrounding area?',
     'a' => 'Yes. Jordan Electric is based in Newberry and serves homes and businesses across Alachua County. Call ' . $phone . ' with your address to confirm availability for your property.'],
];

$nbCrumbs = generateBreadcrumbSchema([
    ['Home', rtrim($siteUrl, '/') . '/'],
    ['Service Areas', $siteUrl . '/service-areas/'],
    ['Newberry, FL', $canonicalUrl],
]);
unset($nbCrumbs['@context']);
$nbFaqNode = generateFAQSchema($nbFaqs);
unset($nbFaqNode['@context']);
$nbFaqNode['@id'] = $canonicalUrl . '#faq';
$nbCity = ['@type' => 'City', 'name' => 'Newberry', 'sameAs' => 'https://en.wikipedia.org/wiki/Newberry,_Florida',
           'containedInPlace' => ['@type' => 'AdministrativeArea', 'name' => 'Alachua County, FL']];
$schemaMarkup = [
    "@context" => "https://schema.org",
    '@graph'   => [
        // Same @id as the homepage Electrician node: this adds the Newberry areaServed without a second LocalBusiness
        ['@type' => 'Electrician', '@id' => p1_org_id(), 'name' => $siteName, 'url' => rtrim($siteUrl, '/') . '/',
         'telephone' => $phoneE164, 'areaServed' => $nbCity],
        ['@type' => 'Service', '@id' => $canonicalUrl . '#service', 'name' => 'New home electrician in Newberry, FL',
         'serviceType' => 'Residential and commercial electrical work', 'provider' => ['@id' => p1_org_id()], 'areaServed' => $nbCity,
         'url' => $canonicalUrl],
        ['@type' => 'WebPage', '@id' => $canonicalUrl . '#webpage', 'url' => $canonicalUrl, 'name' => $pageTitle,
         'description' => $pageDescription, 'about' => ['@id' => $canonicalUrl . '#service'],
         'isPartOf' => ['@type' => 'WebSite', 'name' => $siteName, 'url' => rtrim($siteUrl, '/') . '/'],
         'speakable' => ['@type' => 'SpeakableSpecification', 'cssSelector' => ['h1', '.hero-answer', '.answer-block']]],
        $nbCrumbs,
        $nbFaqNode,
    ],
];
$schemaBlocks = [$schemaMarkup];   // head.php renders $schemaBlocks

$heroFormService = '';
$heroFormTitle   = 'Request a quote in Newberry';
$heroFormTagline = 'Tell us about the job. Every request is reviewed promptly.';
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?>

/* ==========================================================================
   Newberry service-area page — page-specific composition (.nb-)
   Signature: the permit path, a four-stop route drawn from the City of Newberry's own process.
   ========================================================================== */
.page-area-newberry .svc-hero::before {
  inset: -45% -20% auto 25%;
  background:
    radial-gradient(closest-side, color-mix(in srgb, var(--color-accent) 30%, transparent), transparent 70%),
    radial-gradient(40% 50% at 100% 100%, color-mix(in srgb, var(--color-secondary) 26%, transparent), transparent 70%);
}
.nb-hero__coords {
  position: absolute;
  right: 5%;
  bottom: var(--space-xl);
  z-index: 0;
  font-family: var(--font-accent);
  font-size: var(--fs-eyebrow);
  letter-spacing: .22em;
  text-transform: uppercase;
  color: color-mix(in srgb, var(--color-white) 38%, transparent);
  pointer-events: none;
}

/* ---- Context: three angles, asymmetric grid with a stacked lead ---- */
.nb-context { background: var(--color-paper); }
.nb-context__grid { display: grid; grid-template-columns: minmax(0, 5fr) minmax(0, 7fr); gap: clamp(var(--space-xl), 5vw, var(--space-4xl)); align-items: start; }
.nb-context__lead { display: grid; gap: var(--space-md); position: sticky; top: calc(var(--nav-height) + var(--space-lg)); }
.nb-context__lead p:not(.answer-block) { margin: 0; color: var(--color-ink-2); }
.nb-angles { list-style: none; margin: 0; padding: 0; display: grid; gap: var(--space-md); counter-reset: nbangle; }
.nb-angle {
  position: relative;
  display: grid;
  grid-template-columns: auto 1fr;
  gap: var(--space-md) var(--space-lg);
  padding: var(--space-lg);
  border-radius: var(--radius-lg);
  background: var(--color-surface);
  border: 1px solid var(--color-line);
  box-shadow: var(--shadow-sm);
  transition: transform var(--transition), box-shadow var(--transition);
}
.nb-angle:nth-child(2) { margin-inline-start: clamp(0rem, 4vw, 3rem); background: var(--color-card-tint-2); }
.nb-angle:nth-child(3) { background: var(--color-card-tint-3); }
.nb-angle:hover { transform: translateY(-3px); box-shadow: var(--shadow); }
.nb-angle__icon { width: 52px; height: 52px; border-radius: var(--radius); display: grid; place-items: center; color: var(--color-accent-dark); background: var(--color-surface); border: 1px solid var(--color-line); }
.nb-angle h3 { margin: 0 0 var(--space-xs); font-size: var(--fs-h3); }
.nb-angle p { margin: 0; color: var(--color-ink-2); }

/* ---- Signature: permit path ---- */
.nb-permit { background: var(--color-surface); }
.nb-permit__head { display: grid; grid-template-columns: minmax(0, 3fr) minmax(0, 2fr); gap: clamp(var(--space-xl), 5vw, var(--space-4xl)); align-items: end; margin-bottom: var(--space-2xl); }
.nb-permit__head > div { display: grid; gap: var(--space-sm); }
.nb-permit__head p:not(.answer-block) { margin: 0; color: var(--color-ink-2); }
.nb-route { list-style: none; margin: 0 0 var(--space-xl); padding: 0; display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: var(--space-md); position: relative; counter-reset: nbstop; }
.nb-route::before { content: ""; position: absolute; left: 6%; right: 6%; top: 26px; height: 2px; background: repeating-linear-gradient(90deg, var(--color-secondary) 0 10px, transparent 10px 18px); opacity: .55; z-index: 0; }
.nb-stop { position: relative; z-index: 1; display: grid; gap: var(--space-sm); justify-items: start; counter-increment: nbstop; }
.nb-stop__dot { width: 52px; height: 52px; border-radius: 50%; display: grid; place-items: center; color: var(--color-white); background: var(--color-primary); border: 4px solid var(--color-surface); box-shadow: 0 0 0 1px var(--color-line), var(--shadow-sm); }
.nb-stop:nth-child(2) .nb-stop__dot { background: var(--color-secondary); }
.nb-stop:nth-child(3) .nb-stop__dot { background: var(--color-accent-dark); }
.nb-stop:last-child .nb-stop__dot { background: var(--color-accent); }
.nb-stop h3 { margin: 0; font-size: var(--fs-h3); }
.nb-stop h3::before { content: counter(nbstop, decimal-leading-zero) " "; font-family: var(--font-accent); font-size: var(--fs-small); letter-spacing: .12em; color: var(--color-accent-dark); display: block; }
.nb-stop p { margin: 0; color: var(--color-ink-2); font-size: var(--fs-small); }
.nb-permit__note { margin: 0; padding: var(--space-md) var(--space-lg); border-inline-start: 3px solid var(--color-secondary); background: var(--color-paper-2); border-radius: 0 var(--radius) var(--radius) 0; font-size: var(--fs-small); color: var(--color-ink-2); max-width: 70ch; }
.nb-permit__note a { color: var(--color-accent-dark); }

/* ---- Power & storms (dark band) ---- */
.nb-power__grid { display: grid; grid-template-columns: minmax(0, 7fr) minmax(0, 5fr); gap: clamp(var(--space-xl), 5vw, var(--space-4xl)); align-items: center; }
.nb-power__body { display: grid; gap: var(--space-md); }
.nb-power__body p { margin: 0; }
.nb-power__body .answer-block { color: var(--color-ink); }
.nb-power__card { padding: var(--space-xl); border-radius: var(--radius-lg); background: color-mix(in srgb, var(--color-white) 6%, transparent); border: 1px solid color-mix(in srgb, var(--color-white) 16%, transparent); display: grid; gap: var(--space-sm); }
.nb-power__card b { font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .16em; text-transform: uppercase; color: var(--color-accent-bright); }
.nb-power__card p { margin: 0; color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.nb-power__card a { color: var(--color-white); text-decoration: underline; text-underline-offset: 3px; }

/* ---- Landmarks ---- */
.nb-landmarks { background: var(--color-paper); }
.nb-landmarks__list { list-style: none; margin: 0; padding: 0; display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: var(--space-md); }
.nb-landmark { padding: var(--space-lg); border-radius: var(--radius-lg); background: var(--color-surface); border: 1px solid var(--color-line); border-top: 3px solid var(--color-primary); display: grid; gap: var(--space-xs); }
.nb-landmark:nth-child(2) { border-top-color: var(--color-secondary); }
.nb-landmark:nth-child(3) { border-top-color: var(--color-accent); }
.nb-landmark:nth-child(4) { border-top-color: var(--color-accent-dark); }
.nb-landmark h3 { margin: 0; font-size: var(--fs-h3); }
.nb-landmark p { margin: 0; color: var(--color-ink-2); font-size: var(--fs-small); }
.nb-landmarks__aside { margin-top: var(--space-lg); color: var(--color-muted); font-size: var(--fs-small); max-width: 70ch; }

/* ---- Why Jordan Electric: dark facts column ---- */
.nb-why__grid { display: grid; grid-template-columns: minmax(0, 5fr) minmax(0, 7fr); gap: clamp(var(--space-xl), 5vw, var(--space-4xl)); align-items: start; }
.nb-why__facts { list-style: none; margin: 0; padding: 0; display: grid; gap: var(--space-sm); }
.nb-why__facts li { display: grid; grid-template-columns: auto 1fr; gap: var(--space-md); align-items: start; padding: var(--space-md) var(--space-lg); border-radius: var(--radius); background: color-mix(in srgb, var(--color-white) 6%, transparent); border: 1px solid color-mix(in srgb, var(--color-white) 14%, transparent); }
.nb-why__facts svg { color: var(--color-accent-bright); margin-top: 2px; }
.nb-why__facts b { display: block; color: var(--color-white); }
.nb-why__facts span { color: color-mix(in srgb, var(--color-white) 82%, transparent); font-size: var(--fs-small); }
.nb-why__facts a { color: var(--color-white); text-decoration: underline; text-underline-offset: 3px; }

@media (max-width: 1000px) {
  .nb-route { grid-template-columns: repeat(2, minmax(0, 1fr)); row-gap: var(--space-xl); }
  .nb-route::before { display: none; }
  .nb-context__lead { position: static; }
}
@media (max-width: 900px) {
  .nb-context__grid, .nb-permit__head, .nb-power__grid, .nb-why__grid { grid-template-columns: 1fr; }
  .nb-angle:nth-child(2) { margin-inline-start: 0; }
  .nb-landmarks__list { grid-template-columns: 1fr; }
  .nb-hero__coords { display: none; }
}
@media (max-width: 560px) {
  .nb-route { grid-template-columns: 1fr; }
}
@media (prefers-reduced-motion: reduce) {
  .nb-angle { transition: none; }
}
</style>

<!-- ============ 1. HERO (interior, lead form) ============ -->
<section class="hero hero--interior svc-hero nb-hero" aria-labelledby="svc-hero-title">
  <span class="grain" aria-hidden="true"></span>
  <span class="nb-hero__coords" aria-hidden="true">Newberry · Alachua County · FL</span>
  <div class="container">
    <div class="hero-grid hero-grid--form">
      <div class="hero-copy">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <ol>
            <li><a href="/">Home</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li><a href="/service-areas/">Service Areas</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li><span aria-current="page">Newberry, FL</span></li>
          </ol>
        </nav>
        <span class="eyebrow">Home base · <?php echo p1_esc($primaryCounty); ?></span>
        <h1 class="hero-title" id="svc-hero-title">New home electrician in <span class="text-accent">Newberry, FL</span></h1>
        <p class="hero-answer">Jordan Electric, a Florida licensed electrical contractor based in Newberry, wires new homes and businesses and handles generators and repairs across Alachua County.</p>
        <div class="hero-actions btn-group">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Request a quote in Newberry</button>
          <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php icon('badge-check', 16); ?>License <?php echo p1_esc($licenseNumber); ?></li>
          <li><?php icon('map-pin', 16); ?>Based in Newberry</li>
          <li><?php icon('building-2', 16); ?>Residential + commercial</li>
        </ul>
      </div>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/hero-form.php'; ?>
    </div>
  </div>
</section>

<article class="svc-article" aria-labelledby="svc-hero-title">

<!-- ============ 2. CONTEXT: what electrical work in Newberry plans around ============ -->
<section class="section nb-context" aria-labelledby="nb-context-title">
  <div class="container-wide">
    <div class="nb-context__grid">
      <div class="nb-context__lead reveal-left">
        <span class="eyebrow">Electrician near me in Newberry</span>
        <h2 id="nb-context-title">What does electrical work in Newberry, FL look like?</h2>
        <p class="answer-block">Electrical work in Newberry is a mix of new-construction wiring for a growing town, careful upgrades inside older downtown buildings, and rural service runs on acreage toward the Gilchrist County line. Jordan Electric plans each job around which of the three it is.</p>
        <p>If you searched for an electrician near me in Newberry, the short version is that Jordan Electric is based here, holds Florida electrical contractor license <?php echo p1_esc($licenseNumber); ?>, and serves homes and businesses across <?php echo p1_esc($primaryCounty); ?>.</p>
      </div>
      <ul class="nb-angles">
        <?php foreach ($nbAngles as $nbI => $nbAngle): ?>
        <li class="nb-angle <?php echo ['reveal-right', 'reveal-up', 'reveal-left'][$nbI % 3]; ?> reveal-delay-<?php echo ($nbI % 3) + 1; ?>">
          <span class="nb-angle__icon"><?php icon($nbAngle[0], 26); ?></span>
          <div>
            <h3><?php echo p1_esc($nbAngle[1]); ?></h3>
            <p><?php echo p1_esc($nbAngle[2]); ?></p>
          </div>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<!-- ============ 3. SIGNATURE: permit path ============ -->
<section class="section nb-permit edge-torn-top" aria-labelledby="nb-permit-title">
  <div class="container">
    <div class="nb-permit__head">
      <div class="reveal-left">
        <span class="eyebrow">Permits and inspections</span>
        <h2 id="nb-permit-title">How do permits and inspections work for electrical jobs in Newberry?</h2>
        <p class="answer-block">In Newberry, the City Building Department issues electrical permits through its SmartGov portal and inspects work against the Florida Building Code and the National Electrical Code. Inspections must be scheduled 24 hours ahead, and the department's phone number is 352-472-3927.</p>
      </div>
      <p class="reveal-right">Rules and fees change, so treat this as orientation and confirm with the city before you plan a job. Ask any electrician you hire who pulls the permit and who books the inspection, and get the answer in the quote.</p>
    </div>
    <ol class="nb-route reveal-up" aria-label="The City of Newberry permit and inspection path">
      <?php foreach ($nbPermit as $nbStop): ?>
      <li class="nb-stop">
        <span class="nb-stop__dot"><?php icon($nbStop[0], 22); ?></span>
        <h3><?php echo p1_esc($nbStop[1]); ?></h3>
        <p><?php echo p1_esc($nbStop[2]); ?></p>
      </li>
      <?php endforeach; ?>
    </ol>
    <p class="nb-permit__note reveal-up">Source: the <a href="https://www.newberryfl.gov/1224/Building" target="_blank" rel="noopener">City of Newberry Building Department</a>, read in October 2026. For a new circuit, panel change or whole-house wiring, see <a href="/services/residential-electrical/">residential electrical services</a>; for a shop, office or kitchen, see <a href="/services/commercial-electrical/">commercial electrical services</a>.</p>
  </div>
</section>

<!-- ============ 4. POWER & STORMS (dark, slant edge) ============ -->
<section class="section texture-grain slant-top svc-expert nb-power" aria-labelledby="nb-power-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <span class="floating-ring" aria-hidden="true"></span>
  <div class="container">
    <div class="nb-power__grid">
      <div class="nb-power__body reveal-left">
        <span class="eyebrow">Power and storms</span>
        <h2 id="nb-power-title">What should Newberry homeowners know about power and backup generators?</h2>
        <p class="answer-block">Newberry homeowners should know two things: which utility serves the address, and that storms can interrupt power here. Jordan Electric installs backup generator systems for homes and businesses in Newberry, tied into the existing electrical setup so the essentials stay on.</p>
        <p>Newberry runs its own municipal electric utility, and Clay Electric Cooperative also serves the area, so your power bill tells you which one applies to your property. Either way, a generator is an electrical project: it has to connect through the panel correctly, and the best time to plan it is before the season starts. Read more on the <a href="/services/generator-installation/">generator installation</a> page.</p>
      </div>
      <aside class="nb-power__card reveal-right" aria-label="A local storm note">
        <b>Local on the record</b>
        <p>During Hurricane Idalia on August 30, 2023, a National Weather Service spotter reported a large tree and power lines blown down about three miles north-northeast of Newberry.</p>
        <p>Florida's Atlantic hurricane season runs June 1 to November 30. <a href="/services/electrical-repairs/">Electrical repairs</a> after storm damage and generator planning before it both start with a call to <a href="tel:<?php echo p1_esc($phoneE164); ?>"><?php echo p1_esc($phone); ?></a>.</p>
      </aside>
    </div>
  </div>
</section>

<!-- ============ 5. SERVICES AVAILABLE IN NEWBERRY (required services component) ============ -->
<?php
$relatedCurrent = '';
$relatedHeading = 'Which <span class="text-accent">electrical services</span> can you get in Newberry, FL?';
$relatedAnswer  = 'Jordan Electric offers four services in Newberry: residential electrical work from new construction wiring to panel upgrades, commercial electrical work for local businesses, backup generator installation for homes and businesses, and service calls and repairs for faulty outlets, lighting and system failures, across Alachua County.';
$relatedProse   = 'Each service below links to its own page with the work, the process and the questions customers ask.';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/related-services.php';
?>

<!-- ============ 6. LANDMARKS ============ -->
<section class="section nb-landmarks edge-wave-top" aria-labelledby="nb-landmarks-title">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow">Around town</span>
      <h2 id="nb-landmarks-title">Where in Newberry does Jordan Electric serve?</h2>
      <p class="answer-block">Jordan Electric serves Newberry from the historic district to the sports fields and farmland, plus the rest of Alachua County. These landmarks are listed for orientation, so you can tell at a glance that your address is in the service area.</p>
    </div>
    <ul class="nb-landmarks__list">
      <?php foreach ($nbLandmarks as $nbI => $nbMark): ?>
      <li class="nb-landmark <?php echo $nbI % 2 ? 'reveal-right' : 'reveal-left'; ?> reveal-delay-<?php echo ($nbI % 3) + 1; ?>">
        <h3><?php echo p1_esc($nbMark[0]); ?></h3>
        <p><?php echo p1_esc($nbMark[1]); ?></p>
      </li>
      <?php endforeach; ?>
    </ul>
    <p class="nb-landmarks__aside">Not on the list? Call <a href="tel:<?php echo p1_esc($phoneE164); ?>"><?php echo p1_esc($phone); ?></a> with your address and Jordan Electric will confirm availability.</p>
  </div>
</section>

<!-- ============ 7. WHY JORDAN ELECTRIC (dark) ============ -->
<section class="section texture-grain svc-expert nb-why" aria-labelledby="nb-why-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container">
    <div class="nb-why__grid">
      <div class="reveal-left">
        <span class="eyebrow">Why Jordan Electric</span>
        <h2 id="nb-why-title">Why choose Jordan Electric for electrical work in Newberry?</h2>
        <p class="answer-block">Choose Jordan Electric for Newberry work because the company is based in Newberry, holds Florida electrical contractor license <?php echo p1_esc($licenseNumber); ?>, and brings over <?php echo (int) $yearsExperience; ?> years of hands-on electrical experience to both residential and commercial projects.</p>
      </div>
      <ul class="nb-why__facts reveal-right">
        <li><?php icon('badge-check', 22); ?><div><b>License <?php echo p1_esc($licenseNumber); ?></b><span>Verify it yourself on the <a href="<?php echo p1_esc($licenseLookupUrl); ?>" target="_blank" rel="noopener">Florida DBPR license search</a>.</span></div></li>
        <li><?php icon('map-pin', 22); ?><div><b>Based in Newberry</b><span>The mailing address is PO Box 215, Newberry, FL 32669, and the service area is <?php echo p1_esc($primaryCounty); ?>.</span></div></li>
        <li><?php icon('house', 22); ?><div><b>New homes to older buildings</b><span>New construction wiring, panel and system upgrades, and repairs, handled by the same contractor.</span></div></li>
        <li><?php icon('building-2', 22); ?><div><b>Homes and businesses</b><span>Commercial new construction, system upgrades and installations alongside residential work.</span></div></li>
      </ul>
    </div>
  </div>
</section>

<!-- ============ 8. FAQ ============ -->
<section class="section svc-faq edge-curve-top" aria-labelledby="nb-faq-title">
  <div class="container">
    <div class="svc-head reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="nb-faq-title">What do Newberry customers ask about hiring an electrician?</h2>
      <p>Newberry customers hiring an electrician usually ask about permits, which utility serves their address, and whether Jordan Electric covers their street. The three answers below come from city and utility sources and the company's own service area.</p>
    </div>
    <div class="faq-grid reveal-up">
      <?php foreach ($nbFaqs as $nbFi => $nbFaq): ?>
      <details class="faq"<?php echo $nbFi === 0 ? ' open' : ''; ?>>
        <summary><?php echo p1_esc($nbFaq['q']); ?></summary>
        <p class="faq-answer"><?php echo p1_esc($nbFaq['a']); ?></p>
      </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

</article>

<!-- ============ 9. FINAL CTA ============ -->
<section class="cta-banner texture-grain edge-curve-top svc-final" aria-labelledby="nb-final-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container reveal-up">
    <div>
      <span class="eyebrow">Newberry quote</span>
      <h2 id="nb-final-title">Ready to talk through your Newberry electrical project?</h2>
      <p>Tell Jordan Electric what you need at your Newberry home or business, and we will follow up to look at the job and schedule it.</p>
    </div>
    <div class="actions">
      <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Request a quote in Newberry</button>
      <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
    </div>
  </div>
  <svg class="svc-final__mark" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/></svg>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
