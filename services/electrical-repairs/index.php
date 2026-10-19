<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup: Electrical Service Calls & Repairs (premium editorial service page) ----------------------
 * Client facts: "troubleshooting and repairs for residential and commercial properties, including faulty
 * outlets, lighting problems, and system failures"; "identify the source of a problem and prevent recurring
 * issues" (services page). Emergency/after-hours service, response times, diagnostic fees and trip charges are
 * NOT claimed (open questions in /content-confirmations.json). Symptom guidance is general safety information.
 */
$svc             = p1_service_by_slug('electrical-repairs');
$pageTitle       = 'Electrical Repair in Newberry, FL | Jordan Electric';
$pageDescription = 'Electrical troubleshooting and repair in Newberry, FL: faulty outlets, lighting problems and system failures at homes and businesses across Alachua County.';
$metaDescription = $pageDescription;
$canonicalUrl    = $siteUrl . '/services/electrical-repairs/';
$ogImage         = '';
$currentPage     = 'services';
$currentService  = 'electrical-repairs';
$pageType        = 'service';
$serviceSlug     = 'electrical-repairs';
$bodyClass       = 'svc-page page-repairs';

/* Signature: symptom triage (general safety guidance; level drives the badge) */
$repTriage = [
    ['stop', 'Burning smell, scorch marks, or a hot outlet or switch', 'An overheating connection or a failing device', 'Switch off that circuit at the panel if you can do it safely, and stop using it. Smoke or flame: get out and call 911.'],
    ['stop', 'A breaker that trips again as soon as you reset it', 'A short circuit, a ground fault or a failing appliance on the circuit', 'Stop resetting it. Unplug everything on that circuit and note what was running when it tripped.'],
    ['soon', 'Sparks or buzzing from an outlet or switch', 'A loose or worn device or connection', 'Leave it off and unused until it has been opened and checked.'],
    ['soon', 'Lights that flicker or dim', 'One room: a loose connection on that circuit. Whole house: possibly the service or the utility side', 'Note whether it is one circuit or everything. If the whole house dims, call your electric utility too.'],
    ['check', 'An outlet that is dead, with no tripped breaker', 'Often a tripped GFCI outlet elsewhere on the circuit, such as a bathroom, kitchen, garage or outdoor outlet', 'Press RESET on nearby GFCI outlets first. Still dead? That is a service call.'],
    ['check', 'Outdoor outlets or lights that quit after rain', 'Moisture in a box or cover, common in Florida humidity and summer storms', 'Keep that circuit off until the box and cover have been checked and sealed.'],
];
$repLevels = ['stop' => 'Act now', 'soon' => 'Book soon', 'check' => 'Check first'];

$repIncluded = [
    ['Faulty outlets and switches', 'Dead, loose, sparking or warm devices traced back and repaired.'],
    ['Lighting problems', 'Flicker, dimming and fixtures that will not stay on, followed to the cause.'],
    ['System failures', 'Circuits, breakers and panels that have stopped doing their job.'],
    ['Homes and businesses', 'Service calls for residential and commercial properties alike.'],
];

$repSteps = [
    ['Describe what is happening', 'Use the form or call ' . $phone . '. Say what you noticed, when it started, which rooms or circuits are affected and what you have already tried.'],
    ['We review and follow up', 'Every request is reviewed promptly, and Jordan Electric follows up to schedule the visit.'],
    ['Troubleshoot to the source', 'The fault is traced to its cause rather than the nearest symptom, and you hear what was found in plain language.'],
    ['Repair, done right the first time', 'The repair is made and left to code, so the same problem does not send you back to the phone next month.'],
];

$repFaqs = [
    ['q' => 'How do I get a quote for an electrical repair, and what will it cost?',
     'a' => 'Call ' . $phone . ' or send the request form with a description of the problem, and Jordan Electric will follow up to schedule a visit. The cost of a repair depends on what troubleshooting finds, so ask about pricing when you call. Jordan Electric sets expectations from the start rather than surprising you at the end.'],
    ['q' => 'Does Jordan Electric handle service calls for businesses as well as homes?',
     'a' => 'Yes. Jordan Electric runs service calls and repairs for both residential and commercial properties in Newberry and across Alachua County, including faulty outlets, lighting problems and electrical system failures.'],
];

/* One JSON-LD @graph: Service + WebPage (speakable) + BreadcrumbList + FAQPage mirroring the visible FAQ */
$schemaMarkup = [
    "@context" => "https://schema.org",
    "@graph"   => p1_service_page_nodes($svc, $canonicalUrl, $pageTitle, $pageDescription, 'Electrical troubleshooting and repair', generateFAQSchema($repFaqs)),
];
$schemaBlocks = [$schemaMarkup];

$heroFormService = $svc['name'];
$heroFormTitle   = 'Request a service call';
$heroFormTagline = 'Describe the problem and where it is happening.';
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?>

/* ==========================================================================
   Electrical Repairs — page-specific composition (.rep-)
   Signature: symptom triage table with severity badges (C7); "patch vs. source" comparison.
   ========================================================================== */
.page-repairs .svc-hero::before {
  inset: -20% -10% auto 50%;
  background:
    radial-gradient(closest-side, color-mix(in srgb, var(--color-accent) 24%, transparent), transparent 70%),
    radial-gradient(50% 60% at 0% 0%, color-mix(in srgb, var(--color-secondary) 26%, transparent), transparent 70%);
}
.rep-hero__scan {
  position: absolute;
  inset: 0;
  z-index: -1;
  pointer-events: none;
  background: linear-gradient(90deg, transparent 0%, color-mix(in srgb, var(--color-accent) 10%, transparent) 50%, transparent 100%);
  background-size: 40% 100%;
  background-repeat: no-repeat;
  animation: rep-scan 9s linear infinite;
}
@keyframes rep-scan {
  from { background-position: -40% 0; }
  to { background-position: 140% 0; }
}

/* ---- Signature: triage table ---- */
.rep-triage { background: var(--color-paper); }
.rep-triage__head { display: grid; grid-template-columns: minmax(0, 3fr) minmax(0, 2fr); gap: clamp(var(--space-xl), 5vw, var(--space-4xl)); align-items: end; margin-bottom: var(--space-2xl); }
.rep-triage__head > div { display: grid; gap: var(--space-sm); }
.rep-safety {
  display: grid;
  grid-template-columns: auto 1fr;
  gap: var(--space-md);
  align-items: start;
  margin: 0;
  padding: var(--space-lg);
  border-radius: var(--radius-lg);
  background: var(--color-dark);
  color: var(--color-white);
  box-shadow: var(--shadow-lg);
}
.rep-safety svg { color: var(--color-accent-bright); }
.rep-safety strong { display: block; font-family: var(--font-heading); margin-bottom: var(--space-1); }
.rep-triage .svc-table tbody th { width: 28%; }
.rep-triage .svc-table td:last-child { background: var(--color-surface); border-inline-start: 0; font-weight: 400; }
.rep-triage .svc-table thead th:last-child { background: var(--color-paper); color: var(--color-ink-2); }
.rep-badge {
  display: inline-flex;
  align-items: center;
  gap: var(--space-1);
  margin-bottom: var(--space-xs);
  padding: var(--space-1) var(--space-sm);
  border-radius: var(--radius-full);
  font-family: var(--font-accent);
  font-size: var(--fs-eyebrow);
  letter-spacing: .12em;
  text-transform: uppercase;
  white-space: nowrap;
}
.rep-badge--stop { background: var(--color-danger); color: var(--color-white); }
.rep-badge--soon { background: var(--color-accent-dark); color: var(--color-white); }
.rep-badge--check { background: var(--color-card-tint-2); color: var(--color-ink); border: 1px solid var(--color-line); }
.rep-triage .svc-table tbody tr:has(.rep-badge--stop) th { box-shadow: inset 4px 0 0 var(--color-danger); }

/* ---- Patch vs source: two-column comparison ---- */
.rep-versus { background: var(--color-paper-2); }
.rep-versus__grid { display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-lg); }
.rep-col { padding: clamp(var(--space-lg), 3vw, var(--space-2xl)); border-radius: var(--radius-lg); display: grid; gap: var(--space-md); align-content: start; }
.rep-col h3 { margin: 0; display: flex; align-items: center; gap: var(--space-sm); }
.rep-col ul { list-style: none; margin: 0; padding: 0; display: grid; gap: var(--space-sm); }
.rep-col li { position: relative; padding-inline-start: var(--space-xl); font-size: var(--fs-small); }
.rep-col--patch { background: var(--color-surface); border: 1px dashed var(--color-line); color: var(--color-ink-2); }
.rep-col--patch h3 { color: var(--color-ink-2); }
.rep-col--patch li::before { content: "–"; position: absolute; left: var(--space-xs); color: var(--color-muted); font-weight: 700; }
.rep-col--source { background: var(--color-dark); color: var(--color-white); box-shadow: var(--shadow-lg); border-top: 4px solid var(--color-accent); transform: translateY(calc(-1 * var(--space-md))); }
.rep-col--source h3 { color: var(--color-white); }
.rep-col--source h3 svg { color: var(--color-accent-bright); }
.rep-col--source li { color: color-mix(in srgb, var(--color-white) 85%, transparent); }
.rep-col--source li::before { content: ""; position: absolute; left: 0; top: .4em; width: 12px; height: 12px; background: var(--color-accent-bright); clip-path: polygon(55% 0, 0 60%, 45% 60%, 35% 100%, 100% 38%, 55% 38%); }

@media (max-width: 900px) {
  .rep-triage__head, .rep-versus__grid { grid-template-columns: 1fr; }
  .rep-col--source { transform: none; }
}
@media (prefers-reduced-motion: reduce) {
  .rep-hero__scan { animation: none; }
}
</style>

<!-- ============ 1. HERO (interior, type-led, lead form) ============ -->
<section class="hero hero--interior svc-hero" aria-labelledby="svc-hero-title">
  <span class="grain" aria-hidden="true"></span>
  <span class="rep-hero__scan" aria-hidden="true"></span>
  <div class="container">
    <div class="hero-grid hero-grid--form">
      <div class="hero-copy">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <ol>
            <li><a href="/">Home</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li><a href="/services/">Services</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li><span aria-current="page">Service Calls &amp; Repairs</span></li>
          </ol>
        </nav>
        <span class="eyebrow">Service calls &amp; repairs · <?php echo p1_esc($address['city'] . ', ' . $address['state']); ?></span>
        <h1 class="hero-title" id="svc-hero-title">Electrical repair in <span class="text-accent">Newberry, FL</span></h1>
        <p class="hero-answer">Jordan Electric troubleshoots and repairs faulty outlets, lighting problems and system failures at homes and businesses across Alachua County, fixing the source so it stays fixed.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Request a service call</button>
          <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
        </div>
        <ul class="hero-chips">
          <li><?php icon('badge-check', 16); ?>License <?php echo p1_esc($licenseNumber); ?></li>
          <li><?php icon('wrench', 16); ?>Homes + businesses</li>
          <li><?php icon('search', 16); ?>Fixes the source</li>
        </ul>
      </div>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/hero-form.php'; ?>
    </div>
  </div>
</section>

<article class="svc-article" aria-labelledby="svc-hero-title">

<!-- ============ 2. PROBLEM STATEMENT / SIGNATURE: symptom triage ============ -->
<section class="section rep-triage" aria-labelledby="rep-triage-title">
  <div class="container">
    <div class="rep-triage__head">
      <div class="reveal-left">
        <span class="eyebrow">Symptoms</span>
        <h2 id="rep-triage-title">What do common electrical symptoms mean, and what should you do first?</h2>
        <p class="answer-block">Most electrical symptoms point to a loose connection, an overloaded circuit, a failing device or moisture. Heat, burning smells and breakers that will not reset need attention now; flicker and dead outlets can usually wait for a scheduled service call from Jordan Electric.</p>
      </div>
      <p class="rep-safety reveal-right"><?php icon('shield-check', 26); ?><span><strong>Safety first</strong>If you see smoke or flame, leave the building and call 911. Never open a panel cover or touch a scorched device.</span></p>
    </div>
    <div class="svc-table-wrap reveal-up">
      <table class="svc-table">
        <caption>General guidance only. When in doubt, switch the circuit off and call <?php echo p1_esc($phone); ?>.</caption>
        <thead>
          <tr><th scope="col">What you notice</th><th scope="col">What it can point to</th><th scope="col">What to do before we arrive</th></tr>
        </thead>
        <tbody>
          <?php foreach ($repTriage as $repRow): ?>
          <tr>
            <th scope="row"><span class="rep-badge rep-badge--<?php echo $repRow[0]; ?>"><?php echo p1_esc($repLevels[$repRow[0]]); ?></span><br><?php echo p1_esc($repRow[1]); ?></th>
            <td data-label="What it can point to"><?php echo p1_esc($repRow[2]); ?></td>
            <td data-label="What to do before we arrive"><?php echo p1_esc($repRow[3]); ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- ============ 3. EXPERT POSITIONING (dark, slant edge) ============ -->
<section class="section texture-grain slant-top svc-expert" aria-labelledby="rep-expert-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <span class="floating-ring" aria-hidden="true"></span>
  <div class="container">
    <div class="svc-expert__grid">
      <div class="svc-expert__stat reveal-left">
        <b class="tabular"><?php echo (int) $yearsExperience; ?>+</b>
        <span>years of hands-on troubleshooting, service calls and repairs</span>
      </div>
      <div class="svc-expert__body reveal-right">
        <span class="eyebrow">Who does the work</span>
        <h2 id="rep-expert-title">Why call Jordan Electric for an electrical repair?</h2>
        <p class="answer-block">Call Jordan Electric because the goal on every service call is to find where the problem starts and stop it coming back, not just to reset a breaker or swap the nearest outlet. That approach rests on years of residential and commercial troubleshooting.</p>
        <p>Electrical faults often show up somewhere other than where they begin. A dead kitchen outlet can trace back to a tripped GFCI in the garage; a flickering bedroom light can be a loose connection two boxes upstream. Following the circuit is the job.</p>
        <ul class="svc-diffs">
          <li><?php icon('search', 22); ?><b>Source, not symptom</b><span>Troubleshooting follows the circuit back to the cause before anything is replaced.</span></li>
          <li><?php icon('badge-check', 22); ?><b>Florida certified contractor <?php echo p1_esc($licenseNumber); ?></b><span>Verify it on the <a href="<?php echo p1_esc($licenseLookupUrl); ?>" target="_blank" rel="noopener">DBPR license search</a>.</span></li>
          <li><?php icon('clock', 22); ?><b>Arrive when expected</b><span>The visit happens at the time agreed, and you hear what was found in plain language.</span></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ============ 4. SERVICE BREAKDOWN + PROCESS TIMELINE ============ -->
<section class="section svc-breakdown" aria-labelledby="rep-included-title">
  <div class="container">
    <div class="svc-head reveal-up">
      <span class="eyebrow">What is included</span>
      <h2 id="rep-included-title">What does an electrical service call from Jordan Electric cover?</h2>
      <p class="answer-block">An electrical service call from Jordan Electric covers troubleshooting and repair of faulty outlets and switches, lighting problems and electrical system failures, at homes and at businesses. The aim is to identify the source of the problem and prevent it from recurring.</p>
      <p class="prose">If troubleshooting shows the panel itself is the problem, replacement moves into <a href="/services/residential-electrical/">residential panel upgrades</a> or, for a business, <a href="/services/commercial-electrical/">commercial system upgrades</a>.</p>
    </div>
    <ul class="svc-included">
      <?php foreach ($repIncluded as $repI => $repInc): ?>
      <li class="reveal-up reveal-delay-<?php echo ($repI % 3) + 1; ?>"><b><?php echo p1_esc($repInc[0]); ?></b><span><?php echo p1_esc($repInc[1]); ?></span></li>
      <?php endforeach; ?>
    </ul>

    <div class="svc-timeline">
      <div class="svc-timeline__aside reveal-left">
        <span class="eyebrow">How it works</span>
        <h3>How a service call runs, from first call to finished repair</h3>
        <p>The more detail you give at step one, the faster step three goes.</p>
      </div>
      <ol class="svc-steps">
        <?php foreach ($repSteps as $repI => $repStep): ?>
        <li class="reveal-up reveal-delay-<?php echo ($repI % 3) + 1; ?>"><h3><?php echo p1_esc($repStep[0]); ?></h3><p><?php echo p1_esc($repStep[1]); ?></p></li>
        <?php endforeach; ?>
      </ol>
    </div>
  </div>
</section>

<!-- ============ 5. COMPARISON: patch vs source ============ -->
<section class="section rep-versus edge-parallelogram-top" aria-labelledby="rep-versus-title">
  <div class="container">
    <div class="svc-head reveal-up">
      <span class="eyebrow">The difference</span>
      <h2 id="rep-versus-title">Why does fixing the source matter more than a quick electrical patch?</h2>
      <p class="answer-block">Fixing the source matters because a patched symptom usually returns, often at a worse moment. Resetting a breaker or swapping one outlet can hide a loose connection or an overloaded circuit that keeps heating up; tracing the fault ends the repeat visits.</p>
    </div>
    <div class="rep-versus__grid">
      <div class="rep-col rep-col--patch reveal-left">
        <h3><?php icon('x', 22); ?>A quick patch</h3>
        <ul>
          <li>Reset the breaker and hope it holds</li>
          <li>Replace the outlet that stopped working</li>
          <li>Swap the bulb or fixture that flickers</li>
          <li>Same call again in a few weeks</li>
        </ul>
      </div>
      <div class="rep-col rep-col--source reveal-right">
        <h3><?php icon('check-circle', 22); ?>The Jordan Electric approach</h3>
        <ul>
          <li>Find out why the breaker is tripping</li>
          <li>Trace the circuit to the failed connection</li>
          <li>Repair the cause and leave it to code</li>
          <li>Explain what was found and what was done</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ============ 6. GOOGLE REVIEWS (renders nothing until the feed has real reviews) ============ -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
$repReviews = p1_google_reviews($slug, ['heading' => 'What do customers say about Jordan Electric service calls?']);
if ($repReviews !== ''): ?>
<section class="section" aria-label="Google reviews"><div class="container-wide"><?php echo $repReviews; ?></div></section>
<?php endif; ?>

<!-- ============ 7. FAQ ============ -->
<section class="section svc-faq" aria-labelledby="rep-faq-title">
  <div class="container">
    <div class="svc-head reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="rep-faq-title">What do customers ask before booking an electrical repair?</h2>
      <p>Before booking an electrical repair, customers usually ask Jordan Electric how quoting works and whether service calls cover businesses as well as homes. Both answers are below.</p>
    </div>
    <div class="faq-grid reveal-up">
      <?php foreach ($repFaqs as $repFi => $repFaq): ?>
      <details class="faq"<?php echo $repFi === 0 ? ' open' : ''; ?>>
        <summary><?php echo p1_esc($repFaq['q']); ?></summary>
        <p class="faq-answer"><?php echo p1_esc($repFaq['a']); ?></p>
      </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

</article>

<!-- ============ 8. RELATED SERVICES ============ -->
<?php
$relatedCurrent = 'electrical-repairs';
$relatedHeading = 'What if the repair turns into a bigger <span class="text-accent">electrical project</span>?';
$relatedAnswer  = 'Sometimes troubleshooting shows the real fix is larger: an outdated panel that needs replacing, a business system that needs upgrading, or a property that needs backup power. Jordan Electric handles residential and commercial upgrades and generator installation too, so the same electrician who found the problem can carry the work through.';
$relatedProse   = 'No hand-off to a second contractor, and no second walkthrough.';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/related-services.php';
?>

<!-- ============ 9. FINAL CTA (dark, curved edge) ============ -->
<section class="cta-banner texture-grain edge-curve-top svc-final" aria-labelledby="rep-final-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container reveal-up">
    <div>
      <span class="eyebrow">Service call</span>
      <h2 id="rep-final-title">Have an electrical problem that keeps coming back?</h2>
      <p>Tell Jordan Electric what you are seeing and where. We will follow up to schedule a visit and track it to the source.</p>
    </div>
    <div class="actions">
      <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Request a service call</button>
      <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
    </div>
  </div>
  <svg class="svc-final__mark" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/></svg>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
