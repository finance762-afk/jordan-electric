<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup: Terms of Service (legal-compliance.md, Terms template) --------------------------------------
 * Adapted for an electrical contractor. Left out on purpose: the template's "Insurance Claim Work" clause (not an
 * insurance-restoration trade), any statement that workers are insured or covered by workers' compensation (insurance
 * is an open question in /content-confirmations.json), and any payment methods or financing (none supplied).
 * Governing law is Florida because that is where Jordan Electric is licensed and works; the formation state is
 * unconfirmed (see config.php). Fixed "Last updated" date, not date().
 */
$pageTitle       = 'Terms of Service | Jordan Electric Electrician, Newberry, FL';
$pageDescription = 'Terms of Service for the Jordan Electric LLC website and electrical services in Newberry, FL: estimates, project work, warranties, payment and governing law.';
$metaDescription = $pageDescription;
$canonicalUrl    = $siteUrl . '/terms/';
$ogImage         = '';
$currentPage     = 'terms';
$pageType        = 'other';
$bodyClass       = 'legal-page';
$lastUpdated     = 'October 19, 2026';
$legalName       = 'Terms of Service';
$legalSub        = 'The ground rules for using this site and for hiring Jordan Electric.';
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
          <li><a href="#agreement">Agreement to terms</a></li>
          <li><a href="#website-use">Use of this website</a></li>
          <li><a href="#estimates">Estimates and quotes</a></li>
          <li><a href="#project-work">Project work</a></li>
          <li><a href="#warranties">Warranties</a></li>
          <li><a href="#payment">Payment terms</a></li>
          <li><a href="#cancellation">Cancellation</a></li>
          <li><a href="#safety">Safety information on this site</a></li>
          <li><a href="#liability">Limitation of liability</a></li>
          <li><a href="#intellectual-property">Intellectual property</a></li>
          <li><a href="#governing-law">Governing law and disputes</a></li>
          <li><a href="#changes">Changes to these terms</a></li>
          <li><a href="#contact">Contact us</a></li>
        </ol>
      </nav>

      <h2 id="agreement">1. Agreement to terms</h2>
      <p>By using <?php echo p1_esc($domain); ?> or by asking <?php echo p1_esc($companyName); ?> (&ldquo;Jordan Electric,&rdquo; &ldquo;we,&rdquo; &ldquo;us&rdquo;) for a quote or services, you agree to these Terms of Service and to our <a href="/privacy-policy/">Privacy Policy</a>. If you do not agree, please do not use the site or request our services through it.</p>

      <h2 id="website-use">2. Use of this website</h2>
      <p>You may use this site for personal, non-commercial purposes: to learn about our services and to contact us. You may not:</p>
      <ul>
        <li>use the site for anything unlawful or to submit false or misleading information through a form;</li>
        <li>try to reach non-public parts of the site or its systems, or interfere with how it works;</li>
        <li>copy or scrape the site&rsquo;s content without our written permission; or</li>
        <li>use automated tools to submit forms or collect data.</li>
      </ul>

      <h2 id="estimates">3. Estimates and quotes</h2>
      <p>An estimate is based on the information you give us and the conditions visible when the work is assessed. The final price can change if the scope changes, if hidden conditions are found behind walls, ceilings or panels, if material prices change between the estimate and the start of work, or if code or inspection requirements differ from what was assumed. A verbal or website-form estimate is not binding. Only a written agreement accepted by both of us fixes the scope and price of a job.</p>

      <h2 id="project-work">4. Project work</h2>
      <ul>
        <li>Each job is governed by the written agreement or work order for that job.</li>
        <li>Work is performed in accordance with the electrical code and permit and inspection requirements that apply to the property in Florida.</li>
        <li>Where a permit or inspection is required, the written agreement for the job states who is responsible for obtaining it.</li>
        <li>You agree to give safe, reasonable access to the property, the panel and the work area, and to tell us about known hazards, such as damaged wiring or unsafe conditions.</li>
        <li>Jordan Electric may use qualified subcontractors where the job calls for it.</li>
      </ul>

      <h2 id="warranties">5. Warranties</h2>
      <p>Any workmanship warranty is stated in your written agreement for the job. Manufacturer warranties on equipment and materials come from the manufacturers and pass to you on completion. Warranties do not cover damage from misuse, neglect, alteration by others, storms or power surges beyond the equipment&rsquo;s rating, or conditions that existed before the work and were disclosed to you.</p>

      <h2 id="payment">6. Payment terms</h2>
      <p>Payment terms, including any deposit, progress payments and the due date of the final balance, are stated in your written agreement. Past-due balances may accrue interest and collection costs to the extent Florida law allows.</p>

      <h2 id="cancellation">7. Cancellation</h2>
      <p>Cancellation terms are stated in your written agreement. In general, if you cancel before we have ordered materials or started work, we will refund any deposit less reasonable administrative costs. If you cancel after materials are ordered or work has begun, you are responsible for the materials ordered and the work completed up to that point.</p>

      <h2 id="safety">8. Safety information on this site</h2>
      <div class="legal-note">
        <p>Guidance on this site, such as lists of warning signs or what to do before an electrician arrives, is general information. It is not a diagnosis of your wiring and not a substitute for an on-site inspection. If you see smoke, flame or sparking, or smell burning, leave the building and call 911. Do not open an electrical panel or touch damaged equipment yourself.</p>
      </div>

      <h2 id="liability">9. Limitation of liability</h2>
      <p>To the fullest extent Florida law permits, the total liability of <?php echo p1_esc($companyName); ?> for any claim connected with this site or our services is limited to the amount you paid for the specific service that gave rise to the claim. We are not liable for indirect, incidental, special or consequential damages. Nothing in these terms limits liability that cannot be limited by law.</p>

      <h2 id="intellectual-property">10. Intellectual property</h2>
      <p>The text, graphics, photographs and logos on this site belong to <?php echo p1_esc($companyName); ?> or are used with permission, and are protected by copyright and trademark law. You may not reproduce, distribute or create derivative works from them without our written permission.</p>

      <h2 id="governing-law">11. Governing law and disputes</h2>
      <p>These terms are governed by the laws of the State of <?php echo p1_esc($companyState); ?>, without regard to conflict-of-law rules. Any dispute is to be brought in the state or federal courts located in <?php echo p1_esc($companyCounty); ?>, <?php echo p1_esc($companyState); ?>, and you consent to those courts&rsquo; jurisdiction.</p>

      <h2 id="changes">12. Changes to these terms</h2>
      <p>We may update these terms at any time. The &ldquo;Last updated&rdquo; date shows the latest version. Using the site after an update means you accept the revised terms. Updates do not change the written agreement for a job already in progress.</p>

      <h2 id="contact">13. Contact us</h2>
      <div class="legal-contact">
        <strong><?php echo p1_esc($companyName); ?></strong>
        <span>Email: <a href="mailto:<?php echo p1_esc($companyEmail); ?>"><?php echo p1_esc($companyEmail); ?></a></span>
        <span>Phone: <a href="tel:<?php echo p1_esc($companyPhoneE164); ?>"><?php echo p1_esc($companyPhone); ?></a></span>
        <span>Mail: <?php echo p1_esc($companyAddress); ?></span>
      </div>

      <p class="legal-updated">Last updated: <?php echo p1_esc($lastUpdated); ?>. See also our <a href="/privacy-policy/">Privacy Policy</a>, <a href="/cookie-policy/">Cookie Policy</a> and <a href="/accessibility/">Accessibility Statement</a>.</p>
    </article>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
