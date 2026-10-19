<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup: Contact (/contact/) -----------------------------------------------------------------------
 * The one page that keeps the FULL form (v6.3). Posts to build-plan form_action ($formAction) with the three unbundled
 * consent checkboxes (email opt-in, SMS opt-in, required terms), consent version + page, attribution fields and the
 * honeypot. Field names follow the leads endpoint contract: name, phone, email, service, message.
 * Hours are not in the build plan, so they render only when config.php supplies them. The map renders only when the
 * client supplies a Google Business Profile embed ($gbp['embed_src']); until then the page shows the service-area
 * panel instead of an empty frame. Mailing address is a PO box, so no "visit us" claim and no directions button.
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
$pageTitle       = 'Contact Jordan Electric | Electrician in Newberry, FL';
$pageDescription = 'Contact Jordan Electric in Newberry, FL: call ' . $phone . ' or send the quote form for residential, commercial, generator and repair work across Alachua County.';
$metaDescription = $pageDescription;
$canonicalUrl    = $siteUrl . '/contact/';
$ogImage         = '';
$currentPage     = 'contact';
$pageType        = 'contact';
$bodyClass       = 'svc-page page-contact';

$conSteps = [
    ['You send the details', 'Use the form or call ' . $phone . '. Include the address, what you need and, for a repair, what you noticed.'],
    ['We review your request', 'Every request is reviewed promptly.'],
    ['We follow up to schedule', 'You hear back with next steps and a time that works for you.'],
];

$conLocalBusiness = [
    '@type' => 'ContactPage', '@id' => $canonicalUrl . '#webpage', 'url' => $canonicalUrl, 'name' => $pageTitle, 'description' => $pageDescription,
    'isPartOf' => ['@type' => 'WebSite', 'name' => $siteName, 'url' => rtrim($siteUrl, '/') . '/'],
    'about' => ['@id' => p1_org_id()],
    'speakable' => ['@type' => 'SpeakableSpecification', 'cssSelector' => ['h1', '.hero-answer']],
];
$schemaBlocks = [[
    '@context' => 'https://schema.org',
    '@graph'   => [
        $conLocalBusiness,
        ['@type' => 'BreadcrumbList', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => rtrim($siteUrl, '/') . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Contact', 'item' => $canonicalUrl],
        ]],
    ],
]];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?>

/* ==========================================================================
   Contact — page-specific composition (.con-)
   Signature: the form card overlaps the hero edge (broken grid) beside a dark details panel.
   ========================================================================== */
.page-contact .svc-hero::before {
  inset: -30% -15% auto 45%;
  background:
    radial-gradient(closest-side, color-mix(in srgb, var(--color-accent) 24%, transparent), transparent 70%),
    radial-gradient(45% 55% at 0% 100%, color-mix(in srgb, var(--color-secondary) 26%, transparent), transparent 70%);
}
.page-contact .svc-hero .hero-grid { grid-template-columns: minmax(0, 1fr); }
.page-contact .svc-hero { padding-block-end: clamp(var(--space-3xl), 9vw, 7rem); }
.page-contact .svc-hero .hero-title { max-width: 20ch; }

.con-main { background: var(--color-paper); padding-top: 0; }
.con-grid { display: grid; grid-template-columns: minmax(0, 3fr) minmax(0, 2fr); gap: clamp(var(--space-lg), 4vw, var(--space-3xl)); align-items: start; margin-top: calc(-1 * clamp(var(--space-2xl), 6vw, 5rem)); position: relative; z-index: 2; }

.con-form { display: grid; gap: var(--space-md); padding: clamp(var(--space-lg), 3vw, var(--space-2xl)); border-radius: var(--radius-lg); background: var(--color-surface); border: 1px solid var(--color-line); border-top: 4px solid var(--color-accent); box-shadow: var(--shadow-lg); }
.con-form h2 { margin: 0; }
.con-form > p { margin: 0; color: var(--color-ink-2); max-width: 56ch; }
.con-form .estimate-form { display: grid; gap: var(--space-md); }
.con-form .form-consent-fieldset { display: grid; gap: var(--space-xs); padding: var(--space-md); border: 1px solid var(--color-line); border-radius: var(--radius); background: var(--color-paper); }
.con-form .form-consent-legend { padding-inline: var(--space-xs); color: var(--color-ink); }
.con-form .form-consent-item { margin: 0; }
.con-form .form-consent-item a { color: var(--color-accent-dark); text-decoration: underline; }
.con-form .required-star { color: var(--color-accent-dark); font-weight: 700; }
.con-form .btn { justify-self: start; }
.con-form__note { margin: 0; font-size: var(--fs-small); color: var(--color-muted); }

.con-side { display: grid; gap: var(--space-lg); }
.con-card { padding: var(--space-xl); border-radius: var(--radius-lg); background: var(--color-dark); color: var(--color-white); box-shadow: var(--shadow-lg); border-top: 4px solid var(--color-accent); display: grid; gap: var(--space-md); }
.con-card h2 { margin: 0; color: var(--color-white); font-size: var(--fs-h3); }
.con-list { list-style: none; margin: 0; padding: 0; display: grid; gap: var(--space-md); }
.con-list li { display: grid; grid-template-columns: auto 1fr; gap: var(--space-xs) var(--space-md); align-items: start; }
.con-list svg { grid-row: span 2; color: var(--color-accent-bright); margin-top: 2px; }
.con-list small { font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .14em; text-transform: uppercase; color: color-mix(in srgb, var(--color-white) 62%, transparent); }
.con-list a, .con-list span { color: var(--color-white); text-decoration: none; overflow-wrap: anywhere; }
.con-list a:hover { text-decoration: underline; }
.con-list .con-phone { font-family: var(--font-heading); font-size: var(--fs-h3); }

.con-area { padding: var(--space-xl); border-radius: var(--radius-lg); background: var(--color-card-tint-3); border: 1px solid var(--color-line); display: grid; gap: var(--space-sm); }
.con-area h2 { margin: 0; font-size: var(--fs-h3); }
.con-area p { margin: 0; color: var(--color-ink-2); font-size: var(--fs-small); }
.con-area a { color: var(--color-accent-dark); text-decoration: underline; text-underline-offset: .18em; }
.con-area .map-embed { margin-top: var(--space-xs); border: 1px solid var(--color-line); }
.con-area__chips { list-style: none; margin: 0; padding: 0; display: flex; flex-wrap: wrap; gap: var(--space-xs); }
.con-area__chips li { padding: var(--space-1) var(--space-sm); border-radius: var(--radius-full); background: var(--color-surface); border: 1px solid var(--color-line); font-size: var(--fs-small); }

.con-next { background: var(--color-surface); }
.con-next__grid { display: grid; grid-template-columns: minmax(0, 2fr) minmax(0, 3fr); gap: clamp(var(--space-xl), 5vw, var(--space-4xl)); align-items: start; }

@media (max-width: 900px) {
  .con-grid, .con-next__grid { grid-template-columns: 1fr; }
  .con-grid { margin-top: calc(-1 * var(--space-xl)); }
}
@media (max-width: 480px) {
  .con-form .btn { justify-self: stretch; }
}
</style>

<!-- ============ 1. HERO (interior, type-led; the form sits below, overlapping the edge) ============ -->
<section class="hero hero--interior svc-hero" aria-labelledby="con-hero-title">
  <span class="grain" aria-hidden="true"></span>
  <div class="container">
    <div class="hero-grid">
      <div class="hero-copy">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <ol>
            <li><a href="/">Home</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>
            <li><span aria-current="page">Contact</span></li>
          </ol>
        </nav>
        <span class="eyebrow">Contact · <?php echo p1_esc($address['city'] . ', ' . $address['state']); ?></span>
        <h1 class="hero-title" id="con-hero-title">Contact Jordan Electric in <span class="text-accent">Newberry, FL</span></h1>
        <p class="hero-answer">Call <a href="tel:<?php echo p1_esc($phoneE164); ?>"><?php echo p1_esc($phone); ?></a> or send the form below. Jordan Electric reviews every request and follows up to schedule.</p>
        <div class="hero-actions">
          <a class="btn btn-primary btn-lg hero-cta" href="#contact-form">Send a message</a>
          <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
        </div>
      </div>
    </div>
  </div>
</section>

<article class="svc-article" aria-labelledby="con-hero-title">

<!-- ============ 2. FORM + CONTACT DETAILS ============ -->
<section class="section con-main" aria-label="Contact form and details">
  <div class="container">
    <div class="con-grid">

      <div class="con-form" id="contact-form">
        <div>
          <span class="eyebrow">Request a quote</span>
          <h2>How can Jordan Electric help?</h2>
        </div>
        <p>Tell us about the job: new construction wiring, a panel upgrade, a commercial project, a generator or something that stopped working. A few details get the right electrician looking at it.</p>
        <form id="contact" action="<?php echo p1_esc($formAction); ?>" method="POST" class="estimate-form">
          <?php echo p1_lead_hidden_fields('contact'); ?>
          <!-- Requested form contract: underscore-prefixed consent record and honeypot, alongside the site-standard consent_* fields above -->
          <input type="hidden" name="_consent_version" value="v2.1">
          <input type="hidden" name="_consent_page" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'] ?? '/', ENT_QUOTES, 'UTF-8'); ?>">
          <input type="text" name="_honeypot" style="display:none" tabindex="-1" autocomplete="off" aria-hidden="true">
          <div class="form-grid">
            <div class="field"><label for="con-name">Your name *</label><input id="con-name" type="text" name="name" autocomplete="name" required></div>
            <div class="field"><label for="con-phone">Phone *</label><input id="con-phone" type="tel" name="phone" autocomplete="tel" required></div>
            <div class="field full"><label for="con-email">Email *</label><input id="con-email" type="email" name="email" autocomplete="email" required></div>
            <div class="field full"><label for="con-service">Service needed</label>
              <select id="con-service" name="service">
                <option value="">Select a service</option>
                <?php foreach ($services as $conSvc): ?>
                <option value="<?php echo p1_esc($conSvc['name']); ?>"><?php echo p1_esc($conSvc['name']); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="field full"><label for="con-message">About the job</label><textarea id="con-message" name="message" rows="5"></textarea></div>
          </div>

          <fieldset class="form-consent-fieldset">
            <legend class="form-consent-legend">Communication consent</legend>
            <label class="form-consent-item" for="con-email-opt">
              <input id="con-email-opt" type="checkbox" name="email_opt_in" value="yes" class="consent-checkbox">
              <span class="consent-label"><strong>Email updates (optional):</strong> I agree to receive emails from <?php echo p1_esc($siteName); ?> about my inquiry, services, promotions, and news. I understand I can unsubscribe anytime via the link in any email or by emailing <?php echo p1_esc($contactEmail); ?>. Message frequency varies.</span>
            </label>
            <label class="form-consent-item" for="con-sms-opt">
              <input id="con-sms-opt" type="checkbox" name="sms_opt_in" value="yes" class="consent-checkbox">
              <span class="consent-label"><strong>SMS/Text messages (optional):</strong> I agree to receive text messages from <?php echo p1_esc($siteName); ?> at the phone number I provided. Message types may include appointment reminders, service updates, and promotional offers. Message frequency varies. Message and data rates may apply. Reply STOP to unsubscribe, HELP for help. <strong>Consent is not a condition of purchase.</strong></span>
            </label>
            <label class="form-consent-item form-consent-required" for="con-terms">
              <input id="con-terms" type="checkbox" name="terms_accepted" value="yes" class="consent-checkbox" required>
              <span class="consent-label">I have read and agree to the <a href="/privacy-policy/" target="_blank" rel="noopener">Privacy Policy</a> and <a href="/terms/" target="_blank" rel="noopener">Terms of Service</a>. <span class="required-star">*</span></span>
            </label>
          </fieldset>

          <button type="submit" class="btn btn-primary btn-lg">Send my request</button>
          <p class="con-form__note">Fields marked * are required. Prefer to talk? Call <a href="tel:<?php echo p1_esc($phoneE164); ?>"><?php echo p1_esc($phone); ?></a>.</p>
        </form>
      </div>

      <div class="con-side">
        <aside class="con-card" aria-labelledby="con-details-title">
          <h2 id="con-details-title">Jordan Electric</h2>
          <ul class="con-list">
            <li><?php icon('phone', 22); ?><small>Phone</small><a class="con-phone" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php echo p1_esc($phone); ?></a></li>
            <li><?php icon('mail', 22); ?><small>Email</small><a href="mailto:<?php echo p1_esc($email); ?>"><?php echo p1_esc($email); ?></a></li>
            <li><?php icon('map-pin', 22); ?><small><?php echo !empty($addressIsPoBox) ? 'Mailing address' : 'Address'; ?></small><span><?php echo p1_esc($address['street'] . ', ' . $address['city'] . ', ' . $address['state'] . ' ' . $address['zip']); ?></span></li>
            <li><?php icon('clock', 22); ?><small>Business hours</small>
              <?php if (!empty($hours) && is_array($hours)): ?>
              <span><?php foreach ($hours as $conHour) { echo p1_esc($conHour) . '<br>'; } ?></span>
              <?php else: ?>
              <span>Call or send the form and we will confirm a time that works.</span>
              <?php endif; ?>
            </li>
          </ul>
        </aside>

        <aside class="con-area" aria-labelledby="con-area-title">
          <h2 id="con-area-title">Where does Jordan Electric work?</h2>
          <p>Jordan Electric is based in <?php echo p1_esc($address['city'] . ', ' . $address['state']); ?> and serves homes and businesses across <?php echo p1_esc($primaryCounty); ?> and the surrounding areas. Call to confirm we cover your address.</p>
          <ul class="con-area__chips" aria-label="Service area">
            <?php foreach ($serviceAreas as $conArea): ?><li><?php echo p1_esc($conArea); ?></li><?php endforeach; ?>
            <li><?php echo p1_esc($primaryCounty); ?></li>
          </ul>
          <?php if (!empty($gbp['embed_src'])): ?>
          <div class="map-embed"><iframe src="<?php echo p1_esc($gbp['embed_src']); ?>" title="Map of the Jordan Electric service area near Newberry, FL" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe></div>
          <?php endif; ?>
          <?php if (!empty($gbp['directions'])): ?>
          <a class="btn btn-secondary" href="<?php echo p1_esc($gbp['directions']); ?>" target="_blank" rel="noopener">Get directions</a>
          <?php endif; ?>
        </aside>
      </div>

    </div>
  </div>
</section>

<!-- ============ 3. WHAT HAPPENS NEXT ============ -->
<section class="section con-next edge-parallelogram-top" aria-labelledby="con-next-title">
  <div class="container">
    <div class="con-next__grid">
      <div class="svc-head reveal-left">
        <span class="eyebrow">What happens next</span>
        <h2 id="con-next-title">What happens after you contact Jordan Electric?</h2>
        <p class="answer-block">After you contact Jordan Electric, the request is reviewed promptly and someone follows up to schedule. For project questions you can also read the <a href="/faq/">frequently asked questions</a> or browse the <a href="/services/">electrical services</a>.</p>
      </div>
      <ol class="svc-steps reveal-right">
        <?php foreach ($conSteps as $conI => $conStep): ?>
        <li><h3><?php echo p1_esc($conStep[0]); ?></h3><p><?php echo p1_esc($conStep[1]); ?></p></li>
        <?php endforeach; ?>
      </ol>
    </div>
  </div>
</section>

</article>

<!-- ============ 4. FINAL CTA ============ -->
<section class="cta-banner texture-grain edge-curve-top svc-final" aria-labelledby="con-final-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container reveal-up">
    <div>
      <span class="eyebrow">Prefer to call?</span>
      <h2 id="con-final-title">Talk to Jordan Electric directly</h2>
      <p>Tell us what you need and where. We will let you know how we can help and when we can get started.</p>
    </div>
    <div class="actions">
      <a class="btn btn-primary btn-lg" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 20); ?>Call <?php echo p1_esc($phone); ?></a>
      <a class="link-call" href="mailto:<?php echo p1_esc($email); ?>"><?php icon('mail', 18); ?>or email us</a>
    </div>
  </div>
  <svg class="svc-final__mark" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/></svg>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
