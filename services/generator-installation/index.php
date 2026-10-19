<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup: Generator Installation (premium editorial service page) ---------------------------------
 * Client facts: "installs backup generator systems for homes and businesses, integrated safely with the
 * existing electrical setup" (services page) — nothing more is claimed. Brands, fuel types, transfer switches,
 * gas/propane hookups, surge protection and post-storm inspections are open questions in
 * /content-confirmations.json. Portable-vs-standby and hurricane-season facts are general public guidance
 * (NOAA season dates; CPSC/CDC generator-safety guidance), presented as general information.
 */
$svc             = p1_service_by_slug('generator-installation');
$pageTitle       = 'Generator Installation in Newberry, FL | Jordan Electric';
$pageDescription = 'Backup generator installation for homes and businesses in Newberry, FL and Alachua County, safely tied into your existing electrical system before storm season.';
$metaDescription = $pageDescription;
$canonicalUrl    = $siteUrl . '/services/generator-installation/';
$ogImage         = '';
$currentPage     = 'services';
$currentService  = 'generator-installation';
$pageType        = 'service';
$serviceSlug     = 'generator-installation';
$bodyClass       = 'svc-page page-generator';

$genSigns = [
    ['umbrella', 'Hurricane season, every year',
     'The Atlantic season runs June 1 to November 30. When a storm brings down lines across the region, repairs can take days to reach every road.'],
    ['droplets', 'A private well',
     'On a property with a well, the pump needs electricity. When the power goes out, so does running water.'],
    ['users', 'Someone at home who depends on power',
     'Powered medical equipment, a home office or a household that cannot ride out heat without air conditioning all raise the stakes.'],
    ['building-2', 'A business that cannot close',
     'Coolers, card readers, security systems and phones all stop with the power. A backup system keeps the essentials on.'],
];

/* Hurricane-season strip (NOAA: June 1 - November 30; peak activity mid-August to mid-October) */
$genMonths = [
    ['Jan', ''], ['Feb', ''], ['Mar', ''], ['Apr', ''], ['May', 'plan'],
    ['Jun', 'season'], ['Jul', 'season'], ['Aug', 'peak'], ['Sep', 'peak'], ['Oct', 'peak'], ['Nov', 'season'], ['Dec', ''],
];

$genIncluded = [
    ['Home backup systems', 'A backup generator sized and placed for the house and what has to stay on.'],
    ['Business backup systems', 'Backup power for the equipment a business cannot run without.'],
    ['Integration with existing wiring', 'The generator connected safely to the electrical system already in place.'],
    ['Panel work when it is needed', 'If the panel needs attention first, the same electrician handles it.'],
];

$genSteps = [
    ['List what has to stay on', 'Use the form or call ' . $phone . '. Write down the essentials: well pump, refrigerator, medical equipment, air conditioning, coolers or a server closet.'],
    ['We review and follow up', 'Every request is reviewed promptly, and Jordan Electric follows up to look at the property and the existing panel.'],
    ['Quote and schedule', 'You get a quote for the system and its connection, and a date that works. Spring is the easiest time to schedule.'],
    ['Installed and integrated to code', 'The generator is installed and tied into your existing electrical setup, completed to code, so it is ready before the next outage.'],
];

$genFaqs = [
    ['q' => 'Can Jordan Electric install a backup generator for my home or business?',
     'a' => 'Yes. Jordan Electric installs backup generator systems for homes and businesses in Newberry and across Alachua County, and integrates each one safely with the existing electrical setup so the generator works with the system you already have.'],
    ['q' => 'Can you help protect my home during Florida storms?',
     'a' => 'Yes, with backup power. A generator installed by Jordan Electric and tied into your home\'s wiring keeps the circuits you choose running when a storm takes the grid down. The best time to install one is before hurricane season starts on June 1, not after the forecast turns.'],
];

/* One JSON-LD @graph: Service + WebPage (speakable) + BreadcrumbList + FAQPage mirroring the visible FAQ */
$schemaMarkup = [
    "@context" => "https://schema.org",
    "@graph"   => p1_service_page_nodes($svc, $canonicalUrl, $pageTitle, $pageDescription, 'Backup generator installation', generateFAQSchema($genFaqs)),
];
$schemaBlocks = [$schemaMarkup];

$heroFormService = $svc['name'];
$heroFormTitle   = 'Request a generator quote';
$heroFormTagline = 'Home or business: tell us what has to stay on.';
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?>

/* ==========================================================================
   Generator Installation — page-specific composition (.gen-)
   Signature: hurricane-season calendar strip + portable vs standby table (C7).
   ========================================================================== */
.page-generator .svc-hero::before {
  inset: -50% -30% auto 30%;
  background:
    radial-gradient(closest-side, color-mix(in srgb, var(--color-accent) 36%, transparent), transparent 70%),
    radial-gradient(35% 45% at 0% 100%, color-mix(in srgb, var(--color-secondary) 22%, transparent), transparent 70%);
}
.gen-hero__pulse {
  position: absolute;
  right: 6%;
  top: calc(var(--nav-height) + var(--space-xl));
  width: 14px;
  height: 14px;
  border-radius: 50%;
  background: var(--color-accent);
  z-index: 0;
  animation: gen-pulse 2.8s var(--ease) infinite;
  pointer-events: none;
}
@keyframes gen-pulse {
  0%, 100% { box-shadow: 0 0 0 0 color-mix(in srgb, var(--color-accent) 50%, transparent); }
  50% { box-shadow: 0 0 0 16px color-mix(in srgb, var(--color-accent) 0%, transparent); }
}

/* ---- Signature: season strip ---- */
.gen-season { background: var(--color-surface); }
.gen-season__head { display: grid; grid-template-columns: minmax(0, 3fr) minmax(0, 2fr); gap: clamp(var(--space-xl), 5vw, var(--space-4xl)); align-items: end; margin-bottom: var(--space-2xl); }
.gen-season__head > div { display: grid; gap: var(--space-sm); }
.gen-season__head p:not(.answer-block) { margin: 0; color: var(--color-ink-2); }
.gen-months { list-style: none; margin: 0 0 var(--space-xl); padding: 0; display: grid; grid-template-columns: repeat(12, minmax(0, 1fr)); gap: var(--space-1); align-items: end; min-height: 150px; }
.gen-month {
  position: relative;
  display: grid;
  place-items: end center;
  min-height: 92px;
  padding: var(--space-sm) var(--space-1);
  border-radius: var(--radius);
  background: var(--color-paper-2);
  font-family: var(--font-accent);
  font-size: var(--fs-small);
  letter-spacing: .1em;
  text-transform: uppercase;
  color: var(--color-muted);
  transition: transform var(--transition);
}
.gen-month::before { content: ""; position: absolute; inset: auto var(--space-1) calc(100% - var(--space-xs)); height: 4px; border-radius: var(--radius-full); background: transparent; }
.gen-month--plan { background: var(--color-card-tint-2); color: var(--color-ink); }
.gen-month--plan::before { background: var(--color-secondary); }
.gen-month--season { background: var(--color-card-tint-3); color: var(--color-ink); min-height: 120px; }
.gen-month--season::before { background: var(--color-accent); }
.gen-month--peak { background: var(--color-accent-dark); color: var(--color-white); min-height: 150px; }
.gen-month--peak::before { background: var(--color-accent-bright); }
.gen-month:hover { transform: translateY(-3px); }
.gen-legend { display: flex; flex-wrap: wrap; gap: var(--space-sm) var(--space-xl); margin: 0 0 var(--space-3xl); padding: 0; list-style: none; font-size: var(--fs-small); color: var(--color-ink-2); }
.gen-legend li { display: inline-flex; align-items: center; gap: var(--space-xs); }
.gen-legend i { width: 14px; height: 14px; border-radius: var(--radius-sm); display: inline-block; }
.gen-legend .is-plan { background: var(--color-secondary); }
.gen-legend .is-season { background: var(--color-accent); }
.gen-legend .is-peak { background: var(--color-accent-dark); }
.gen-types .svc-table thead th:nth-child(2) { color: var(--color-ink); }
.gen-types .svc-table thead th:last-child { background: var(--color-dark); }
.gen-types .svc-table td:last-child { background: var(--color-card-tint-1); border-inline-start-color: var(--color-primary); }
.gen-types h3 { margin: 0 0 var(--space-md); }

/* Expert band on this page leads with the plug icon row */
.page-generator .svc-diffs li:first-child { border-color: color-mix(in srgb, var(--color-accent) 45%, transparent); }

@media (max-width: 900px) {
  .gen-season__head { grid-template-columns: 1fr; }
}
@media (max-width: 700px) {
  .gen-months { grid-template-columns: repeat(6, minmax(0, 1fr)); }
  .gen-month, .gen-month--season, .gen-month--peak { min-height: 64px; }
}
@media (prefers-reduced-motion: reduce) {
  .gen-hero__pulse { animation: none; }
  .gen-month { transition: none; }
}
</style>

<!-- ============ 1. HERO (interior, type-led, lead form) ============ -->
<section class="hero hero--interior svc-hero" aria-labelledby="svc-hero-title">
  <span class="grain" aria-hidden="true"></span>
  <span class="gen-hero__pulse" aria-hidden="true"></span>
  <div class="container">
    <div class="hero-grid hero-grid--form">
      <div class="hero-copy">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <ol>
            <li><a href="/">Home</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li><a href="/services/">Services</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li><span aria-current="page">Generator Installation</span></li>
          </ol>
        </nav>
        <span class="eyebrow">Backup power · <?php echo p1_esc($address['city'] . ', ' . $address['state']); ?></span>
        <h1 class="hero-title" id="svc-hero-title">Generator installation in <span class="text-accent">Newberry, FL</span></h1>
        <p class="hero-answer">Jordan Electric installs backup generator systems for homes and businesses in Newberry and across Alachua County, integrated safely with the electrical system already in place.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Request a generator quote</button>
          <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php icon('badge-check', 16); ?>License <?php echo p1_esc($licenseNumber); ?></li>
          <li><?php icon('battery-charging', 16); ?>Homes + businesses</li>
          <li><?php icon('umbrella', 16); ?>Season: Jun 1 – Nov 30</li>
        </ul>
      </div>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/hero-form.php'; ?>
    </div>
  </div>
</section>

<article class="svc-article" aria-labelledby="svc-hero-title">

<!-- ============ 2. PROBLEM STATEMENT ============ -->
<section class="section svc-problem" aria-labelledby="gen-problem-title">
  <div class="container">
    <div class="svc-problem__grid">
      <div class="reveal-left">
        <span class="eyebrow">Why backup power</span>
        <h2 id="gen-problem-title">Why do Newberry homes and businesses install backup generators?</h2>
        <p class="answer-block">Newberry homes and businesses install backup generators because Florida outages are a matter of when, not if: hurricane season runs June 1 to November 30, and summer thunderstorms drop lines too. A generator tied into the existing electrical system keeps the essentials running until the power returns.</p>
        <blockquote class="pull-quote">Plan backup power before the forecast cone points at Alachua County.</blockquote>
      </div>
      <ul class="svc-signs">
        <?php foreach ($genSigns as $genI => $genSign): ?>
        <li class="svc-sign <?php echo $genI % 2 ? 'reveal-right' : 'reveal-up'; ?> reveal-delay-<?php echo ($genI % 3) + 1; ?>">
          <?php icon($genSign[0], 24); ?>
          <h3><?php echo p1_esc($genSign[1]); ?></h3>
          <p><?php echo p1_esc($genSign[2]); ?></p>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<!-- ============ 3. SIGNATURE: season strip + portable vs standby ============ -->
<section class="section gen-season edge-torn-top" aria-labelledby="gen-season-title">
  <div class="container">
    <div class="gen-season__head">
      <div class="reveal-left">
        <span class="eyebrow">Timing</span>
        <h2 id="gen-season-title">When should you install a generator in north-central Florida?</h2>
        <p class="answer-block">Install a generator in the spring, before hurricane season opens on June 1. Activity peaks from mid-August to mid-October, and once a storm is in the forecast there is no longer time to plan, place and connect a system properly.</p>
      </div>
      <p class="reveal-right">Season dates are the National Hurricane Center's. Summer thunderstorms add outages of their own from June through September, season or not.</p>
    </div>
    <ol class="gen-months reveal-up" aria-label="Atlantic hurricane season by month">
      <?php foreach ($genMonths as $genMonth): ?>
      <li class="gen-month<?php echo $genMonth[1] !== '' ? ' gen-month--' . $genMonth[1] : ''; ?>"><?php echo p1_esc($genMonth[0]); ?><?php if ($genMonth[1] !== ''): ?><span class="sr-only"> (<?php echo $genMonth[1] === 'plan' ? 'best time to plan' : ($genMonth[1] === 'peak' ? 'peak of season' : 'hurricane season'); ?>)</span><?php endif; ?></li>
      <?php endforeach; ?>
    </ol>
    <ul class="gen-legend" aria-hidden="true">
      <li><i class="is-plan"></i>Plan and install</li>
      <li><i class="is-season"></i>Hurricane season</li>
      <li><i class="is-peak"></i>Peak activity</li>
    </ul>

    <div class="gen-types reveal-up">
      <h3>What is the difference between a portable and a standby generator?</h3>
      <p class="answer-block">A portable generator is a wheeled unit you start and connect by hand after the power fails; a standby generator sits outside permanently and starts on its own. Either one must feed the house through a proper connection, never through a wall outlet.</p>
      <div class="svc-table-wrap">
        <table class="svc-table">
          <caption>General comparison. Jordan Electric installs backup generator systems; ask which setup fits your property when you request a quote.</caption>
          <thead>
            <tr><th scope="col">Question</th><th scope="col">Portable generator</th><th scope="col">Standby generator</th></tr>
          </thead>
          <tbody>
            <tr><th scope="row">Fuel</th><td data-label="Portable generator">Usually gasoline; some run on propane too</td><td data-label="Standby generator">Natural gas or propane from a tank or utility line</td></tr>
            <tr><th scope="row">How it starts</th><td data-label="Portable generator">By hand, after you notice the outage</td><td data-label="Standby generator">Automatically through a transfer switch, usually within seconds</td></tr>
            <tr><th scope="row">What it powers</th><td data-label="Portable generator">A handful of chosen circuits</td><td data-label="Standby generator">Chosen circuits or the whole building, depending on size</td></tr>
            <tr><th scope="row">Connection</th><td data-label="Portable generator">Through a transfer switch or interlock, never a wall outlet: backfeeding can energize utility lines and injure line workers</td><td data-label="Standby generator">Hard-wired through a transfer switch</td></tr>
            <tr><th scope="row">Where it runs</th><td data-label="Portable generator">Outdoors only, well away from doors and windows (the CDC says at least 20 feet) because of carbon monoxide</td><td data-label="Standby generator">On a permanent outdoor pad, at the clearances the manufacturer and code require</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- ============ 4. EXPERT POSITIONING (dark, slant edge) ============ -->
<section class="section texture-grain slant-top svc-expert" aria-labelledby="gen-expert-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <span class="floating-ring" aria-hidden="true"></span>
  <div class="container">
    <div class="svc-expert__grid">
      <div class="svc-expert__stat reveal-left">
        <b class="tabular"><?php echo (int) $yearsExperience; ?>+</b>
        <span>years of hands-on electrical experience, backup generator systems included</span>
      </div>
      <div class="svc-expert__body reveal-right">
        <span class="eyebrow">Who does the work</span>
        <h2 id="gen-expert-title">Why have Jordan Electric install your backup generator?</h2>
        <p class="answer-block">Have Jordan Electric install your backup generator because the connection is the part that matters most. Jordan Electric integrates each system safely with your existing electrical setup, so the generator powers the right circuits and works with the system you already have.</p>
        <p>A generator on a pad is only half a job. How it meets the panel decides whether it starts cleanly, what it carries and whether it stays isolated from the grid. That is electrical work, and it is done to code.</p>
        <ul class="svc-diffs">
          <li><?php icon('plug', 22); ?><b>Integration is the job</b><span>Each system is tied into the existing wiring rather than run off extension cords.</span></li>
          <li><?php icon('badge-check', 22); ?><b>Florida certified contractor <?php echo p1_esc($licenseNumber); ?></b><span>Look it up on the <a href="<?php echo p1_esc($licenseLookupUrl); ?>" target="_blank" rel="noopener">DBPR license search</a>.</span></li>
          <li><?php icon('house', 22); ?><b>Same electrician for the panel</b><span>If the panel needs work before a generator can connect, it is handled in the same project.</span></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ============ 5. SERVICE BREAKDOWN + PROCESS TIMELINE ============ -->
<section class="section svc-breakdown" aria-labelledby="gen-included-title">
  <div class="container">
    <div class="svc-head reveal-up">
      <span class="eyebrow">What is included</span>
      <h2 id="gen-included-title">What does a generator installation from Jordan Electric include?</h2>
      <p class="answer-block">A generator installation from Jordan Electric includes the backup generator system and its safe integration with your existing electrical setup, for a home or a business. If the panel needs work before the generator can connect, that is handled in the same project.</p>
      <p class="prose">For a house, panel replacements and new circuits are part of <a href="/services/residential-electrical/">residential electrical services</a>; for a shop, office or kitchen, see <a href="/services/commercial-electrical/">commercial electrical services</a>.</p>
    </div>
    <ul class="svc-included">
      <?php foreach ($genIncluded as $genI => $genInc): ?>
      <li class="reveal-up reveal-delay-<?php echo ($genI % 3) + 1; ?>"><b><?php echo p1_esc($genInc[0]); ?></b><span><?php echo p1_esc($genInc[1]); ?></span></li>
      <?php endforeach; ?>
    </ul>

    <div class="svc-timeline">
      <div class="svc-timeline__aside reveal-left">
        <span class="eyebrow">How it works</span>
        <h3>How a generator install moves from request to ready</h3>
        <p>The first step is yours: decide what has to keep running. Everything after that is sized around it.</p>
      </div>
      <ol class="svc-steps">
        <?php foreach ($genSteps as $genI => $genStep): ?>
        <li class="reveal-up reveal-delay-<?php echo ($genI % 3) + 1; ?>"><h3><?php echo p1_esc($genStep[0]); ?></h3><p><?php echo p1_esc($genStep[1]); ?></p></li>
        <?php endforeach; ?>
      </ol>
    </div>
  </div>
</section>

<!-- ============ 6. GOOGLE REVIEWS (renders nothing until the feed has real reviews) ============ -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
$genReviews = p1_google_reviews($slug, ['heading' => 'What do customers say about Jordan Electric on Google?']);
if ($genReviews !== ''): ?>
<section class="section" aria-label="Google reviews"><div class="container-wide"><?php echo $genReviews; ?></div></section>
<?php endif; ?>

<!-- ============ 7. FAQ ============ -->
<section class="section svc-faq edge-wave-top" aria-labelledby="gen-faq-title">
  <div class="container">
    <div class="svc-head reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="gen-faq-title">What do Newberry customers ask about generator installation?</h2>
      <p>Customers in Newberry and Alachua County ask Jordan Electric whether it installs backup generators for both homes and businesses, and how a generator helps during Florida storm season. Here are both answers.</p>
    </div>
    <div class="faq-grid reveal-up">
      <?php foreach ($genFaqs as $genFi => $genFaq): ?>
      <details class="faq"<?php echo $genFi === 0 ? ' open' : ''; ?>>
        <summary><?php echo p1_esc($genFaq['q']); ?></summary>
        <p class="faq-answer"><?php echo p1_esc($genFaq['a']); ?></p>
      </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

</article>

<!-- ============ 8. RELATED SERVICES ============ -->
<?php
$relatedCurrent = 'generator-installation';
$relatedHeading = 'What other electrical work goes with a <span class="text-accent">generator</span> project?';
$relatedAnswer  = 'Generator projects often sit next to other electrical work: a residential panel upgrade so the generator has a sound place to connect, commercial installations for business equipment that has to stay powered, and service calls when an older circuit shows problems during the walkthrough. Jordan Electric handles all of it.';
$relatedProse   = 'Combining the work means one site visit, one schedule and one contractor accountable for it.';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/related-services.php';
?>

<!-- ============ 9. FINAL CTA (dark, curved edge) ============ -->
<section class="cta-banner texture-grain edge-curve-top svc-final" aria-labelledby="gen-final-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container reveal-up">
    <div>
      <span class="eyebrow">Generator quote</span>
      <h2 id="gen-final-title">Want backup power in place before next June?</h2>
      <p>Tell Jordan Electric what has to stay on at your home or business, and we will follow up to plan the system and schedule the install.</p>
    </div>
    <div class="actions">
      <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Request a generator quote</button>
      <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
    </div>
  </div>
  <svg class="svc-final__mark" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/></svg>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
