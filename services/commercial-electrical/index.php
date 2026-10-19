<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup: Commercial Electrical Services (premium editorial service page) -------------------------
 * Facts trace to config.php / build-plan.json and the client's services page ("new construction, system
 * upgrades, and electrical installations", "efficiency, minimal disruption, code compliance, clear
 * communication", "projects of all sizes"). Building types, three-phase work and after-hours scheduling are
 * NOT claimed: they are open questions in /content-confirmations.json. No client photos on disk yet.
 */
$svc             = p1_service_by_slug('commercial-electrical');
$pageTitle       = 'Commercial Electrician in Newberry, FL | Jordan Electric';
$pageDescription = 'Commercial electrical contractor in Newberry, FL: new construction, system upgrades and installations for Alachua County businesses. Call (352) 472-5511.';
$metaDescription = $pageDescription;
$canonicalUrl    = $siteUrl . '/services/commercial-electrical/';
$ogImage         = '';
$currentPage     = 'services';
$currentService  = 'commercial-electrical';
$pageType        = 'service';
$serviceSlug     = 'commercial-electrical';
$bodyClass       = 'svc-page page-commercial';

$comSigns = [
    ['building-2', 'A new building or a fit-out',
     'New construction and interior build-outs need the electrical plan settled alongside the floor plan, before ceilings and walls close.'],
    ['zap', 'Equipment the system was not sized for',
     'New ovens, compressors, coolers or machines can push a panel past what it was built to carry. Nameplate ratings tell an electrician what is needed.'],
    ['clock', 'Work that has to fit around open hours',
     'Most businesses cannot simply close for the electrician, so the job has to be planned around how the space operates.'],
    ['lightbulb', 'A layout that has outgrown its power',
     'Extension cords across the floor, dim work areas and workstations moved away from outlets show a system that has fallen behind the space.'],
];

/* Signature: what to send with a commercial request (practical checklist — asks the customer, claims nothing) */
$comBrief = [
    ['The address and what the space is used for', 'Office, shop floor, storage, kitchen or retail: the use drives the load and the code requirements.'],
    ['Drawings or a floor plan, if you have them', 'Even a photo of a sketch helps scope a new build or a fit-out faster.'],
    ['What is changing', 'New construction, an upgrade to an existing system, or new equipment going in.'],
    ['Nameplate ratings for major equipment', 'A photo of the data plate on each large machine, cooler or HVAC unit shows voltage and amperage.'],
    ['Your operating hours', 'Note any days or times when work cannot happen, so the schedule limits disruption.'],
    ['Your target date', 'An opening day, an inspection date or a lease deadline sets the order of the work.'],
];

$comIncluded = [
    ['New construction', 'Electrical systems for new commercial buildings, planned with the rest of the build.'],
    ['System upgrades', 'Existing systems brought up to what the business runs today, and ready for growth.'],
    ['Electrical installations', 'New circuits and equipment connections that support daily operations.'],
    ['Repairs and troubleshooting', 'Faults on commercial properties traced to the source and repaired.'],
];

$comSteps = [
    ['Send the project details', 'Use the form or call ' . $phone . '. The checklist above covers what helps most; send what you have and the rest can follow.'],
    ['We review and follow up', 'Every request is reviewed promptly, and Jordan Electric follows up to talk through scope, timing and access.'],
    ['Scope, quote and schedule', 'The work is quoted and scheduled around your operating hours and any deadline you are working to.'],
    ['Completed to code, with clear updates', 'Work is completed to code with inspections at the stages the building department sets, and you hear where things stand as it moves.'],
];

$comFaqs = [
    ['q' => 'Does Jordan Electric take on commercial electrical projects?',
     'a' => 'Yes. Jordan Electric takes on commercial electrical projects of all sizes in Newberry and across Alachua County, including new construction, system upgrades and electrical installations. Each project is planned for efficiency and limited disruption to your daily operations, and completed to code.'],
];

/* One JSON-LD @graph: Service + WebPage (speakable) + BreadcrumbList + FAQPage mirroring the visible FAQ */
$schemaMarkup = [
    "@context" => "https://schema.org",
    "@graph"   => p1_service_page_nodes($svc, $canonicalUrl, $pageTitle, $pageDescription, 'Commercial electrical contractor', generateFAQSchema($comFaqs)),
];
$schemaBlocks = [$schemaMarkup];

$heroFormService = $svc['name'];
$heroFormTitle   = 'Request a commercial quote';
$heroFormTagline = 'New build, upgrade or installation: tell us about the space.';
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?>

/* ==========================================================================
   Commercial Electrical — page-specific composition (.com-)
   Signature: the "project brief" clipboard (C7) — what to send with a commercial request.
   ========================================================================== */
.page-commercial .svc-hero::before {
  inset: -30% 20% auto -20%;
  background:
    radial-gradient(closest-side, color-mix(in srgb, var(--color-secondary) 34%, transparent), transparent 72%),
    radial-gradient(40% 50% at 95% 10%, color-mix(in srgb, var(--color-accent) 26%, transparent), transparent 70%);
}
.com-hero__rule {
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  height: 6px;
  z-index: 0;
  background: repeating-linear-gradient(90deg, var(--color-accent) 0 28px, transparent 28px 40px);
  opacity: .55;
  pointer-events: none;
}

/* Problem bento: commercial tints run cool-first */
.page-commercial .svc-sign:first-child { background: var(--color-card-tint-2); }
.page-commercial .svc-sign:nth-child(4) { background: var(--color-card-tint-3); }

/* ---- Signature: project brief clipboard ---- */
.com-brief { background: var(--color-paper-2); }
.com-brief__grid { display: grid; grid-template-columns: minmax(0, 7fr) minmax(0, 5fr); grid-template-areas: "board copy"; gap: clamp(var(--space-xl), 5vw, var(--space-4xl)); align-items: start; }
.com-brief__copy { grid-area: copy; display: grid; gap: var(--space-md); position: sticky; top: calc(var(--nav-height) + var(--space-xl)); }
.com-brief__copy p { margin: 0; color: var(--color-ink-2); }
.com-board {
  grid-area: board;
  position: relative;
  padding: var(--space-3xl) clamp(var(--space-lg), 4vw, var(--space-2xl)) var(--space-2xl);
  border-radius: var(--radius-lg);
  background: var(--color-surface);
  border: 1px solid var(--color-line);
  box-shadow: var(--shadow-lg);
  transform: rotate(-.6deg);
  transition: transform var(--transition-slow);
}
.com-board:hover { transform: rotate(0deg); }
.com-board::before {
  content: "";
  position: absolute;
  top: calc(-1 * var(--space-md));
  left: 50%;
  width: 140px;
  height: 36px;
  transform: translateX(-50%);
  border-radius: var(--radius) var(--radius) var(--radius-lg) var(--radius-lg);
  background: linear-gradient(180deg, var(--color-secondary), var(--color-primary));
  box-shadow: var(--shadow);
}
.com-board__title {
  display: flex;
  justify-content: space-between;
  align-items: baseline;
  gap: var(--space-md);
  margin: 0 0 var(--space-lg);
  padding-bottom: var(--space-sm);
  border-bottom: 2px solid var(--color-ink);
  font-family: var(--font-accent);
  font-size: var(--fs-small);
  letter-spacing: .14em;
  text-transform: uppercase;
  color: var(--color-ink);
}
.com-board__title span { color: var(--color-accent-dark); }
.com-board ol { list-style: none; margin: 0; padding: 0; display: grid; gap: 0; }
.com-board li {
  display: grid;
  grid-template-columns: 24px 1fr;
  gap: var(--space-1) var(--space-md);
  padding-block: var(--space-md);
  border-bottom: 1px dashed var(--color-line);
}
.com-board li:last-child { border-bottom: 0; }
.com-board li::before {
  content: "";
  grid-row: span 2;
  width: 22px;
  height: 22px;
  margin-top: 2px;
  border: 2px solid var(--color-ink-2);
  border-radius: var(--radius-sm);
  transition: background var(--transition), border-color var(--transition);
}
.com-board li:hover::before { border-color: var(--color-accent); background: var(--color-card-tint-3); }
.com-board b { font-family: var(--font-heading); }
.com-board span { font-size: var(--fs-small); color: var(--color-ink-2); }

/* Breakdown list runs four-up on this page */
.page-commercial .svc-included { grid-template-columns: repeat(4, minmax(0, 1fr)); }

@media (max-width: 1000px) {
  .page-commercial .svc-included { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 900px) {
  .com-brief__grid { grid-template-columns: 1fr; grid-template-areas: "copy" "board"; }
  .com-brief__copy { position: static; }
  .com-board { transform: none; }
}
@media (max-width: 600px) {
  .page-commercial .svc-included { grid-template-columns: 1fr; }
}
@media (prefers-reduced-motion: reduce) {
  .com-board, .com-board li::before { transition: none; }
}
</style>

<!-- ============ 1. HERO (interior, type-led, lead form) ============ -->
<section class="hero hero--interior svc-hero" aria-labelledby="svc-hero-title">
  <span class="grain" aria-hidden="true"></span>
  <span class="com-hero__rule" aria-hidden="true"></span>
  <div class="container">
    <div class="hero-grid hero-grid--form">
      <div class="hero-copy">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <ol>
            <li><a href="/">Home</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li><a href="/services/">Services</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li><span aria-current="page">Commercial</span></li>
          </ol>
        </nav>
        <span class="eyebrow">Commercial electrical · <?php echo p1_esc($address['city'] . ', ' . $address['state']); ?></span>
        <h1 class="hero-title" id="svc-hero-title">Commercial electrician in <span class="text-accent">Newberry, FL</span></h1>
        <p class="hero-answer">Jordan Electric handles commercial new construction, system upgrades and electrical installations for businesses in Newberry and across Alachua County, planned around your operations.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Request a commercial quote</button>
          <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php icon('badge-check', 16); ?>License <?php echo p1_esc($licenseNumber); ?></li>
          <li><?php icon('building-2', 16); ?>Projects of all sizes</li>
          <li><?php icon('clock', 16); ?>Planned around operations</li>
        </ul>
      </div>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/hero-form.php'; ?>
    </div>
  </div>
</section>

<article class="svc-article" aria-labelledby="svc-hero-title">

<!-- ============ 2. PROBLEM STATEMENT ============ -->
<section class="section svc-problem" aria-labelledby="com-problem-title">
  <div class="container">
    <div class="svc-problem__grid">
      <div class="reveal-left">
        <span class="eyebrow">Signs it is time</span>
        <h2 id="com-problem-title">When does a Newberry business need a commercial electrician?</h2>
        <p class="answer-block">A Newberry business needs a commercial electrician when it builds or fits out a space, when its system cannot keep up with the equipment it runs, or when new installations are needed to grow. Jordan Electric takes on commercial new construction, system upgrades and electrical installations of every size.</p>
        <blockquote class="pull-quote">The wiring should support the business, not set its limits.</blockquote>
      </div>
      <ul class="svc-signs">
        <?php foreach ($comSigns as $comI => $comSign): ?>
        <li class="svc-sign <?php echo $comI % 2 ? 'reveal-right' : 'reveal-up'; ?> reveal-delay-<?php echo ($comI % 3) + 1; ?>">
          <?php icon($comSign[0], 24); ?>
          <h3><?php echo p1_esc($comSign[1]); ?></h3>
          <p><?php echo p1_esc($comSign[2]); ?></p>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<!-- ============ 3. SIGNATURE: project brief ============ -->
<section class="section com-brief edge-parallelogram-top" aria-labelledby="com-brief-title">
  <div class="container">
    <div class="com-brief__grid">
      <div class="com-brief__copy reveal-right">
        <span class="eyebrow">Before you call</span>
        <h2 id="com-brief-title">What should you send with a commercial electrical request?</h2>
        <p class="answer-block">Send Jordan Electric the address and use of the space, any drawings, what is changing, equipment nameplate ratings, your operating hours and your target date. Those six details let a commercial job be scoped and scheduled around the business from the first conversation.</p>
        <p>None of it is required to get started. A phone call to <?php echo p1_esc($phone); ?> works too; the details can follow by email.</p>
      </div>
      <div class="com-board reveal-left" role="group" aria-labelledby="com-board-title">
        <p class="com-board__title" id="com-board-title">Commercial project brief <span>6 items</span></p>
        <ol>
          <?php foreach ($comBrief as $comItem): ?>
          <li><b><?php echo p1_esc($comItem[0]); ?></b><span><?php echo p1_esc($comItem[1]); ?></span></li>
          <?php endforeach; ?>
        </ol>
      </div>
    </div>
  </div>
</section>

<!-- ============ 4. EXPERT POSITIONING (dark, slant edge) ============ -->
<section class="section texture-grain slant-top svc-expert" aria-labelledby="com-expert-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <span class="floating-ring" aria-hidden="true"></span>
  <div class="container">
    <div class="svc-expert__grid">
      <div class="svc-expert__stat reveal-left">
        <b class="tabular"><?php echo (int) $yearsExperience; ?>+</b>
        <span>years of hands-on electrical experience, commercial projects included</span>
      </div>
      <div class="svc-expert__body reveal-right">
        <span class="eyebrow">Who does the work</span>
        <h2 id="com-expert-title">Why choose Jordan Electric for commercial electrical work?</h2>
        <p class="answer-block">Jordan Electric brings hands-on commercial experience to businesses in Newberry and Alachua County, and plans every project around efficiency, minimal disruption to daily operations, code compliance and clear communication. The company is family-managed and based in Newberry.</p>
        <ul class="svc-diffs">
          <li><?php icon('badge-check', 22); ?><b>Florida certified contractor <?php echo p1_esc($licenseNumber); ?></b><span>Verify it on the <a href="<?php echo p1_esc($licenseLookupUrl); ?>" target="_blank" rel="noopener">DBPR license search</a> before any contractor starts work on your building.</span></li>
          <li><?php icon('clock', 22); ?><b>Disruption kept to a minimum</b><span>Work is planned around how your space operates, not the other way round.</span></li>
          <li><?php icon('house', 22); ?><b>Commercial and residential</b><span>Useful when the business and the owner's home are on the same property, or when a building mixes both.</span></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ============ 5. SERVICE BREAKDOWN + PROCESS TIMELINE ============ -->
<section class="section svc-breakdown" aria-labelledby="com-included-title">
  <div class="container">
    <div class="svc-head reveal-up">
      <span class="eyebrow">What is included</span>
      <h2 id="com-included-title">What commercial electrical work does Jordan Electric handle?</h2>
      <p class="answer-block">Jordan Electric handles commercial new construction, system upgrades and electrical installations that support daily operations and future growth, plus repairs on commercial properties. Projects of every size are planned for efficiency and limited disruption.</p>
      <p class="prose">A fault that has already stopped work is a repair job: see how <a href="/services/electrical-repairs/">commercial service calls and repairs</a> are handled. If an outage would close the doors, add <a href="/services/generator-installation/">a backup generator for the business</a> to the conversation.</p>
    </div>
    <ul class="svc-included">
      <?php foreach ($comIncluded as $comI => $comInc): ?>
      <li class="reveal-up reveal-delay-<?php echo ($comI % 3) + 1; ?>"><b><?php echo p1_esc($comInc[0]); ?></b><span><?php echo p1_esc($comInc[1]); ?></span></li>
      <?php endforeach; ?>
    </ul>

    <div class="svc-timeline">
      <div class="svc-timeline__aside reveal-left">
        <span class="eyebrow">How it works</span>
        <h3>How a commercial project runs with Jordan Electric</h3>
        <p>Four steps from first contact to finished work, with the schedule built around your business at step three.</p>
      </div>
      <ol class="svc-steps">
        <?php foreach ($comSteps as $comI => $comStep): ?>
        <li class="reveal-up reveal-delay-<?php echo ($comI % 3) + 1; ?>"><h3><?php echo p1_esc($comStep[0]); ?></h3><p><?php echo p1_esc($comStep[1]); ?></p></li>
        <?php endforeach; ?>
      </ol>
    </div>
  </div>
</section>

<!-- ============ 6. COMPARISON ============ -->
<section class="section svc-compare" aria-labelledby="com-compare-title">
  <div class="container">
    <div class="svc-head reveal-up">
      <span class="eyebrow">Comparing contractors</span>
      <h2 id="com-compare-title">How should a Newberry business compare commercial electrical contractors?</h2>
      <p class="answer-block">Compare commercial electrical contractors on their Florida license, code compliance, how they schedule around your operations, the project sizes they take on and how they communicate during the job. The table sets out what to ask and how Jordan Electric answers.</p>
    </div>
    <div class="svc-table-wrap reveal-up">
      <table class="svc-table">
        <caption>Ask every contractor the same questions so the quotes compare like for like.</caption>
        <thead>
          <tr><th scope="col">What to ask</th><th scope="col">Why it matters for a business</th><th scope="col">Jordan Electric</th></tr>
        </thead>
        <tbody>
          <tr><th scope="row">Florida license number</th><td data-label="Why it matters for a business">Permits, landlords and insurers all expect a licensed electrical contractor on commercial work.</td><td data-label="Jordan Electric"><?php echo p1_esc($licenseNumber); ?>, searchable on DBPR</td></tr>
          <tr><th scope="row">Code compliance</th><td data-label="Why it matters for a business">Commercial work is inspected against the Florida Building Code before the space can be used.</td><td data-label="Jordan Electric">Code-compliant installations on every project</td></tr>
          <tr><th scope="row">Scheduling</th><td data-label="Why it matters for a business">Every hour the doors are closed costs money.</td><td data-label="Jordan Electric">Work planned to limit disruption to daily operations</td></tr>
          <tr><th scope="row">Project size</th><td data-label="Why it matters for a business">Some contractors only take large jobs; others only small ones.</td><td data-label="Jordan Electric">Commercial projects of all sizes</td></tr>
          <tr><th scope="row">Communication</th><td data-label="Why it matters for a business">You need to know where the job stands to plan staff, stock and opening dates.</td><td data-label="Jordan Electric">Clear communication from quote to completion</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- ============ 7. GOOGLE REVIEWS (renders nothing until the feed has real reviews) ============ -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
$comReviews = p1_google_reviews($slug, ['heading' => 'What do Alachua County businesses say about Jordan Electric?']);
if ($comReviews !== ''): ?>
<section class="section" aria-label="Google reviews"><div class="container-wide"><?php echo $comReviews; ?></div></section>
<?php endif; ?>

<!-- ============ 8. FAQ ============ -->
<section class="section svc-faq" aria-labelledby="com-faq-title">
  <div class="container">
    <div class="svc-head reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="com-faq-title">What do business owners ask Jordan Electric about commercial work?</h2>
      <p>Business owners in Newberry and Alachua County usually start by asking whether Jordan Electric takes on commercial projects at all, and what kinds. The short answer is yes, with the details below.</p>
    </div>
    <div class="faq-grid reveal-up">
      <?php foreach ($comFaqs as $comFaq): ?>
      <details class="faq" open>
        <summary><?php echo p1_esc($comFaq['q']); ?></summary>
        <p class="faq-answer"><?php echo p1_esc($comFaq['a']); ?></p>
      </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

</article>

<!-- ============ 9. RELATED SERVICES ============ -->
<?php
$relatedCurrent = 'commercial-electrical';
$relatedHeading = 'Which other Jordan Electric services does a <span class="text-accent">business</span> use?';
$relatedAnswer  = 'Businesses also call Jordan Electric for service calls and repairs when an outlet, lighting circuit or system fails on a commercial property, and for backup generator systems that keep essential equipment running through an outage. Owners often use the residential side for their own homes as well.';
$relatedProse   = 'One electrician who already knows the building saves a walkthrough every time.';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/related-services.php';
?>

<!-- ============ 10. FINAL CTA (dark, curved edge) ============ -->
<section class="cta-banner texture-grain edge-curve-top svc-final" aria-labelledby="com-final-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container reveal-up">
    <div>
      <span class="eyebrow">Commercial quote</span>
      <h2 id="com-final-title">Have a commercial project coming up in Alachua County?</h2>
      <p>Send what you know about the space and the schedule. Jordan Electric will follow up to scope it and plan the work around your hours.</p>
    </div>
    <div class="actions">
      <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Request a commercial quote</button>
      <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
    </div>
  </div>
  <svg class="svc-final__mark" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/></svg>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
