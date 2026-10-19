<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup: Accessibility Statement (legal-compliance.md, Accessibility template) --------------------------
 * Feature list matches what includes/header.php, framework.css and main.js really ship: skip link, landmarks,
 * :focus-visible ring, labelled form fields, aria-expanded/aria-current, reduced-motion support, native <dialog>
 * and native disclosure elements (keyboard operable). Conformance is stated as "partial" until an audit says otherwise.
 */
$pageTitle       = 'Accessibility Statement | Jordan Electric, Newberry, FL';
$pageDescription = 'Jordan Electric LLC works to meet WCAG 2.1 Level AA on this website. Read about accessibility features and known limits, or call (352) 472-5511 for help.';
$metaDescription = $pageDescription;
$canonicalUrl    = $siteUrl . '/accessibility/';
$ogImage         = '';
$currentPage     = 'accessibility';
$pageType        = 'other';
$bodyClass       = 'legal-page';
$lastUpdated     = 'October 19, 2026';
$legalName       = 'Accessibility Statement';
$legalSub        = 'Our commitment to a website everyone can use, and how to tell us when it falls short.';
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
          <li><a href="#commitment">Our commitment</a></li>
          <li><a href="#conformance">Conformance status</a></li>
          <li><a href="#features">Accessibility features</a></li>
          <li><a href="#known-issues">Known limitations</a></li>
          <li><a href="#feedback">Feedback and reporting issues</a></li>
          <li><a href="#alternatives">Other ways to reach us</a></li>
          <li><a href="#changes">Changes to this statement</a></li>
          <li><a href="#contact">Contact us</a></li>
        </ol>
      </nav>

      <h2 id="commitment">1. Our commitment</h2>
      <p><?php echo p1_esc($companyName); ?> is committed to making <?php echo p1_esc($domain); ?> usable by people with disabilities. We work to improve the experience for every visitor and to apply recognized accessibility standards as the site grows.</p>

      <h2 id="conformance">2. Conformance status</h2>
      <p>This site is designed to conform with the Web Content Accessibility Guidelines (WCAG) 2.1 at Level AA. The guidelines set out how to make web content more accessible to people with visual, hearing, motor and cognitive disabilities. We believe the site partially conforms with WCAG 2.1 Level AA, which means some content may not yet fully meet the standard. We are working to close any gaps we find.</p>

      <h2 id="features">3. Accessibility features</h2>
      <ul>
        <li>A &ldquo;Skip to main content&rdquo; link at the top of every page</li>
        <li>Semantic page structure with header, navigation, main and footer landmarks, and one main heading per page</li>
        <li>A visible keyboard focus outline on links, buttons and form fields</li>
        <li>Menus, the quote dialog and the FAQ answers that work from the keyboard, with menu state announced to screen readers</li>
        <li>Text labels tied to every form field, and clear marking of required fields</li>
        <li>Descriptive alternative text on meaningful images; decorative graphics are hidden from assistive technology</li>
        <li>Text and button colors chosen for readable contrast</li>
        <li>A layout that adapts to phones, tablets and desktops, and to larger text sizes and zoom</li>
        <li>Respect for the &ldquo;reduce motion&rdquo; setting on your device: animations are switched off</li>
        <li>Phone, email and mail options everywhere a form is offered</li>
      </ul>

      <h2 id="known-issues">4. Known limitations</h2>
      <ul>
        <li>Content from other companies that we may add, such as a map or a reviews widget, is outside our control and may not fully meet WCAG. If one is hard to use, call or email us and we will give you the same information directly.</li>
        <li>Documents we may provide for download, such as PDFs, may not be fully accessible. Ask us and we will provide the information in another format.</li>
      </ul>

      <h2 id="feedback">5. Feedback and reporting issues</h2>
      <p>If you run into a barrier on this site, please tell us which page it was on, what you were trying to do, and the assistive technology or browser you use if you are comfortable sharing it. We aim to reply within 5 business days and to fix confirmed problems as quickly as we reasonably can.</p>

      <h2 id="alternatives">6. Other ways to reach us</h2>
      <p>If the website does not work for you, you can call <a href="tel:<?php echo p1_esc($companyPhoneE164); ?>"><?php echo p1_esc($companyPhone); ?></a>, email <a href="mailto:<?php echo p1_esc($companyEmail); ?>"><?php echo p1_esc($companyEmail); ?></a> or write to us at the mailing address below. We will provide service information in an alternative format on request.</p>

      <h2 id="changes">7. Changes to this statement</h2>
      <p>We review this statement when the site changes in a meaningful way. The &ldquo;Last updated&rdquo; date shows the latest version.</p>

      <h2 id="contact">8. Contact us</h2>
      <div class="legal-contact">
        <strong><?php echo p1_esc($companyName); ?></strong>
        <span>Email: <a href="mailto:<?php echo p1_esc($companyEmail); ?>"><?php echo p1_esc($companyEmail); ?></a></span>
        <span>Phone: <a href="tel:<?php echo p1_esc($companyPhoneE164); ?>"><?php echo p1_esc($companyPhone); ?></a></span>
        <span>Mail: <?php echo p1_esc($companyAddress); ?></span>
      </div>

      <p class="legal-updated">Last updated: <?php echo p1_esc($lastUpdated); ?>. See also our <a href="/privacy-policy/">Privacy Policy</a>, <a href="/terms/">Terms of Service</a> and <a href="/cookie-policy/">Cookie Policy</a>.</p>
    </article>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
