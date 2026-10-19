<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup: homepage (minimal-tech archetype, editorial section script) -----------------------------
 * Facts on this page trace to build-plan.json, config.php, and the client's own site (build-plan web_sources),
 * which config.php records with its source. No client photos are on disk yet (assets.images is empty), so the
 * hero is the type-led .hero--type, service cards use the icon fallback, and the gallery is skipped.
 * Anything the page wanted but intake did not supply is listed in /content-confirmations.json, not invented here.
 */
$pageTitle       = 'New Home Electrician in Newberry, FL | Jordan Electric';
$pageDescription = 'Jordan Electric is a licensed Newberry, FL electrician wiring new construction homes, plus commercial work, generator installs and repairs across Alachua County.';
$metaDescription = $pageDescription;              // head.php reads $metaDescription
$canonicalUrl    = $siteUrl . '/';
$ogImage         = '';                            // no client photo on disk yet; head.php falls back to og-default.jpg if added
$currentPage     = 'home';
$pageType        = 'home';
$heroPreloadImage = '';                           // type-led hero: no LCP image to preload
$bodyClass       = 'page-home';

$homeLicense = $licenseNumber ?? '';

/* Ticker: service lines and places from the client's site — decorative duplicate of real content */
$homeTicker = [
    ['house',            'New construction wiring'],
    ['zap',              'Panel upgrades'],
    ['building-2',       'Commercial electrical'],
    ['battery-charging', 'Generator installation'],
    ['plug',             'EV charger installation'],
    ['lightbulb',        'Lighting problems solved'],
    ['wrench',           'Troubleshooting & repairs'],
    ['shield-check',     'Completed to current code'],
    ['map-pin',          'Newberry · Alachua County'],
];

/* Service cards: the four services in config.php, copy drawn from the client's services page */
$homeCardCopy = [
    'residential-electrical' => [
        'icon'    => 'house',
        'desc'    => 'Wiring for new construction homes, panel upgrades, system improvements and repairs.',
        'bullets' => ['New construction home wiring', 'Panel and system upgrades', 'Built to current electrical code'],
    ],
    'commercial-electrical' => [
        'icon'    => 'building-2',
        'desc'    => 'New construction, system upgrades and electrical installations for local businesses.',
        'bullets' => ['Projects of all sizes', 'Limited disruption to operations', 'Code-compliant installations'],
    ],
    'generator-installation' => [
        'icon'    => 'battery-charging',
        'desc'    => 'Backup generator systems for homes or businesses, tied into existing wiring.',
        'bullets' => ['Home and business systems', 'Integrated with existing electrical', 'Ready before the next outage'],
    ],
    'electrical-repairs' => [
        'icon'    => 'wrench',
        'desc'    => 'Troubleshooting and repair for faulty outlets, lighting problems and system failures.',
        'bullets' => ['Residential and commercial calls', 'Faulty outlets and lighting', 'Done right the first time'],
    ],
];

/* Signature section: the four commitments the client's own site names (arrive when expected, clear
 * communication, respect for the property, right the first time). Not ordered, so no numbers. */
$homeCommitments = [
    ['clock',        'Arrive when expected',
     'Jordan Electric shows up at the time we agreed on, so you are not losing half a day waiting on an electrician.'],
    ['send',         'Clear communication',
     'You hear what we found, what we recommend and what happens next, in plain language rather than electrician shorthand.'],
    ['handshake',    'Respect for your property',
     'Every home and business gets the care you would want for your own family, from the driveway to the panel.'],
    ['check-circle', 'Done right the first time',
     'Troubleshooting means finding the cause, not just the symptom, so the repair holds and you are not calling again next month.'],
];

/* Process (real order): request → review → quote and schedule → work completed to code */
$homeProcess = [
    ['Tell us about the job', 'Use the quote form or call ' . $phone . ' to describe the work, ask a question or request service.'],
    ['We review your request', 'Every request is reviewed promptly, and Jordan Electric follows up with you to schedule.'],
    ['Quote and schedule', 'We scope the work you asked about, give you a quote, and set a time that suits you.'],
    ['Work completed to code', 'Residential and commercial work is completed to current electrical code, with your property treated with respect.'],
];

/* FAQs: questions the client's own site answers, plus the research brief's (placeholders and unverified claims removed) */
$homeFaqs = [
    ['q' => 'Is Jordan Electric a licensed electrical contractor in Florida?',
     'a' => 'Yes. Jordan Electric is a licensed electrical contractor in Florida, license ' . $homeLicense . '. You can confirm any contractor\'s license on the Florida DBPR license search before hiring, which is a good habit for any electrical work.'],
    ['q' => 'What areas does Jordan Electric serve?',
     'a' => 'Jordan Electric is based in Newberry, FL and serves residential and commercial customers across Alachua County and the surrounding areas. Call ' . $phone . ' to confirm we cover your address.'],
    ['q' => 'Does Jordan Electric wire new construction homes?',
     'a' => 'Yes. Jordan Electric wires new construction homes in Newberry and across Alachua County, completed to current electrical code. Talk to us while the build is still in planning so the panel, circuits and any generator or EV charger are part of the plan from day one.'],
    ['q' => 'Do you take on commercial electrical projects?',
     'a' => 'Yes. Jordan Electric handles commercial projects of all sizes, including new construction, system upgrades and electrical installations, planned to limit disruption to your daily operations and completed to code.'],
    ['q' => 'Can you install a backup generator for my home or business?',
     'a' => 'Yes. Jordan Electric installs backup generator systems for homes and businesses and integrates each one with the existing electrical setup, so the generator works with the system you already have.'],
    ['q' => 'How do I request a quote or schedule a service call?',
     'a' => 'Fill out the quote form on this page or call ' . $phone . ' with the details of your project. Jordan Electric reviews every request promptly and follows up to schedule service.'],
];

/* WebPage block ties the homepage to the LocalBusiness @id that head.php emits on the homepage */
$homeWebPage = [
    "@context"    => "https://schema.org",
    "@type"       => "WebPage",
    "@id"         => $canonicalUrl . '#webpage',
    "url"         => $canonicalUrl,
    "name"        => $pageTitle,
    "description" => $pageDescription,
    "about"       => ['@id' => p1_org_id()],
    "isPartOf"    => ["@type" => "WebSite", "name" => $siteName, "url" => $canonicalUrl],
];
$schemaMarkup = [$homeWebPage, generateFAQSchema($homeFaqs)];
$schemaBlocks = $schemaMarkup;                    // head.php renders $schemaBlocks after the LocalBusiness block
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<style>
/* ==========================================================================
   Homepage — Jordan Electric (minimal-tech: monochrome + one accent, precise lines)
   Page-scoped classes are prefixed .home- ; scaffold classes are only extended, never re-authored.
   ========================================================================== */

/* ---- Headings: balance everywhere on this page ---- */
.page-home h1, .page-home h2, .page-home h3 { text-wrap: balance; letter-spacing: -0.02em; }
.page-home p { text-wrap: pretty; }

/* ---- 1. Hero: layered type-led hero (C1.3) — radial glow ::before, noise ::after, measured grid ---- */
.home-hero { padding-block-end: clamp(var(--space-2xl), 6vw, var(--space-4xl)); }
.home-hero::before {
  content: "";
  position: absolute;
  inset: -30% -20% auto 35%;
  height: 130%;
  z-index: -2;
  pointer-events: none;
  background:
    radial-gradient(closest-side, color-mix(in srgb, var(--color-accent) 30%, transparent), transparent 72%),
    radial-gradient(40% 50% at 15% 90%, color-mix(in srgb, var(--color-secondary) 22%, transparent), transparent 70%);
  filter: blur(8px);
}
.home-hero::after {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  pointer-events: none;
  background-image:
    repeating-linear-gradient(90deg, color-mix(in srgb, var(--color-white) 6%, transparent) 0 1px, transparent 1px 64px),
    repeating-linear-gradient(0deg, color-mix(in srgb, var(--color-white) 6%, transparent) 0 1px, transparent 1px 64px);
  -webkit-mask-image: radial-gradient(80% 70% at 70% 40%, var(--color-black), transparent 75%);
  mask-image: radial-gradient(80% 70% at 70% 40%, var(--color-black), transparent 75%);
}
.home-hero .grain { z-index: -1; opacity: .35; }
.home-hero .floating-ring { top: -6rem; right: -7rem; opacity: .08; }
.home-hero .hero-title { max-width: 18ch; letter-spacing: -0.03em; }
.home-hero .hero-title .text-accent { color: var(--color-accent-bright); }
.home-hero .eyebrow { font-family: var(--font-accent); letter-spacing: .14em; }
.home-hero .hero-chips li svg { flex: 0 0 auto; }
.home-hero__visual { position: relative; }
.home-hero__visual::before {
  content: "";
  position: absolute;
  inset: calc(-1 * var(--space-md)) calc(-1 * var(--space-md)) auto auto;
  width: 46%;
  aspect-ratio: 1;
  border-top: 2px solid var(--color-accent);
  border-right: 2px solid var(--color-accent);
  border-radius: 0 var(--radius-lg) 0 0;
  opacity: .7;
  pointer-events: none;
}
.home-hero .hero-form-card { position: relative; }
/* Primary CTAs on the dark bands take the accent: the scaffold's ink-dark btn-primary vanishes on --color-dark */
.home-hero .hero-form-open, .home-storm .btn-primary {
  background: var(--color-accent);
  border-color: var(--color-accent);
  color: var(--color-white);
  box-shadow: 0 6px 0 var(--color-accent-dark), var(--shadow);
}
.home-hero .hero-form-open:hover, .home-storm .btn-primary:hover {
  background: color-mix(in srgb, var(--color-accent) 88%, var(--color-white));
  transform: translateY(-1px);
}
.home-hero .hero-form-open:active, .home-storm .btn-primary:active { transform: translateY(4px); box-shadow: 0 2px 0 var(--color-accent-dark); }
.home-hero .hero-form-card h2 { color: var(--color-ink); }
.home-hero .hero-form-card .consent a { color: var(--color-accent-dark); text-decoration: underline; }
.home-hero__spark {
  position: absolute;
  left: calc(-1 * var(--space-lg));
  top: var(--space-xl);
  width: 44px;
  height: 44px;
  border-radius: 50%;
  display: grid;
  place-items: center;
  color: var(--color-white);
  background: var(--color-accent);
  z-index: 2;
  box-shadow: var(--shadow-lg);
  animation: home-pulse 3.2s var(--ease) infinite;
}
@keyframes home-pulse {
  0%, 100% { box-shadow: 0 0 0 0 color-mix(in srgb, var(--color-accent) 45%, transparent); }
  50% { box-shadow: 0 0 0 12px color-mix(in srgb, var(--color-accent) 0%, transparent); }
}
@media (max-width: 900px) {
  .home-hero__visual::before, .home-hero__spark { display: none; }
}
@media (max-width: 560px) {
  .home-hero .hero-answer { font-size: var(--fs-body); }
  .home-hero .hero-chips { gap: var(--space-xs); }
  .home-hero .hero-chips li { font-size: var(--fs-small); }
}

/* ---- 2. Ticker: precise hairlines, accent icons ---- */
.home-ticker { background: var(--color-surface); }
.home-ticker .ticker-track svg { color: var(--color-accent-dark); }
.home-ticker .ticker-track > span::after {
  content: "";
  width: 6px;
  height: 6px;
  margin-inline-start: var(--space-xl);
  border-radius: 50%;
  background: var(--color-line);
}
.home-ticker:hover .ticker-track { animation-play-state: paused; }

/* ---- 3. Services: icon-fallback cards (no client photos on disk yet) ---- */
.home-services { background: var(--color-paper); }
.home-services .section-title { max-width: 68ch; }
.home-services .section-title .hero-answer { color: var(--color-ink-2); max-width: 64ch; }
.home-services .section-subtitle { color: var(--color-accent-dark); }
.home-services .prose { color: var(--color-muted); margin: 0; }
.home-services .services-grid { counter-reset: none; }
.home-services .service-card-with-image {
  border-top: 3px solid var(--color-primary);
  box-shadow: var(--shadow-sm);
}
.home-services .service-card-with-image:nth-child(3n+2) { border-top-color: var(--color-secondary); }
.home-services .service-card-with-image:nth-child(3n) { border-top-color: var(--color-accent); }
.home-services .service-card__body { padding: var(--space-xl) var(--space-lg) var(--space-lg); gap: var(--space-sm); display: flex; flex-direction: column; align-items: flex-start; }
.home-services .service-card__body > ul { width: 100%; }
.home-services .service-card__icon {
  width: 52px;
  height: 52px;
  border-radius: var(--radius);
  color: var(--color-accent-dark);
  background: var(--color-surface);
  border: 1px solid var(--color-line);
  transition: transform var(--transition), background var(--transition), color var(--transition);
}
.home-services .service-card-with-image:hover .service-card__icon {
  transform: translateY(-2px) rotate(-4deg);
  background: var(--color-accent);
  color: var(--color-white);
}
.home-services .service-card-with-image h3 { font-size: var(--fs-h3); color: var(--color-ink); }
.home-services .service-card__desc { color: var(--color-ink-2); font-size: var(--fs-small); }
.home-services .service-card-with-image ul {
  list-style: none;
  margin: var(--space-xs) 0 0;
  padding: var(--space-md) 0 0;
  display: grid;
  gap: var(--space-xs);
  border-top: 1px solid var(--color-line);
}
.home-services .service-card-with-image ul li {
  position: relative;
  padding-inline-start: var(--space-lg);
  font-size: var(--fs-small);
  color: var(--color-ink);
}
.home-services .service-card-with-image ul li::before {
  content: "";
  position: absolute;
  left: 0;
  top: .45em;
  width: 10px;
  height: 10px;
  background: var(--color-accent);
  clip-path: polygon(55% 0, 0 60%, 45% 60%, 35% 100%, 100% 38%, 55% 38%);
}
.home-services .service-card__cta {
  margin-top: auto;
  padding-top: var(--space-md);
  font-weight: 600;
  color: var(--color-accent-dark);
  text-decoration: none;
}
.home-services .service-card__cta:hover { color: var(--color-ink); }
.home-services__more { display: flex; flex-wrap: wrap; align-items: center; gap: var(--space-md) var(--space-lg); margin-top: var(--space-2xl); }
.home-services__more p { margin: 0; color: var(--color-muted); font-size: var(--fs-small); }

/* ---- 4. Signature (C7.3 pull quote + C7.4 alternating stagger), dark band, slant edge ---- */
.home-standard { padding-block-end: calc(var(--section-pad) + var(--space-xl)); }
.home-standard .floating-ring { bottom: -8rem; left: -6rem; opacity: .06; }
.home-standard__grid {
  display: grid;
  grid-template-columns: minmax(0, 5fr) minmax(0, 7fr);
  grid-template-areas: "intro list";
  gap: clamp(var(--space-xl), 6vw, var(--space-4xl));
  align-items: start;
}
.home-standard__intro { grid-area: intro; display: grid; gap: var(--space-lg); position: sticky; top: calc(var(--nav-height) + var(--space-xl)); }
.home-standard__intro .eyebrow { color: var(--color-accent-bright); }
.home-standard__intro > p { margin: 0; max-width: 46ch; }
.home-standard .pull-quote {
  color: var(--color-white);
  max-width: 18ch;
  padding-inline-start: var(--space-lg);
  border-inline-start: 3px solid var(--color-accent);
}
.home-standard .pull-quote::before { color: var(--color-accent-bright); }
.home-standard .pull-quote cite {
  display: block;
  margin-top: var(--space-sm);
  font-family: var(--font-accent);
  font-style: normal;
  font-weight: 600;
  font-size: var(--fs-small);
  letter-spacing: .14em;
  text-transform: uppercase;
  color: color-mix(in srgb, var(--color-white) 70%, transparent);
}
.home-standard__list {
  grid-area: list;
  list-style: none;
  margin: 0;
  padding: 0;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-lg);
}
.home-standard__item {
  position: relative;
  display: grid;
  gap: var(--space-sm);
  padding: var(--space-xl) var(--space-lg);
  border-radius: var(--radius-lg);
  background: color-mix(in srgb, var(--color-white) 5%, transparent);
  border: 1px solid color-mix(in srgb, var(--color-white) 12%, transparent);
  backdrop-filter: blur(6px);
  transition: border-color var(--transition), transform var(--transition);
}
.home-standard__item:nth-child(even) { margin-block-start: var(--space-2xl); }
.home-standard__item:hover {
  border-color: color-mix(in srgb, var(--color-accent) 60%, transparent);
  transform: translateY(-3px);
}
.home-standard__item svg { color: var(--color-accent-bright); }
.home-standard__item h3 { color: var(--color-white); font-size: var(--fs-h3); margin: 0; }
.home-standard__item p { margin: 0; font-size: var(--fs-small); }
@media (max-width: 900px) {
  .home-standard__grid { grid-template-columns: 1fr; grid-template-areas: "intro" "list"; }
  .home-standard__intro { position: static; }
}
@media (max-width: 600px) {
  .home-standard__list { grid-template-columns: 1fr; }
  .home-standard__item:nth-child(even) { margin-block-start: 0; }
}

/* ---- 5. About / process — the page's asymmetric section ---- */
.home-about { background: var(--color-surface); }
.home-about .about-split { grid-template-columns: minmax(0, 3fr) minmax(0, 2fr); align-items: start; }
.home-about .about-left { display: grid; gap: var(--space-md); }
.home-about .about-left > p { margin: 0; color: var(--color-ink-2); max-width: 62ch; }
.home-about .answer-block p { margin: 0; color: var(--color-ink-2); }
.home-about .process-steps { margin-top: var(--space-lg); }
.home-about .process-steps li { grid-template-rows: auto 1fr; }
.home-about .process-steps li b { color: var(--color-ink); }
.home-about .about-right { margin-top: var(--space-4xl); }
.home-about .about-right::before { inset: calc(-1 * var(--space-lg)) var(--space-lg) var(--space-lg) calc(-1 * var(--space-lg)); }
.home-plate {
  position: relative;
  z-index: 1;
  overflow: hidden;
  border-radius: var(--radius-lg);
  background: linear-gradient(160deg, var(--color-dark) 0%, var(--color-dark-alt) 100%);
  color: var(--color-white);
  box-shadow: var(--shadow-lg);
  clip-path: polygon(0 0, calc(100% - 36px) 0, 100% 36px, 100% 100%, 0 100%);
}
.home-plate__head {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: var(--space-md);
  padding: var(--space-lg) var(--space-lg) var(--space-md);
  border-bottom: 1px dashed color-mix(in srgb, var(--color-white) 22%, transparent);
}
.home-plate__head b {
  font-family: var(--font-heading);
  font-size: var(--fs-h3);
  letter-spacing: -0.01em;
}
.home-plate__head svg { color: var(--color-accent-bright); }
.home-plate dl { margin: 0; padding: var(--space-sm) var(--space-lg) var(--space-3xl); display: grid; }
.home-plate dl > div {
  display: grid;
  grid-template-columns: 9.5rem 1fr;
  gap: var(--space-md);
  padding-block: var(--space-sm);
  border-bottom: 1px solid color-mix(in srgb, var(--color-white) 10%, transparent);
}
.home-plate dl > div:last-child { border-bottom: 0; }
.home-plate dt {
  font-family: var(--font-accent);
  font-size: var(--fs-small);
  letter-spacing: .14em;
  text-transform: uppercase;
  color: color-mix(in srgb, var(--color-white) 62%, transparent);
}
.home-plate dd { margin: 0; font-weight: 600; color: var(--color-white); }
.home-about .about-stat-card { left: calc(-1 * var(--space-xl)); bottom: calc(-1 * var(--space-xl)); display: grid; gap: var(--space-1); }
.home-about .about-stat-card b {
  font-family: var(--font-accent);
  font-size: var(--fs-h2);
  line-height: 1;
  color: var(--color-accent-dark);
}
.home-about .about-stat-card span { font-size: var(--fs-small); color: var(--color-muted); }
@media (max-width: 900px) {
  .home-about .about-split { grid-template-columns: 1fr; }
  .home-about .about-right { margin-top: var(--space-xl); }
  .home-plate dl > div { grid-template-columns: 1fr; gap: var(--space-1); }
  .home-about .about-stat-card { left: var(--space-md); }
}

/* ---- 6. Storm-season band: dark, curved edge ---- */
.home-storm { text-align: center; }
.home-storm .container-narrow { display: grid; gap: var(--space-md); justify-items: center; }
.home-storm .eyebrow { color: var(--color-accent-bright); }
.home-storm h2 { max-width: 24ch; }
.home-storm p { max-width: 58ch; margin: 0; }
.home-storm .actions { display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: var(--space-md) var(--space-lg); margin-top: var(--space-sm); }
.home-storm .link-call { color: color-mix(in srgb, var(--color-white) 88%, transparent); }
.home-storm .link-call svg { color: var(--color-white); }
.home-storm__bolt {
  position: absolute;
  right: 6%;
  top: 50%;
  z-index: -1;
  width: clamp(120px, 18vw, 240px);
  height: auto;
  color: var(--color-accent);
  opacity: .08;
  transform: translateY(-50%) rotate(12deg);
  pointer-events: none;
}

/* ---- 7. Reviews (rendered only when the Google feed has written reviews) ---- */
.home-reviews { background: var(--color-paper-2); }

/* ---- 8. FAQ ---- */
.home-faq { background: var(--color-paper); }
.home-faq .section-head { max-width: 62ch; }
.home-faq .faq summary { text-wrap: balance; }
.home-faq .faq[open] { border-top-color: var(--color-accent); }
.home-faq .faq p a { color: var(--color-accent-dark); text-decoration: underline; }

/* ---- 9. Estimate section ---- */
.home-estimate { background: var(--color-paper-2); }
.home-estimate .card {
  background: var(--color-surface);
  border: 1px solid var(--color-line);
  border-radius: var(--radius-lg);
  padding: clamp(var(--space-lg), 4vw, var(--space-2xl));
  box-shadow: var(--shadow);
  display: grid;
  gap: var(--space-md);
}
.home-estimate .card h2 { margin: 0; }
.home-estimate .card > p { margin: 0; color: var(--color-ink-2); }
.home-estimate .form-consent-fieldset { border: 0; padding: 0; margin: var(--space-md) 0 0; }
.home-estimate .form-consent-legend { font-weight: 600; font-size: var(--fs-small); margin-bottom: var(--space-xs); }
.home-estimate .form-consent-item a { color: var(--color-accent-dark); text-decoration: underline; }
.home-estimate__aside { display: grid; gap: var(--space-xl); padding-top: var(--space-md); }
.home-estimate__aside h3 { margin: 0 0 var(--space-sm); }
.home-estimate__aside .nap a { color: var(--color-ink); }
.home-estimate__area {
  margin: 0;
  padding-inline-start: var(--space-md);
  border-inline-start: 3px solid var(--color-accent);
  color: var(--color-ink-2);
  font-size: var(--fs-small);
}

/* ---- Card-container query: service cards tighten when their column is narrow ---- */
.home-services .services-grid > * { container-type: inline-size; }
@container (max-width: 240px) {
  .home-services .service-card__body { padding-inline: var(--space-md); }
}

/* ---- Reduced motion: stop the page's own loops ---- */
@media (prefers-reduced-motion: reduce) {
  .home-hero__spark { animation: none; }
  .home-standard__item, .home-services .service-card__icon { transition: none; }
}
</style>

<!-- ============ 1. HERO (minimal-tech: .hero--type) ============ -->
<section class="hero hero--type home-hero" aria-labelledby="home-hero-title">
  <span class="grain" aria-hidden="true"></span>
  <span class="floating-ring float-animate-slow" aria-hidden="true"></span>
  <div class="container">
    <div class="hero-grid hero-grid--form">
      <div class="hero-text">
        <span class="eyebrow"><?php echo p1_esc($address['city'] . ', ' . $address['state']); ?> · <?php echo p1_esc($primaryCounty); ?></span>
        <h1 class="hero-title" id="home-hero-title">New home electrician in <span class="text-accent">Newberry, FL</span></h1>
        <p class="hero-answer">Jordan Electric wires new homes, businesses and generators in Alachua County.</p>
        <div class="hero-actions">
          <button type="button" class="btn btn-primary btn-lg hero-form-open" data-open-estimate>Get a free quote</button>
          <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
        </div>
        <ul class="hero-chips">
          <?php if ($homeLicense !== ''): ?><li><?php icon('badge-check', 16); ?>License <?php echo p1_esc($homeLicense); ?></li><?php endif; ?>
          <li><?php icon('zap', 16); ?>Over <?php echo (int) $yearsExperience; ?> years hands-on</li>
          <li><?php icon('building-2', 16); ?>Residential + commercial</li>
        </ul>
      </div>

      <div class="home-hero__visual">
        <span class="home-hero__spark" aria-hidden="true"><?php icon('zap', 22); ?></span>
        <aside class="hero-form-card" id="estimate-form" aria-labelledby="hero-form-title">
          <h2 id="hero-form-title">Get a free quote</h2>
          <p class="hero-form-tagline">No obligation. Every request is reviewed promptly.</p>
          <form id="hero" action="<?php echo p1_esc($formAction); ?>" method="POST" class="hero-form">
            <input type="hidden" name="_next" value="<?= htmlspecialchars($siteUrl) ?>/thank-you">
            <input type="text" name="_honey" style="display:none !important" tabindex="-1" autocomplete="off" aria-hidden="true">
            <input type="hidden" name="form_location" value="hero">
            <input type="hidden" name="consent_version" value="v2.1">
            <input type="hidden" name="consent_page" value="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
            <?php echo p1_attribution_fields('hero'); ?>
            <div class="form-row"><label class="sr-only" for="hero-name">Name</label><input id="hero-name" type="text" name="name" placeholder="Name" autocomplete="name" required></div>
            <div class="form-row"><label class="sr-only" for="hero-phone">Phone</label><input id="hero-phone" type="tel" name="phone" placeholder="Phone" autocomplete="tel" required></div>
            <div class="form-row"><label class="sr-only" for="hero-service">Service</label>
              <select id="hero-service" name="service">
                <option value="">What do you need?</option>
                <?php foreach ($services as $heroSvc): ?>
                <option value="<?php echo p1_esc($heroSvc['name']); ?>"><?php echo p1_esc($heroSvc['name']); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <label class="consent" for="hero-terms"><input id="hero-terms" type="checkbox" name="terms_accepted" value="yes" required><span>I agree to the <a href="/terms/" target="_blank" rel="noopener">Terms</a> and <a href="/privacy-policy/" target="_blank" rel="noopener">Privacy Policy</a> and consent to be contacted. *</span></label>
            <button type="submit" class="btn btn-primary btn-block">Get my free quote</button>
          </form>
        </aside>
      </div>
    </div>
  </div>
</section>

<!-- ============ 2. TICKER ============ -->
<div class="ticker-strip home-ticker" aria-hidden="true">
  <div class="ticker-track">
    <?php for ($homeLoop = 0; $homeLoop < 2; $homeLoop++): foreach ($homeTicker as $homeTick): ?>
    <span><?php icon($homeTick[0], 18); ?><?php echo p1_esc($homeTick[1]); ?></span>
    <?php endforeach; endfor; ?>
  </div>
</div>

<!-- ============ 3. SERVICES ============ -->
<section class="section home-services" id="services" aria-label="Electrician services">
  <div class="container">
    <div class="section-title reveal-up">
      <span class="eyebrow-label">What We Do</span>
      <h2>Which <span class="text-accent">electrical services</span> does Jordan Electric offer in Newberry?</h2>
      <p class="hero-answer">Jordan Electric, a licensed Florida electrical contractor based in Newberry, handles four kinds of work across Alachua County: residential electrical from new construction wiring to panel upgrades, commercial electrical for businesses of every size, backup generator installation, and service calls that track down faulty outlets, lighting problems and system failures.</p>
      <span class="section-subtitle">Wired for Excellence</span>
      <p class="prose">Building a new home? The wiring is planned and run during construction. Already moved in or open for business? The same team handles the upgrade, the generator tie-in and the repair call.</p>
    </div>

    <div class="services-grid">
      <?php foreach ($services as $homeIdx => $homeSvc):
        $homeCopy = $homeCardCopy[$homeSvc['slug']] ?? ['icon' => 'zap', 'desc' => $homeSvc['description'], 'bullets' => []];
        $homeTint = ($homeIdx % 3) + 1; ?>
      <article class="service-card-with-image card-tint-<?php echo $homeTint; ?> reveal-up reveal-delay-<?php echo $homeTint; ?>">
        <div class="service-card__body">
          <div class="service-card__icon"><?php icon($homeCopy['icon'], 26); ?></div>
          <h3><?php echo p1_esc($homeSvc['name']); ?></h3>
          <p class="service-card__desc"><?php echo p1_esc($homeCopy['desc']); ?></p>
          <ul>
            <?php foreach ($homeCopy['bullets'] as $homeBullet): ?>
            <li><?php echo p1_esc($homeBullet); ?></li>
            <?php endforeach; ?>
          </ul>
          <a href="/services/<?php echo p1_esc($homeSvc['slug']); ?>/" class="service-card__cta">Learn more<span class="sr-only"> about <?php echo p1_esc(strtolower($homeSvc['name'])); ?></span></a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

    <div class="home-services__more reveal-up">
      <a class="btn btn-secondary" href="/services/">View All Services <?php icon('arrow-right', 18); ?></a>
      <p>Not sure which one fits? Describe the problem in the quote form and we will sort it out.</p>
    </div>
  </div>
</section>

<!-- ============ 4. SIGNATURE: the Jordan Electric standard (dark, slant edge) ============ -->
<section class="section texture-grain slant-top home-standard" aria-labelledby="home-standard-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <span class="floating-ring" aria-hidden="true"></span>
  <div class="container-wide">
    <div class="home-standard__grid">
      <div class="home-standard__intro reveal-left">
        <span class="eyebrow">How we work</span>
        <h2 id="home-standard-title">How does Jordan Electric treat your home or business?</h2>
        <p>Jordan Electric holds every job, residential or commercial, to the same four commitments: show up when expected, explain the work clearly, respect the property and get it right the first time.</p>
        <blockquote class="pull-quote">Electrical work done right the first time.<cite>The standard on every Jordan Electric job</cite></blockquote>
      </div>
      <ul class="home-standard__list">
        <?php foreach ($homeCommitments as $homeCi => $homeCommit): ?>
        <li class="home-standard__item <?php echo $homeCi % 2 ? 'reveal-right' : 'reveal-up'; ?> reveal-delay-<?php echo ($homeCi % 3) + 1; ?>">
          <?php icon($homeCommit[0], 26); ?>
          <h3><?php echo p1_esc($homeCommit[1]); ?></h3>
          <p><?php echo p1_esc($homeCommit[2]); ?></p>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<!-- ============ 5. ABOUT / PROCESS (asymmetric) ============ -->
<section class="section home-about" id="about" aria-labelledby="home-about-title">
  <div class="container">
    <div class="about-split">
      <div class="about-left reveal-left">
        <span class="eyebrow">About Jordan Electric</span>
        <h2 id="home-about-title">Who is behind <span class="text-accent">Jordan Electric</span> in Newberry?</h2>
        <div class="answer-block">
          <h3>Is Jordan Electric a local company?</h3>
          <p>Yes. Jordan Electric is a family-managed electrical contractor based in Newberry, FL, established in 2026 and run by an electrician born and raised in Alachua County.</p>
        </div>
        <p>Jordan Electric is new as a company and not new to the trade: it is built on over <?php echo (int) $yearsExperience; ?> years of hands-on electrical experience. An early interest in electricity became a career, and opening a local shop was both a personal and a professional goal.</p>
        <p>That experience covers residential service calls, new construction homes, commercial projects, system upgrades, troubleshooting, EV charger installations and backup generator systems. The standard does not change with the job size: safety, precision and work that lasts.</p>
        <h3>How a job with Jordan Electric works</h3>
        <ol class="process-steps">
          <?php foreach ($homeProcess as $homeStep): ?>
          <li><b><?php echo p1_esc($homeStep[0]); ?></b><span><?php echo p1_esc($homeStep[1]); ?></span></li>
          <?php endforeach; ?>
        </ol>
      </div>

      <div class="about-right reveal-right">
        <div class="home-plate" role="group" aria-label="Jordan Electric at a glance">
          <div class="home-plate__head"><b><?php echo p1_esc($siteName); ?></b><?php icon('zap', 26); ?></div>
          <dl>
            <div><dt>Established</dt><dd><?php echo (int) $yearEstablished; ?></dd></div>
            <div><dt>Based in</dt><dd><?php echo p1_esc($address['city'] . ', ' . $address['state']); ?></dd></div>
            <div><dt>Serving</dt><dd><?php echo p1_esc($primaryCounty); ?> and surrounding areas</dd></div>
            <div><dt>Managed</dt><dd>Family-managed, locally connected</dd></div>
            <div><dt>Work</dt><dd>Residential · Commercial · Generators · EV chargers</dd></div>
          </dl>
        </div>
        <div class="about-stat-card">
          <b><?php echo (int) $yearsExperience; ?>+ years</b>
          <span>of hands-on electrical experience</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ 6. STORM SEASON / BACKUP POWER (dark, curved edge) ============ -->
<section class="section cta-banner texture-grain edge-curve-top home-storm" aria-labelledby="home-storm-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <svg class="home-storm__bolt" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/></svg>
  <div class="container-narrow reveal-scale">
    <span class="eyebrow">Hurricane season runs June 1 – November 30</span>
    <h2 id="home-storm-title">Is your home or business ready for the next outage?</h2>
    <p>Florida's Atlantic hurricane season runs from June 1 through November 30, and a summer thunderstorm can drop the power just as easily. Jordan Electric installs backup generator systems for homes and businesses and integrates each one with the electrical system you already have, so the plan is in place before the lights go out.</p>
    <div class="actions">
      <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Ask about a generator</button>
      <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
    </div>
  </div>
</section>

<!-- ============ 7. GOOGLE REVIEWS (Page One feed; renders nothing until real reviews exist) ============ -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/google-reviews.php';
$homeReviews = p1_google_reviews($slug, ['heading' => 'What Newberry customers say on Google']);
if ($homeReviews !== ''): ?>
<section class="section home-reviews" aria-label="Google reviews"><div class="container-wide"><?php echo $homeReviews; ?></div></section>
<?php endif; ?>

<!-- ============ 8. FAQ ============ -->
<section class="section home-faq" id="faq" aria-labelledby="home-faq-title">
  <div class="container">
    <div class="section-head reveal-up">
      <span class="eyebrow">Questions</span>
      <h2 id="home-faq-title">What do Newberry customers ask <span class="text-accent">Jordan Electric</span>?</h2>
      <p>Newberry customers usually ask Jordan Electric about licensing, the service area, new construction wiring, commercial projects, backup generators and how to get a quote. The answers below cover each one in plain terms.</p>
    </div>
    <div class="faq-grid reveal-up">
      <?php foreach ($homeFaqs as $homeFi => $homeFaq): ?>
      <details class="faq"<?php echo $homeFi < 2 ? ' open' : ''; ?>>
        <summary><?php echo p1_esc($homeFaq['q']); ?></summary>
        <p><?php echo p1_esc($homeFaq['a']); ?><?php if ($homeFi === 0 && !empty($licenseLookupUrl)): ?> <a href="<?php echo p1_esc($licenseLookupUrl); ?>" target="_blank" rel="noopener">Open the DBPR license search</a>.<?php endif; ?></p>
      </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ 9. ESTIMATE SECTION (full form) ============ -->
<section class="section home-estimate" id="estimate" aria-labelledby="home-estimate-title">
  <div class="container estimate">
    <div class="card reveal-up">
      <span class="eyebrow">Free quote</span>
      <h2 id="home-estimate-title">Tell us about the job</h2>
      <p>New construction, a commercial project, a generator or a repair call: a few details get the right electrician looking at it.</p>
      <form id="estimate-section-form" action="<?php echo p1_esc($formAction); ?>" method="POST" class="estimate-form">
        <input type="text" name="_honey" style="display:none !important" tabindex="-1" autocomplete="off" aria-hidden="true">
        <input type="hidden" name="_next" value="<?php echo htmlspecialchars($siteUrl); ?>/thank-you">
        <input type="hidden" name="form_location" value="estimate-section">
        <?php echo p1_attribution_fields('estimate-section'); ?>
        <input type="hidden" name="consent_version" value="v2.1">
        <input type="hidden" name="consent_page" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
        <div class="form-grid">
          <div class="field"><label for="est-name">Your name *</label><input id="est-name" type="text" name="name" autocomplete="name" required></div>
          <div class="field"><label for="est-phone">Phone *</label><input id="est-phone" type="tel" name="phone" autocomplete="tel" required></div>
          <div class="field"><label for="est-email">Email *</label><input id="est-email" type="email" name="email" autocomplete="email" required></div>
          <div class="field"><label for="est-service">Service needed</label>
            <select id="est-service" name="service">
              <option value="">Select a service</option>
              <?php foreach ($services as $estSvc): ?>
              <option value="<?php echo p1_esc($estSvc['name']); ?>"><?php echo p1_esc($estSvc['name']); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="field full"><label for="est-message">About the job</label><textarea id="est-message" name="message" rows="4"></textarea></div>
        </div>
        <fieldset class="form-consent-fieldset">
          <legend class="form-consent-legend">Communication consent</legend>
          <label class="form-consent-item" for="est-email-opt">
            <input id="est-email-opt" type="checkbox" name="email_opt_in" value="yes" class="consent-checkbox">
            <span class="consent-label"><strong>Email updates (optional):</strong> I agree to receive emails from <?php echo htmlspecialchars($siteName); ?> about my inquiry, services, promotions, and news. I understand I can unsubscribe anytime via the link in any email or by emailing <?php echo htmlspecialchars($contactEmail); ?>. Message frequency varies.</span>
          </label>
          <label class="form-consent-item" for="est-sms-opt">
            <input id="est-sms-opt" type="checkbox" name="sms_opt_in" value="yes" class="consent-checkbox">
            <span class="consent-label"><strong>SMS/Text messages (optional):</strong> I agree to receive text messages from <?php echo htmlspecialchars($siteName); ?> at the phone number I provided. Message types may include appointment reminders, service updates, and promotional offers. Message frequency varies. Message and data rates may apply. Reply STOP to unsubscribe, HELP for help. <strong>Consent is not a condition of purchase.</strong></span>
          </label>
          <label class="form-consent-item form-consent-required" for="est-terms">
            <input id="est-terms" type="checkbox" name="terms_accepted" value="yes" class="consent-checkbox" required>
            <span class="consent-label">I have read and agree to the <a href="/privacy-policy/">Privacy Policy</a> and <a href="/terms/">Terms of Service</a>. <span class="required-star">*</span></span>
          </label>
        </fieldset>
        <button type="submit" class="btn btn-primary btn-lg">Send my request</button>
      </form>
    </div>

    <div class="home-estimate__aside reveal-right">
      <div>
        <h3>What happens next</h3>
        <ol class="next-steps">
          <li><strong>You send the details.</strong> The form above, or a call to <?php echo p1_esc($phone); ?>.</li>
          <li><strong>We review your request.</strong> Every request is reviewed promptly.</li>
          <li><strong>We follow up to schedule.</strong> You get a quote and a time that works for you.</li>
        </ol>
      </div>
      <div class="nap">
        <div><?php icon('phone', 20); ?><a href="tel:<?php echo p1_esc($phoneE164); ?>"><?php echo p1_esc($phone); ?></a></div>
        <div><?php icon('mail', 20); ?><a href="mailto:<?php echo p1_esc($email); ?>"><?php echo p1_esc($email); ?></a></div>
        <div><?php icon('map-pin', 20); ?><span><?php echo !empty($addressIsPoBox) ? 'Mailing address: ' : ''; ?><?php echo p1_esc($address['street'] . ', ' . $address['city'] . ', ' . $address['state'] . ' ' . $address['zip']); ?></span></div>
      </div>
      <p class="home-estimate__area">Jordan Electric serves homeowners and businesses in Newberry and across <?php echo p1_esc($primaryCounty); ?> and the surrounding areas.</p>
    </div>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
