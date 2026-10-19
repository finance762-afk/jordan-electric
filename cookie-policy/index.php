<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup: Cookie Policy (legal-compliance.md, Cookie Policy template) -----------------------------------
 * Lists what this build actually stores: p1_ft (first-party attribution cookie set by includes/attribution.php,
 * 30 days, HttpOnly, SameSite=Lax), the localStorage flag the cookie bar writes (cookieBannerDismissed_v1), and
 * Google Analytics 4 (_ga*), which is wired in head.php but commented out until a measurement ID is set in config.php.
 * Fonts are self-hosted, so no font-provider cookies. No map or reviews widget is embedded yet.
 * Update this page when GA4 is switched on or an embed is added.
 */
$pageTitle       = 'Cookie Policy | Jordan Electric, Newberry, FL';
$pageDescription = 'The cookies and browser storage the Jordan Electric LLC website uses in Newberry, FL, why we use them, and how to control or opt out of them.';
$metaDescription = $pageDescription;
$canonicalUrl    = $siteUrl . '/cookie-policy/';
$ogImage         = '';
$currentPage     = 'cookie-policy';
$pageType        = 'other';
$bodyClass       = 'legal-page';
$lastUpdated     = 'October 19, 2026';
$legalName       = 'Cookie Policy';
$legalSub        = 'The small files and browser storage this site uses, in plain terms.';
$schemaBlocks    = [p1_legal_page_schema($legalName, $canonicalUrl, $pageTitle, $pageDescription)];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/legal-page.css'; ?>
</style>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/legal-hero.php'; ?>

<section class="legal-body">
  <div class="container-narrow">
    <article class="legal-prose">

      <nav class="legal-toc" aria-label="On this page">
        <strong>On this page</strong>
        <ol>
          <li><a href="#what-are-cookies">What cookies are</a></li>
          <li><a href="#cookies-we-use">Cookies we use</a></li>
          <li><a href="#control">How to control cookies</a></li>
          <li><a href="#analytics-opt-out">Opt out of Google Analytics</a></li>
          <li><a href="#cookie-notice">Our cookie notice</a></li>
          <li><a href="#changes">Changes to this policy</a></li>
          <li><a href="#contact">Contact us</a></li>
        </ol>
      </nav>

      <h2 id="what-are-cookies">1. What cookies are</h2>
      <p>Cookies are small text files a website stores on your device. Browsers also offer &ldquo;local storage,&rdquo; which works in a similar way. Sites use both to work properly, to remember a choice you made, and to learn how visitors use them. This policy explains what <?php echo p1_esc($companyName); ?> uses on <?php echo p1_esc($domain); ?>. For how we handle the personal information you give us, see the <a href="/privacy-policy/">Privacy Policy</a>.</p>

      <h2 id="cookies-we-use">2. Cookies we use</h2>

      <h3>Strictly necessary and first-party</h3>
      <p>These keep the site working and let us tell which page a request came from. They are set by this site, not by an outside company.</p>
      <div class="legal-table-wrap">
        <table class="legal-table">
          <thead><tr><th scope="col">Name</th><th scope="col">What it does</th><th scope="col">How long</th></tr></thead>
          <tbody>
            <tr><th scope="row"><code>p1_ft</code> (cookie)</th><td>Records the first page you landed on, the site that referred you, any campaign tags in the link, your device type and a random session ID, so a quote request can be matched to the page or ad that brought you here. Contains no name, phone number or email.</td><td>30 days</td></tr>
            <tr><th scope="row"><code>cookieBannerDismissed_v1</code> (local storage)</th><td>Remembers that you dismissed the cookie notice so it does not appear again.</td><td>Until you clear your browser data</td></tr>
          </tbody>
        </table>
      </div>

      <h3>Analytics (Google Analytics 4)</h3>
      <p>Where we have switched it on, Google Analytics 4 sets cookies that begin with <code>_ga</code> to count visits, see which pages are read and understand how people reach the site. The data is aggregated and we do not use it to identify you personally. Analytics cookies last up to two years unless you delete them sooner.</p>

      <h3>Fonts, icons and images</h3>
      <p>This site serves its own fonts, icons and images, so loading them does not set cookies from a font or icon provider.</p>

      <h3>Third-party embeds</h3>
      <p>We may add tools from other companies, such as a Google map or a reviews widget. Those services can set their own cookies under their own privacy policies. If we add one, we will list it here.</p>

      <h2 id="control">3. How to control cookies</h2>
      <p>Most browsers let you see, delete and block cookies, and you can block third-party cookies only or all cookies. Blocking everything may stop parts of the site from working, and a blocked <code>p1_ft</code> cookie only means we cannot see which page brought you to us. Browser help pages from Google Chrome, Mozilla Firefox, Apple Safari and Microsoft Edge explain the steps.</p>

      <h2 id="analytics-opt-out">4. Opt out of Google Analytics</h2>
      <p>You can opt out of Google Analytics on all websites by installing the <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener">Google Analytics Opt-out Browser Add-on</a>.</p>

      <h2 id="cookie-notice">5. Our cookie notice</h2>
      <p>We show a short notice about cookies after you start scrolling. When you select &ldquo;Got it,&rdquo; the notice is dismissed and your browser remembers that choice in local storage. Clearing your browser&rsquo;s site data brings the notice back.</p>

      <h2 id="changes">6. Changes to this policy</h2>
      <p>We may update this policy, for example when we add analytics or an embedded tool. The &ldquo;Last updated&rdquo; date shows the latest version.</p>

      <h2 id="contact">7. Contact us</h2>
      <div class="legal-contact">
        <strong><?php echo p1_esc($companyName); ?></strong>
        <span>Email: <a href="mailto:<?php echo p1_esc($companyEmail); ?>"><?php echo p1_esc($companyEmail); ?></a></span>
        <span>Phone: <a href="tel:<?php echo p1_esc($companyPhoneE164); ?>"><?php echo p1_esc($companyPhone); ?></a></span>
        <span>Mail: <?php echo p1_esc($companyAddress); ?></span>
      </div>

      <p class="legal-updated">Last updated: <?php echo p1_esc($lastUpdated); ?>. See also our <a href="/privacy-policy/">Privacy Policy</a>, <a href="/terms/">Terms of Service</a> and <a href="/accessibility/">Accessibility Statement</a>.</p>
    </article>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
