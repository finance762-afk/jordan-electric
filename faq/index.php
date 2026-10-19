<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup: FAQ (/faq/ — directory + index.php, linked from the footer Company column) -----------------
 * 19 questions in four categories (General, Services, Pricing, Process). Every answer sticks to facts in config.php,
 * the client's own site, or general safety / Florida licensing guidance. Deliberately NOT claimed, because they are
 * open questions in /content-confirmations.json: insurance, emergency / after-hours service, response times, free
 * quotes, diagnostic or trip fees, who pulls permits, brands, three-phase, maintenance plans. Prices are not invented:
 * the pricing answers explain what drives cost and how to get a written quote.
 * Answers are trusted HTML constants (links only); the FAQPage schema strips tags. FAQPage is an AI-comprehension
 * aid, not a rich-result feature. Lead form: one mid-page .cta-band after the first category (v6.3), no hero form.
 */
$pageTitle       = 'Electrician FAQ: Licensing and Quotes | Jordan Electric';
$pageDescription = 'Answers from Jordan Electric in Newberry, FL: licensing, service area, new home wiring, panels, generators, permits and quotes. Call (352) 472-5511 to ask.';
$metaDescription = $pageDescription;
$canonicalUrl    = $siteUrl . '/faq/';
$ogImage         = '';
$currentPage     = 'faq';
$pageType        = 'faq';
$bodyClass       = 'svc-page page-faq';

$faqPhone = '<a href="tel:' . p1_esc($phoneE164) . '">' . p1_esc($phone) . '</a>';

$faqCats = [
    'general' => [
        'label'   => 'General',
        'icon'    => 'info',
        'eyebrow' => 'About the company',
        'title'   => 'Who is Jordan Electric, and where does it work?',
        'answer'  => 'Jordan Electric is a family-managed, Florida-licensed electrical contractor based in Newberry, FL, serving homes and businesses across Alachua County. These answers cover licensing, service area and who you would be hiring.',
        'faqs'    => [
            ['q' => 'Is Jordan Electric a licensed electrical contractor in Florida?',
             'a' => 'Yes. Jordan Electric holds Florida electrical contractor license ' . p1_esc($licenseNumber) . '. You can confirm any contractor\'s license on the <a href="' . p1_esc($licenseLookupUrl) . '" target="_blank" rel="noopener">Florida DBPR license search</a> before you hire, which is a good habit for any electrical work.'],
            ['q' => 'What areas does Jordan Electric serve?',
             'a' => 'Jordan Electric is based in Newberry, FL and serves residential and commercial customers across Alachua County and the surrounding areas. Call ' . $faqPhone . ' with your address to confirm we cover it.'],
            ['q' => 'Is Jordan Electric a local, family-run company?',
             'a' => 'Yes. Jordan Electric is a family-managed electrical contractor that is locally connected to Alachua County. The company was established in ' . (int) $yearEstablished . ' in Newberry. Read more on the <a href="/about/">About page</a>.'],
            ['q' => 'How long has the Jordan Electric team been doing electrical work?',
             'a' => 'Jordan Electric opened in ' . (int) $yearEstablished . ', and the experience behind it is over ' . (int) $yearsExperience . ' years of hands-on electrical work across residential service calls, new construction homes, commercial projects, EV charger installations and generator systems.'],
            ['q' => 'Does Jordan Electric work on both homes and businesses?',
             'a' => 'Yes. Jordan Electric handles <a href="/services/residential-electrical/">residential electrical work</a> and <a href="/services/commercial-electrical/">commercial electrical work</a>, plus generator installation and service calls for both kinds of property.'],
        ],
    ],
    'services' => [
        'label'   => 'Services',
        'icon'    => 'zap',
        'eyebrow' => 'What we do',
        'title'   => 'Which electrical jobs does Jordan Electric take on?',
        'answer'  => 'Jordan Electric takes on new construction wiring, panel and system upgrades, commercial installations, backup generators and repair calls in Newberry and across Alachua County. The answers below say what each job involves.',
        'faqs'    => [
            ['q' => 'Does Jordan Electric wire new construction homes in Newberry?',
             'a' => 'Yes. Jordan Electric wires new construction homes in Newberry and across Alachua County, completed to current electrical code. Talk to us while the plans are still on paper so panel size, circuit layout and space for a generator or EV charger are planned in, not squeezed in later.'],
            ['q' => 'Can Jordan Electric upgrade an outdated electrical panel?',
             'a' => 'Yes. Panel and system upgrades are part of Jordan Electric\'s <a href="/services/residential-electrical/">residential electrical services</a>. Warning signs include breakers that trip when several things run at once, an older or problem-brand panel, or a new 240-volt load such as an EV charger.'],
            ['q' => 'Does Jordan Electric install EV chargers?',
             'a' => 'Jordan Electric has hands-on experience with EV charger installations. A Level 2 charger is a 240-volt load, so the panel usually needs a look first. Send the form with your charger model and where you want it, and we will confirm the scope for your home.'],
            ['q' => 'Can Jordan Electric install a backup generator for my home or business?',
             'a' => 'Yes. Jordan Electric installs backup generator systems for homes and businesses and integrates each one with the existing electrical setup. The best time to install is before hurricane season starts on June 1. See <a href="/services/generator-installation/">generator installation</a> for the details.'],
            ['q' => 'What does an electrical service call cover?',
             'a' => 'A service call covers troubleshooting and repair of faulty outlets and switches, lighting problems and electrical system failures, at homes and businesses. The aim is to find the source of the problem so it does not come back. See <a href="/services/electrical-repairs/">electrical service calls and repairs</a>.'],
            ['q' => 'Do you take on commercial electrical projects?',
             'a' => 'Yes. Jordan Electric handles commercial projects of all sizes, including new construction, system upgrades and electrical installations, planned to limit disruption to your daily operations and completed to code. See <a href="/services/commercial-electrical/">commercial electrical services</a>.'],
        ],
    ],
    'pricing' => [
        'label'   => 'Pricing',
        'icon'    => 'clipboard-list',
        'eyebrow' => 'Quotes and cost',
        'title'   => 'How does Jordan Electric price electrical work?',
        'answer'  => 'Jordan Electric prices each job from its actual scope, so the number depends on the work, the property and the equipment involved. There is no flat price for an electrician visit that fits every house. These answers explain how to get a real figure.',
        'faqs'    => [
            ['q' => 'How much does an electrician cost in Newberry, FL?',
             'a' => 'It depends on the job. The main drivers are the scope of work, the size of the panel or service, the age and accessibility of the existing wiring, whether a permit and inspection are required, and the equipment being installed. A few details about your project let Jordan Electric give you a real figure instead of a guess.'],
            ['q' => 'How do I get a quote?',
             'a' => 'Send the <a href="/contact/">contact form</a> or call ' . $faqPhone . ' with the address and what you need. Jordan Electric reviews every request promptly and follows up to schedule. Ask how pricing will work for your specific job when you call.'],
            ['q' => 'Can the price change after I get an estimate?',
             'a' => 'It can if the scope changes or if conditions come to light once work begins, such as damaged wiring behind a wall. Only a written agreement fixes the scope and price of a job, so ask for one and ask what would trigger a change before you approve the work.'],
        ],
    ],
    'process' => [
        'label'   => 'Process',
        'icon'    => 'route',
        'eyebrow' => 'How a job works',
        'title'   => 'What should you expect from request to finished job?',
        'answer'  => 'A job with Jordan Electric starts with your request, moves to a follow-up and a schedule, and ends with work completed to code. These answers cover permits, license checks and what to do before the electrician arrives.',
        'faqs'    => [
            ['q' => 'What happens after I send a request?',
             'a' => 'Jordan Electric reviews the request promptly and follows up to schedule. Include the address, what you need and, for a repair, what you noticed and when it started. The more detail you give, the faster the first conversation goes.'],
            ['q' => 'Do electrical repairs or upgrades need a permit in Newberry?',
             'a' => 'Many do. Panel upgrades, service changes and new circuits generally need an electrical permit and inspection, while a like-for-like swap of a fixture or outlet often does not. The building department that covers your address (the City of Newberry inside city limits, Alachua County outside them) sets the rule for your job, so confirm with them or ask when you call.'],
            ['q' => 'How do I check that an electrician is licensed in Florida?',
             'a' => 'Use the <a href="' . p1_esc($licenseLookupUrl) . '" target="_blank" rel="noopener">Florida DBPR license search</a>, look up the contractor by name or license number, and confirm the license is current and for electrical work. Jordan Electric\'s number is ' . p1_esc($licenseNumber) . '.'],
            ['q' => 'How should I prepare for the electrician\'s visit?',
             'a' => 'Make sure the electrical panel and the work area are clear and reachable, and note what you have seen: which rooms or circuits, when it started and what was running. For a new build or commercial job, have plans or equipment details on hand.'],
            ['q' => 'What should I do if I smell burning or see sparks?',
             'a' => 'If you see smoke or flame, leave the building and call 911. For a hot outlet or burning smell, switch off that circuit at the panel only if you can do it safely, stop using it and call. Never open a panel cover or touch a scorched device. The <a href="/services/electrical-repairs/">repairs page</a> has a symptom guide.'],
        ],
    ],
];

$faqAll = [];
foreach ($faqCats as $faqCat) { foreach ($faqCat['faqs'] as $faqRow) { $faqAll[] = $faqRow; } }
$faqCount = count($faqAll);

$schemaBlocks = [[
    "@context" => 'https://schema.org',
    '@graph'   => array_merge([
        ['@type' => 'WebPage', '@id' => $canonicalUrl . '#webpage', 'url' => $canonicalUrl, 'name' => $pageTitle, 'description' => $pageDescription,
         'isPartOf' => ['@type' => 'WebSite', 'name' => $siteName, 'url' => rtrim($siteUrl, '/') . '/'],
         'about' => ['@id' => p1_org_id()],
         'speakable' => ['@type' => 'SpeakableSpecification', 'cssSelector' => ['h1', '.hero-answer', '.answer-block']]],
        ['@type' => 'BreadcrumbList', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => rtrim($siteUrl, '/') . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'FAQ', 'item' => $canonicalUrl],
        ]],
    ], [(function () use ($faqAll, $canonicalUrl) {
        $node = generateFAQSchema($faqAll);
        unset($node['@context']);
        $node['@id'] = $canonicalUrl . '#faq';
        return $node;
    })()]),
]];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/cta-band.css'; ?>

/* ==========================================================================
   FAQ — page-specific composition (.fq-)
   Signature: each category is a split block (sticky question head left, accordion right) with a running number,
   and the hero doubles as the category index (anchor chips). No JavaScript: native <details> accordions.
   ========================================================================== */
.page-faq .svc-hero::before {
  inset: -35% -10% auto 55%;
  background:
    radial-gradient(closest-side, color-mix(in srgb, var(--color-accent) 24%, transparent), transparent 70%),
    radial-gradient(40% 60% at 5% 100%, color-mix(in srgb, var(--color-secondary) 24%, transparent), transparent 70%);
}
.page-faq .svc-hero .hero-grid { grid-template-columns: minmax(0, 1fr); }
.page-faq .svc-hero .hero-title { max-width: 22ch; }
.fq-index { list-style: none; margin: var(--space-md) 0 0; padding: 0; display: flex; flex-wrap: wrap; gap: var(--space-xs); }
.fq-index a {
  display: inline-flex;
  align-items: center;
  gap: var(--space-xs);
  min-height: 44px;
  padding: var(--space-xs) var(--space-md);
  border-radius: var(--radius-full);
  border: 1px solid color-mix(in srgb, var(--color-white) 22%, transparent);
  background: color-mix(in srgb, var(--color-white) 8%, transparent);
  color: var(--color-white);
  text-decoration: none;
  font-weight: 500;
  transition: background-color var(--transition), border-color var(--transition);
}
.fq-index a:hover { background: color-mix(in srgb, var(--color-accent) 40%, transparent); border-color: var(--color-accent-bright); }
.fq-index svg { color: var(--color-accent-bright); }
.fq-index small { font-family: var(--font-accent); letter-spacing: .1em; color: color-mix(in srgb, var(--color-white) 65%, transparent); }

.fq-cat { counter-increment: fqcat; }
.fq-cat--general { background: var(--color-paper); }
.fq-cat--services { background: var(--color-surface); }
.fq-cat--pricing { background: var(--color-paper-2); }
.fq-cat--process { background: var(--color-surface); }
.fq-cat__grid { display: grid; grid-template-columns: minmax(0, 2fr) minmax(0, 3fr); gap: clamp(var(--space-xl), 5vw, var(--space-4xl)); align-items: start; }
.fq-cat__head { position: sticky; top: calc(var(--nav-height) + var(--space-xl)); display: grid; gap: var(--space-sm); }
.fq-cat__head h2 { margin: 0; }
.fq-cat__head .answer-block { margin: 0; font-size: var(--fs-body); }
.fq-cat__num { font-family: var(--font-accent); font-size: clamp(3rem, 2rem + 3vw, 5rem); line-height: .85; color: color-mix(in srgb, var(--color-accent) 30%, transparent); }
.fq-cat__num::before { content: counter(fqcat, decimal-leading-zero); }
.fq-list { display: grid; gap: 0; }
.fq-list .faq { padding-inline: var(--space-md); border-inline-start: 3px solid transparent; transition: border-color var(--transition), background-color var(--transition); }
.fq-list .faq[open] { border-inline-start-color: var(--color-accent); background: color-mix(in srgb, var(--color-accent) 5%, transparent); }
.fq-list .faq summary { min-height: 44px; text-wrap: balance; }
.fq-list .faq .faq-answer { max-width: 62ch; }
.fq-list .faq .faq-answer a { color: var(--color-accent-dark); text-decoration: underline; text-underline-offset: .18em; text-decoration-thickness: 1px; }
.fq-list .faq:last-child { border-bottom: 1px solid var(--color-line); }
.page-faq main, .page-faq .svc-article { counter-reset: fqcat; }

@media (max-width: 900px) {
  .fq-cat__grid { grid-template-columns: 1fr; }
  .fq-cat__head { position: static; }
}
@media (prefers-reduced-motion: reduce) {
  .fq-index a, .fq-list .faq { transition: none; }
}
</style>

<!-- ============ 1. HERO (interior, type-led; doubles as the category index) ============ -->
<section class="hero hero--interior svc-hero" aria-labelledby="fq-hero-title">
  <span class="grain" aria-hidden="true"></span>
  <div class="container">
    <div class="hero-grid">
      <div class="hero-copy">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <ol>
            <li><a href="/">Home</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li><span aria-current="page">FAQ</span></li>
          </ol>
        </nav>
        <span class="eyebrow">FAQ · <?php echo p1_esc($address['city'] . ', ' . $address['state']); ?></span>
        <h1 class="hero-title" id="fq-hero-title">Electrician questions, answered for <span class="text-accent">Newberry, FL</span></h1>
        <p class="hero-answer"><?php echo (int) $faqCount; ?> straight answers from Jordan Electric on licensing, services, pricing and how a job runs, across Alachua County.</p>
        <ul class="fq-index" aria-label="Jump to a category">
          <?php foreach ($faqCats as $fqKey => $fqCat): ?>
          <li><a href="#<?php echo p1_esc($fqKey); ?>"><?php icon($fqCat['icon'], 18); ?><?php echo p1_esc($fqCat['label']); ?> <small><?php echo count($fqCat['faqs']); ?></small></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<article class="svc-article" aria-labelledby="fq-hero-title">
<?php $fqN = 0; foreach ($faqCats as $fqKey => $fqCat): $fqN++; ?>

<!-- ============ CATEGORY <?php echo $fqN; ?>: <?php echo strtoupper(p1_esc($fqCat['label'])); ?> ============ -->
<section class="section fq-cat fq-cat--<?php echo p1_esc($fqKey); ?><?php echo $fqKey === 'pricing' ? ' edge-parallelogram-top' : ''; ?>" id="<?php echo p1_esc($fqKey); ?>" aria-labelledby="fq-<?php echo p1_esc($fqKey); ?>-title">
  <div class="container">
    <div class="fq-cat__grid">
      <div class="fq-cat__head reveal-left">
        <span class="fq-cat__num" aria-hidden="true"></span>
        <span class="eyebrow"><?php echo p1_esc($fqCat['eyebrow']); ?></span>
        <h2 id="fq-<?php echo p1_esc($fqKey); ?>-title"><?php echo p1_esc($fqCat['title']); ?></h2>
        <p class="answer-block"><?php echo p1_esc($fqCat['answer']); ?></p>
      </div>
      <div class="fq-list reveal-right">
        <?php foreach ($fqCat['faqs'] as $fqI => $fqRow): ?>
        <details class="faq"<?php echo ($fqN === 1 && $fqI === 0) ? ' open' : ''; ?>>
          <summary><?php echo p1_esc($fqRow['q']); ?></summary>
          <p class="faq-answer"><?php echo $fqRow['a']; ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
<?php if ($fqN === 1): ?>

<!-- ============ MID-PAGE QUOTE BAND (the one lead form on FAQ) ============ -->
<?php
$ctaBandEyebrow = 'Still have a question?';
$ctaBandTitle   = 'Ask Jordan Electric about your project';
$ctaBandText    = 'Send the details and we will review your request and follow up to schedule.';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/cta-band.php';
?>
<?php endif; ?>
<?php endforeach; ?>

</article>

<!-- ============ FINAL CTA (dark, curved edge) ============ -->
<section class="cta-banner texture-grain edge-curve-top svc-final" aria-labelledby="fq-final-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container reveal-up">
    <div>
      <span class="eyebrow">Next step</span>
      <h2 id="fq-final-title">Ready to talk to a Newberry electrician?</h2>
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
