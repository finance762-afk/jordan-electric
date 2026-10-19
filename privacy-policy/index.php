<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup: Privacy Policy (legal-compliance.md, Privacy Policy template) ---------------------------
 * Describes only what this site really does: contact/quote forms post to the Page One leads endpoint, a first-party
 * attribution cookie (p1_ft, 30 days) is set on the first pageview, and Google Analytics 4 is wired but stays off
 * until the client's measurement ID is set. Nothing is uploaded, nothing is sold. The "Last updated" date is fixed
 * (not date('F j, Y')) so it only moves when the text does.
 */
$pageTitle       = 'Privacy Policy and SMS Terms | Jordan Electric, Newberry';
$pageDescription = 'How Jordan Electric LLC in Newberry, FL collects, uses and protects your information, including quote forms and text-message consent. Call (352) 472-5511.';
$metaDescription = $pageDescription;
$canonicalUrl    = $siteUrl . '/privacy-policy/';
$ogImage         = '';
$currentPage     = 'privacy-policy';
$pageType        = 'other';
$bodyClass       = 'legal-page';
$lastUpdated     = 'October 19, 2026';
$legalName       = 'Privacy Policy';
$legalSub        = 'What Jordan Electric collects when you use this site or request a quote, and what you can do about it.';
$schemaBlocks    = [["@context" => "https://schema.org", "@graph" => p1_legal_page_nodes($legalName, $canonicalUrl, $pageTitle, $pageDescription)]];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/legal-page.css'; ?>
</style>

<section class="hero hero--legal" aria-labelledby="legal-title">
  <span class="grain" aria-hidden="true"></span>
  <div class="container">
    <div class="hero-legal__inner">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <ol>
          <li><a href="/">Home</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>
          <li><span aria-current="page"><?php echo p1_esc($legalName); ?></span></li>
        </ol>
      </nav>
      <span class="eyebrow">Legal</span>
      <h1 id="legal-title"><?php echo p1_esc($legalName); ?></h1>
      <p class="hero-legal__sub"><?php echo p1_esc($legalSub); ?></p>
      <p class="hero-legal__date">Last updated: <?php echo p1_esc($lastUpdated); ?></p>
    </div>
  </div>
</section>

<section class="legal-body">
  <div class="container-narrow">
    <article class="legal-prose">

      <nav class="legal-toc" aria-label="On this page">
        <strong>On this page</strong>
        <ol>
          <li><a href="#introduction">Introduction</a></li>
          <li><a href="#information-we-collect">Information we collect</a></li>
          <li><a href="#how-we-use">How we use it</a></li>
          <li><a href="#how-we-share">How we share it</a></li>
          <li><a href="#your-rights">Your privacy rights</a></li>
          <li><a href="#sms-phone">Calls, texts and email</a></li>
          <li><a href="#retention">Data retention</a></li>
          <li><a href="#security">Data security</a></li>
          <li><a href="#children">Children</a></li>
          <li><a href="#third-party-links">Third-party links</a></li>
          <li><a href="#changes">Changes to this policy</a></li>
          <li><a href="#contact">Contact us</a></li>
        </ol>
      </nav>

      <h2 id="introduction">1. Introduction</h2>
      <p>This Privacy Policy explains how <?php echo p1_esc($companyName); ?> (&ldquo;Jordan Electric,&rdquo; &ldquo;we,&rdquo; &ldquo;us,&rdquo; &ldquo;our&rdquo;), a Florida electrical contractor based in <?php echo p1_esc($address['city'] . ', ' . $address['state']); ?>, collects, uses and protects your personal information when you visit <?php echo p1_esc($domain); ?>, request a quote, or contact us about electrical work.</p>
      <p>By using this site you agree to the practices described here. If you do not agree, please do not submit your information through the site; you can always call us at <a href="tel:<?php echo p1_esc($companyPhoneE164); ?>"><?php echo p1_esc($companyPhone); ?></a> instead.</p>

      <h2 id="information-we-collect">2. Information we collect</h2>
      <ul>
        <li><strong>Information you give us:</strong> your name, phone number, email address, the service you are asking about, and anything you write about your project when you use a quote or contact form, call us, or email us.</li>
        <li><strong>Your consent choices:</strong> whether you ticked the optional email and text-message boxes and the required Terms and Privacy Policy box, plus the version of our consent wording and the page you submitted from. We keep this record so we can show what you agreed to.</li>
        <li><strong>Visit and source details:</strong> on your first page view we set a first-party cookie that records the page you landed on, the site that referred you, any campaign tags in the link (UTM parameters, Google Ads click ID), your device type (mobile, tablet or desktop) and a random session ID. When you submit a form, these details travel with it so we know which page or ad brought you to us.</li>
        <li><strong>Automatically collected technical data:</strong> IP address, browser type, device information, pages viewed and timestamps, from our hosting provider&rsquo;s server logs and, where enabled, Google Analytics 4.</li>
        <li><strong>Cookies and similar technologies:</strong> described in our <a href="/cookie-policy/">Cookie Policy</a>.</li>
      </ul>
      <p>We do not ask for payment card numbers, Social Security numbers or similar sensitive data through this site. Please do not include them in a message.</p>

      <h2 id="how-we-use">3. How we use your information</h2>
      <ul>
        <li>To answer your request, prepare a quote and schedule a visit</li>
        <li>To communicate with you during a project, including by phone, text message and email where you have agreed</li>
        <li>To keep records of estimates, work performed, licensing, insurance and tax as the law requires</li>
        <li>To understand which pages and campaigns bring in real requests, and to improve this site</li>
        <li>To detect and block spam and abuse of our forms</li>
        <li>To meet legal obligations and protect our rights</li>
      </ul>

      <h2 id="how-we-share">4. How we share your information</h2>
      <p>We do <strong>not</strong> sell your personal information, and we do not share it for cross-context behavioral advertising.</p>
      <ul>
        <li><strong>Our web design and hosting partner:</strong> Page One Insights, LLC builds and maintains this site and operates the lead-handling service that receives form submissions and forwards them to us. Page One Insights, LLC receives a copy of each submission and may view it to confirm it was delivered and to report on website performance.</li>
        <li><strong>Hosting and technology providers:</strong> the companies that host this site, deliver our email and text messages, and, where enabled, provide analytics (Google Analytics 4). They process data only to provide those services.</li>
        <li><strong>Subcontractors and suppliers:</strong> only as needed to carry out work you have asked us to perform.</li>
        <li><strong>Legal and safety:</strong> when required by Florida or federal law, a court order or a lawful request, or to protect people and property.</li>
        <li><strong>Business transfers:</strong> if the business is sold or merged, your information may transfer to the new owner under the same protections.</li>
      </ul>

      <h2 id="your-rights">5. Your privacy rights</h2>

      <h3 id="state-rights">Florida residents and residents of other states</h3>
      <p>You may ask us what personal information we hold about you, ask us to correct it, or ask us to delete it. Contact us using the details in section 12 and we will respond within 45 days. Residents of Colorado, Virginia, Connecticut, Utah, Texas and other states with consumer privacy laws have similar rights, and you can use the same contact methods to exercise them.</p>

      <h3 id="ccpa-rights">California residents (CCPA / CPRA) and &ldquo;Do Not Sell or Share&rdquo;</h3>
      <p>If you are a California resident, the California Consumer Privacy Act and California Privacy Rights Act give you the following rights:</p>
      <ul>
        <li><strong>Right to know</strong> what personal information we collect, use and disclose.</li>
        <li><strong>Right to delete</strong> personal information we collected from you, subject to legal exceptions.</li>
        <li><strong>Right to correct</strong> inaccurate personal information.</li>
        <li><strong>Right to opt out of sale or sharing.</strong> We do not sell or share personal information as those terms are defined by California law. You may still send an opt-out request, and we will record it and confirm that it has been honored.</li>
        <li><strong>Right to limit</strong> the use of sensitive personal information. We do not collect sensitive personal information through this site.</li>
        <li><strong>Right to non-discrimination.</strong> We will not deny you service or charge you a different price for exercising these rights.</li>
      </ul>
      <p><strong>To exercise any of these rights:</strong> email <a href="mailto:<?php echo p1_esc($companyEmail); ?>"><?php echo p1_esc($companyEmail); ?></a> with &ldquo;Privacy request&rdquo; in the subject line, or call <a href="tel:<?php echo p1_esc($companyPhoneE164); ?>"><?php echo p1_esc($companyPhone); ?></a>. We may need to confirm your identity before acting on a request.</p>

      <h2 id="sms-phone">6. Calls, text messages and email</h2>
      <p>If you tick the optional text-message box on a form, you agree that <?php echo p1_esc($companyName); ?> may text you at the number you provided with appointment reminders, service updates and promotional offers. Message frequency varies. Message and data rates may apply. <strong>Consent is not a condition of purchase.</strong> Reply STOP to any text to unsubscribe, or HELP for help.</p>
      <p>If you tick the optional email box, we may email you about your inquiry, our services, promotions and news. Every marketing email includes an unsubscribe link, and you can also write to <a href="mailto:<?php echo p1_esc($companyEmail); ?>"><?php echo p1_esc($companyEmail); ?></a> at any time. We will still contact you about a quote or job you requested, even if you decline marketing messages. We do not share your phone number or text-message opt-in with third parties for their own marketing.</p>

      <h2 id="retention">7. Data retention</h2>
      <p>We keep form submissions and job records for as long as we need them to provide service, answer questions about completed work and meet legal, tax and licensing obligations, which is commonly several years. When we no longer need information, we delete it or de-identify it.</p>

      <h2 id="security">8. Data security</h2>
      <p>This site is served over HTTPS, and form submissions are encrypted in transit. We use reasonable administrative and technical safeguards. No method of transmission or storage is completely secure, so we cannot guarantee absolute security.</p>

      <h2 id="children">9. Children&rsquo;s privacy</h2>
      <p>This site is not directed to children under 13, and we do not knowingly collect their information. If you believe a child has sent us personal information, contact us and we will delete it.</p>

      <h2 id="third-party-links">10. Third-party links</h2>
      <p>This site may link to other websites, such as the Florida Department of Business and Professional Regulation license search. We do not control those sites and are not responsible for their privacy practices. Review their policies separately.</p>

      <h2 id="changes">11. Changes to this policy</h2>
      <p>We may update this policy from time to time. The &ldquo;Last updated&rdquo; date at the top of the page shows when it last changed. If we make a material change, we will say so on this page.</p>

      <h2 id="contact">12. Contact us</h2>
      <div class="legal-contact">
        <strong><?php echo p1_esc($companyName); ?></strong>
        <span>Email: <a href="mailto:<?php echo p1_esc($companyEmail); ?>"><?php echo p1_esc($companyEmail); ?></a></span>
        <span>Phone: <a href="tel:<?php echo p1_esc($companyPhoneE164); ?>"><?php echo p1_esc($companyPhone); ?></a></span>
        <span>Mail: <?php echo p1_esc($companyAddress); ?></span>
      </div>

      <p class="legal-updated">Last updated: <?php echo p1_esc($lastUpdated); ?>. See also our <a href="/terms/">Terms of Service</a>, <a href="/cookie-policy/">Cookie Policy</a> and <a href="/accessibility/">Accessibility Statement</a>.</p>
    </article>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
