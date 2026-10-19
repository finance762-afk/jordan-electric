<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup: Residential Electrical Services (premium editorial service page) ------------------------
 * Facts trace to config.php / build-plan.json and the client's own site (services + about pages, read
 * 2026-10-19). General code/utility context is phrased as general guidance, never as a claim about past jobs.
 * No client photos are on disk, so the page is type-led (no hero image, no gallery, no before/after).
 * Facts the page wanted but intake did not supply are listed in /content-confirmations.json.
 */
$svc             = p1_service_by_slug('residential-electrical');
$pageTitle       = 'Residential Electrician in Newberry, FL | Jordan Electric';
$pageDescription = 'Jordan Electric wires new construction homes, upgrades outdated panels and repairs home electrical systems in Newberry, FL and across Alachua County.';
$metaDescription = $pageDescription;
$canonicalUrl    = $siteUrl . '/services/residential-electrical/';
$ogImage         = '';
$currentPage     = 'services';
$currentService  = 'residential-electrical';
$pageType        = 'service';
$serviceSlug     = 'residential-electrical';
$bodyClass       = 'svc-page page-residential';

/* Problem statement: signs a home needs an electrician (general guidance, not claims about past jobs) */
$resSigns = [
    ['zap', 'Breakers that trip when two things run at once',
     'A breaker that trips every time the microwave and the window unit share a circuit is doing its job. The fix is usually a new circuit or more panel capacity, not a bigger breaker.'],
    ['shield-check', 'An older or problem-brand panel',
     'Fuse boxes and panels from brands such as Federal Pacific (Stab-Lok) and Zinsco are routinely flagged by home inspectors and home insurers.'],
    ['plug', 'A big new load on the way',
     'A Level 2 EV charger runs on a dedicated 240-volt circuit. A load calculation shows whether the existing panel can carry it.'],
    ['lightbulb', 'Flickering lights or warm cover plates',
     'Flicker that follows one circuit, two-prong outlets with no ground, or a cover plate that feels warm all point to wiring worth opening up.'],
];

/* Breaker-panel directory (signature): what residential service covers, from the client's services/about pages */
$resBreakers = [
    ['New construction wiring', 'Complete wiring for new homes, planned with the build and run before the walls close.'],
    ['Panel upgrades', 'Outdated panels replaced and sized for what the household runs now.'],
    ['System improvements', 'New circuits and capacity for modern power demands, from kitchens to workshops.'],
    ['EV charger installation', 'A dedicated circuit and charger location planned around your panel and driveway.'],
    ['Troubleshooting', 'Tracing a fault to its source so the same problem does not come back.'],
    ['Repairs', 'Faulty outlets, switches and lighting circuits put right and left to code.'],
];

/* Process: the client's real order (request -> review -> quote/schedule -> work to code) applied to home jobs */
$resSteps = [
    ['Tell us about the house', 'Use the form or call ' . $phone . '. For a new build, have the plans and the builder\'s schedule handy; for an existing home, describe what is happening and, if you can, the panel\'s brand and age.'],
    ['We review and follow up', 'Every request is reviewed promptly, and Jordan Electric follows up to talk through the job and set a time to look at it.'],
    ['Quote and schedule', 'You get a quote for the work you asked about and a schedule that fits your build or your household.'],
    ['Work completed to current code', 'On a new home that means rough-in wiring before drywall and trim-out once finishes are in, with inspections at the stages the building department sets.'],
];

/* FAQs: questions real customers ask (client's site FAQ + research brief), unverified details left out */
$resFaqs = [
    ['q' => 'Does Jordan Electric wire new construction homes in Newberry?',
     'a' => 'Yes. Jordan Electric wires new construction homes in Newberry and across Alachua County, and the work is completed to current electrical code. Bring the electrician in while the plans are still on paper: panel size, circuit layout and space for a generator or EV charger are far easier to plan than to add later.'],
    ['q' => 'Do electrical repairs or upgrades need a permit in Newberry?',
     'a' => 'Many do. Panel upgrades, service changes and new circuits generally need an electrical permit and inspection, while a like-for-like swap of a fixture or outlet often does not. The building department that covers your address (the City of Newberry inside city limits, Alachua County outside them) sets the rule for your job, so confirm with them or ask us when you call.'],
];

/* One JSON-LD @graph: Service + WebPage (speakable) + BreadcrumbList + FAQPage mirroring the visible FAQ */
$schemaMarkup = [
    "@context" => "https://schema.org",
    "@graph"   => p1_service_page_nodes($svc, $canonicalUrl, $pageTitle, $pageDescription, 'Residential electrician', generateFAQSchema($resFaqs)),
];
$schemaBlocks = [$schemaMarkup];

$heroFormService = $svc['name'];
$heroFormTitle   = 'Request a residential quote';
$heroFormTagline = 'New build, panel or repair: tell us about the house.';
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?>

/* ==========================================================================
   Residential Electrical — page-specific composition (.res-)
   Signature: the breaker-panel directory (C7) — what the service covers, drawn as a panel schedule.
   ========================================================================== */
.page-residential .svc-hero::before {
  background:
    radial-gradient(closest-side, color-mix(in srgb, var(--color-accent) 30%, transparent), transparent 70%),
    radial-gradient(40% 60% at 5% 100%, color-mix(in srgb, var(--color-secondary) 28%, transparent), transparent 70%);
}
.res-hero__mark {
  position: absolute;
  right: -2rem;
  bottom: -3rem;
  z-index: -1;
  width: clamp(180px, 22vw, 320px);
  height: auto;
  color: var(--color-white);
  opacity: .05;
  pointer-events: none;
}

/* Problem section gets a hairline rule under the quote */
.res-problem .pull-quote::after {
  content: "";
  display: block;
  width: 64px;
  height: 3px;
  margin-top: var(--space-lg);
  background: var(--color-accent);
}
.res-problem__note { margin: var(--space-lg) 0 0; color: var(--color-ink-2); max-width: 46ch; }

/* ---- Signature: breaker-panel directory ---- */
.res-panel-wrap { display: grid; grid-template-columns: minmax(0, 5fr) minmax(0, 7fr); gap: clamp(var(--space-xl), 5vw, var(--space-4xl)); align-items: center; margin-bottom: var(--space-3xl); }
.res-panel-wrap__copy { display: grid; gap: var(--space-md); }
.res-panel-wrap__copy p { margin: 0; color: var(--color-ink-2); }
.res-panel {
  position: relative;
  padding: var(--space-lg);
  border-radius: var(--radius-lg);
  background: linear-gradient(160deg, var(--color-dark) 0%, var(--color-dark-alt) 100%);
  box-shadow: var(--shadow-lg), inset 0 0 0 1px color-mix(in srgb, var(--color-white) 10%, transparent);
  color: var(--color-white);
}
.res-panel__head {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: var(--space-md);
  padding-bottom: var(--space-md);
  margin-bottom: var(--space-md);
  border-bottom: 1px dashed color-mix(in srgb, var(--color-white) 25%, transparent);
  font-family: var(--font-accent);
  font-size: var(--fs-small);
  letter-spacing: .14em;
  text-transform: uppercase;
  color: color-mix(in srgb, var(--color-white) 70%, transparent);
}
.res-panel__head svg { color: var(--color-accent-bright); }
.res-panel ol {
  list-style: none;
  margin: 0;
  padding: 0;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-sm);
  counter-reset: breaker;
}
.res-breaker {
  counter-increment: breaker;
  position: relative;
  display: grid;
  grid-template-columns: auto 1fr;
  gap: var(--space-1) var(--space-md);
  align-items: start;
  padding: var(--space-md);
  border-radius: var(--radius);
  background: color-mix(in srgb, var(--color-white) 5%, transparent);
  border: 1px solid color-mix(in srgb, var(--color-white) 12%, transparent);
  transition: border-color var(--transition), background var(--transition);
}
.res-breaker::before {
  content: counter(breaker, decimal-leading-zero);
  grid-row: span 2;
  font-family: var(--font-accent);
  font-size: var(--fs-small);
  color: color-mix(in srgb, var(--color-white) 55%, transparent);
  padding-top: var(--space-1);
}
.res-breaker b { font-family: var(--font-heading); font-size: 1rem; color: var(--color-white); display: flex; align-items: center; justify-content: space-between; gap: var(--space-sm); }
.res-breaker b::after {
  content: "";
  flex: 0 0 auto;
  width: 28px;
  height: 14px;
  border-radius: var(--radius-full);
  background: color-mix(in srgb, var(--color-white) 18%, transparent);
  box-shadow: inset 14px 0 0 var(--color-accent);
  transition: box-shadow var(--transition);
}
.res-breaker span { font-size: var(--fs-small); color: color-mix(in srgb, var(--color-white) 78%, transparent); }
.res-breaker:hover { border-color: color-mix(in srgb, var(--color-accent) 60%, transparent); background: color-mix(in srgb, var(--color-white) 8%, transparent); }
.res-breaker:hover b::after { box-shadow: inset 28px 0 0 var(--color-accent-bright); }

/* Comparison table: residential accent on the Jordan column header */
.page-residential .svc-table thead th:last-child { background: var(--color-accent-dark); }

@media (max-width: 900px) {
  .res-panel-wrap { grid-template-columns: 1fr; }
}
@media (max-width: 600px) {
  .res-panel ol { grid-template-columns: 1fr; }
}
@media (prefers-reduced-motion: reduce) {
  .res-breaker, .res-breaker b::after { transition: none; }
}
</style>

<!-- ============ 1. HERO (interior, type-led, lead form) ============ -->
<section class="hero hero--interior svc-hero" aria-labelledby="svc-hero-title">
  <span class="grain" aria-hidden="true"></span>
  <svg class="res-hero__mark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true" focusable="false"><path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/><path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
  <div class="container">
    <div class="hero-grid hero-grid--form">
      <div class="hero-copy">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <ol>
            <li><a href="/">Home</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li><a href="/services/">Services</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li><span aria-current="page">Residential</span></li>
          </ol>
        </nav>
        <span class="eyebrow">Residential electrical · <?php echo p1_esc($address['city'] . ', ' . $address['state']); ?></span>
        <h1 class="hero-title" id="svc-hero-title">Residential electrician in <span class="text-accent">Newberry, FL</span></h1>
        <p class="hero-answer">Jordan Electric wires new construction homes, upgrades outdated panels and repairs home electrical systems in Newberry and across Alachua County, completed to current code.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Request a residential quote</button>
          <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php icon('badge-check', 16); ?>License <?php echo p1_esc($licenseNumber); ?></li>
          <li><?php icon('house', 16); ?>New builds + existing homes</li>
          <li><?php icon('map-pin', 16); ?>Based in Newberry</li>
        </ul>
      </div>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/hero-form.php'; ?>
    </div>
  </div>
</section>

<article class="svc-article" aria-labelledby="svc-hero-title">

<!-- ============ 2. PROBLEM STATEMENT ============ -->
<section class="section svc-problem res-problem" aria-labelledby="res-problem-title">
  <div class="container">
    <div class="svc-problem__grid">
      <div class="reveal-left">
        <span class="eyebrow">Signs it is time</span>
        <h2 id="res-problem-title">When does a Newberry home need a residential electrician?</h2>
        <p class="answer-block">A Newberry home needs a residential electrician when it is being built, when its panel can no longer carry what the household runs, or when something stops working the way it should. Jordan Electric handles all three: new construction wiring, panel and system upgrades, and troubleshooting and repairs.</p>
        <blockquote class="pull-quote">A panel sized for yesterday's house is now carrying today's household.</blockquote>
        <p class="res-problem__note">If the problem is a single dead outlet or a light that will not stay on, the <a href="/services/electrical-repairs/">electrical service call and repair page</a> covers how a repair visit works.</p>
      </div>
      <ul class="svc-signs">
        <?php foreach ($resSigns as $resI => $resSign): ?>
        <li class="svc-sign <?php echo $resI % 2 ? 'reveal-right' : 'reveal-up'; ?> reveal-delay-<?php echo ($resI % 3) + 1; ?>">
          <?php icon($resSign[0], 24); ?>
          <h3><?php echo p1_esc($resSign[1]); ?></h3>
          <p><?php echo p1_esc($resSign[2]); ?></p>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<!-- ============ 3. EXPERT POSITIONING (dark, slant edge) ============ -->
<section class="section texture-grain slant-top svc-expert" aria-labelledby="res-expert-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <span class="floating-ring" aria-hidden="true"></span>
  <div class="container">
    <div class="svc-expert__grid">
      <div class="svc-expert__stat reveal-left">
        <b class="tabular"><?php echo (int) $yearsExperience; ?>+</b>
        <span>years of hands-on electrical experience behind the company</span>
      </div>
      <div class="svc-expert__body reveal-right">
        <span class="eyebrow">Who does the work</span>
        <h2 id="res-expert-title">Why hire Jordan Electric for home electrical work in Newberry?</h2>
        <p class="answer-block">Jordan Electric is a family-managed electrical contractor in Newberry, established in 2026 on more than two decades of hands-on work: residential service calls, new construction homes, system upgrades and EV charger installs. The electrician behind it was born and raised in Alachua County.</p>
        <p>That mix matters on a house. Wiring a new home from bare studs and diagnosing a thirty-year-old panel are different jobs, and Jordan Electric does both, holding each to the same standard: safe, precise and done right the first time.</p>
        <ul class="svc-diffs">
          <li><?php icon('badge-check', 22); ?><b>Florida license <?php echo p1_esc($licenseNumber); ?></b><span>The EC prefix marks a Florida certified electrical contractor. Check it on the <a href="<?php echo p1_esc($licenseLookupUrl); ?>" target="_blank" rel="noopener">DBPR license search</a> before any contractor starts work.</span></li>
          <li><?php icon('house', 22); ?><b>New homes and lived-in homes</b><span>The team that runs wiring in a new build also handles the panel upgrade and the repair call in an older house.</span></li>
          <li><?php icon('send', 22); ?><b>Expectations set from the start</b><span>You hear what was found, what is recommended and what happens next, in plain language.</span></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ============ 4. SERVICE BREAKDOWN: panel directory + process timeline ============ -->
<section class="section svc-breakdown" aria-labelledby="res-included-title">
  <div class="container">
    <div class="res-panel-wrap">
      <div class="res-panel-wrap__copy reveal-left">
        <span class="eyebrow">What is included</span>
        <h2 id="res-included-title">What does residential electrical service from Jordan Electric cover?</h2>
        <p class="answer-block">Residential service from Jordan Electric covers six kinds of home work: new construction wiring, panel upgrades, system improvements for modern power demands, EV charger installation, troubleshooting and repairs. Every job is completed to current electrical code.</p>
        <p>Planning for backup power at the same time? A generator is far simpler to tie in when the panel is being replaced anyway. See how <a href="/services/generator-installation/">home generator installation</a> connects to existing wiring.</p>
      </div>
      <div class="res-panel reveal-right" role="group" aria-label="Residential electrical services, laid out as a panel directory">
        <div class="res-panel__head"><span>Panel directory · Residential</span><?php icon('zap', 20); ?></div>
        <ol>
          <?php foreach ($resBreakers as $resBreaker): ?>
          <li class="res-breaker"><b><?php echo p1_esc($resBreaker[0]); ?></b><span><?php echo p1_esc($resBreaker[1]); ?></span></li>
          <?php endforeach; ?>
        </ol>
      </div>
    </div>

    <div class="svc-timeline">
      <div class="svc-timeline__aside reveal-left">
        <span class="eyebrow">How it works</span>
        <h3>How a residential job moves from request to finished work</h3>
        <p>Same four steps whether it is a new build on rural acreage outside town or a panel swap in an older house in Newberry. Only the details change.</p>
      </div>
      <ol class="svc-steps">
        <?php foreach ($resSteps as $resI => $resStep): ?>
        <li class="reveal-up reveal-delay-<?php echo ($resI % 3) + 1; ?>"><h3><?php echo p1_esc($resStep[0]); ?></h3><p><?php echo p1_esc($resStep[1]); ?></p></li>
        <?php endforeach; ?>
      </ol>
    </div>
  </div>
</section>

<!-- ============ 5. COMPARISON: what to check before hiring ============ -->
<section class="section svc-compare edge-wave-top" aria-labelledby="res-compare-title">
  <div class="container">
    <div class="svc-head reveal-up">
      <span class="eyebrow">Before you hire</span>
      <h2 id="res-compare-title">What should you check before hiring a residential electrician in Newberry?</h2>
      <p class="answer-block">Before hiring any residential electrician in Newberry, check four things: a current Florida electrical contractor license, work completed to code, experience with the kind of job you have, and how clearly they explain the work. The table shows where Jordan Electric stands on each.</p>
    </div>
    <div class="svc-table-wrap reveal-up">
      <table class="svc-table">
        <caption>License status can be confirmed by anyone on the Florida DBPR license search.</caption>
        <thead>
          <tr><th scope="col">What to check</th><th scope="col">Why it matters on a home</th><th scope="col">Jordan Electric</th></tr>
        </thead>
        <tbody>
          <tr><th scope="row">Florida license</th><td data-label="Why it matters on a home">Electrical contracting in Florida requires a state license. Unlicensed work can cause trouble with permits, insurance claims and resale.</td><td data-label="Jordan Electric">Certified electrical contractor, <?php echo p1_esc($licenseNumber); ?></td></tr>
          <tr><th scope="row">Code compliance</th><td data-label="Why it matters on a home">Inspections are made against the Florida Building Code, which adopts the National Electrical Code.</td><td data-label="Jordan Electric">Residential work completed to current electrical code</td></tr>
          <tr><th scope="row">The right experience</th><td data-label="Why it matters on a home">A new-build rough-in, a panel replacement and a fault hunt in an older home call for different skills.</td><td data-label="Jordan Electric">New construction homes, panel and system upgrades, service calls and EV chargers</td></tr>
          <tr><th scope="row">Local base</th><td data-label="Why it matters on a home">A contractor nearby can get back out for an inspection or a follow-up without a long drive.</td><td data-label="Jordan Electric">Based in Newberry, serving Alachua County and the surrounding areas</td></tr>
          <tr><th scope="row">Communication</th><td data-label="Why it matters on a home">You should know what is being done to your house and why before it is done.</td><td data-label="Jordan Electric">Findings and recommendations explained in plain language</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- ============ 6. GOOGLE REVIEWS (renders nothing until the feed has real reviews) ============ -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
$resReviews = p1_google_reviews($slug, ['heading' => 'What do Newberry homeowners say about Jordan Electric?']);
if ($resReviews !== ''): ?>
<section class="section" aria-label="Google reviews"><div class="container-wide"><?php echo $resReviews; ?></div></section>
<?php endif; ?>

<!-- ============ 7. FAQ ============ -->
<section class="section svc-faq" aria-labelledby="res-faq-title">
  <div class="container">
    <div class="svc-head reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="res-faq-title">What do Newberry homeowners ask about residential electrical work?</h2>
      <p>Newberry homeowners most often ask Jordan Electric two things about residential electrical work: whether the company wires new construction homes, and whether their upgrade or repair needs a permit. Both answers are below.</p>
    </div>
    <div class="faq-grid reveal-up">
      <?php foreach ($resFaqs as $resFi => $resFaq): ?>
      <details class="faq"<?php echo $resFi === 0 ? ' open' : ''; ?>>
        <summary><?php echo p1_esc($resFaq['q']); ?></summary>
        <p class="faq-answer"><?php echo p1_esc($resFaq['a']); ?></p>
      </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

</article>

<!-- ============ 8. RELATED SERVICES (required services component) ============ -->
<?php
$relatedCurrent = 'residential-electrical';
$relatedHeading = 'What else can Jordan Electric take care of at your <span class="text-accent">home</span> or business?';
$relatedAnswer  = 'Jordan Electric also installs backup generator systems that tie into existing wiring, runs service calls for faulty outlets, lighting problems and system failures, and takes on commercial electrical projects for Newberry-area businesses. Each service has its own page explaining what is involved and what to have ready when you call.';
$relatedProse   = 'Building a home and a shop on the same property? One contractor can cover both.';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/related-services.php';
?>

<!-- ============ 9. FINAL CTA (dark, curved edge) ============ -->
<section class="cta-banner texture-grain edge-curve-top svc-final" aria-labelledby="res-final-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container reveal-up">
    <div>
      <span class="eyebrow">Residential quote</span>
      <h2 id="res-final-title">Planning a new build or a panel upgrade in Newberry?</h2>
      <p>Send the plans or describe the house, and Jordan Electric will follow up to scope the work and schedule it.</p>
    </div>
    <div class="actions">
      <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Request a residential quote</button>
      <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
    </div>
  </div>
  <svg class="svc-final__mark" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/></svg>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
