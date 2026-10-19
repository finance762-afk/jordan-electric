<?php
/**
 * includes/footer.php — closes <main>, site footer, mobile bars, cookie bar, scripts, </body></html>.
 * Loop variables are prefixed ($footSvc, $footArea, $footHour). Anything config.php leaves empty (hours, socials,
 * text-us number, GBP) is simply not rendered. Page One Partner badge is included once, last, inside <footer>.
 */
$footAreas = p1_area_links();
$footOrgId = p1_org_id();
$footSvcNames = array_map('strtolower', array_column($services, 'name')); // entity sentence lists the services in running text
?>
</main>

<footer class="site-footer">
  <div class="footer-top">
    <div class="container">
      <div class="footer-grid">

        <div class="footer-brand">
          <?php echo p1_logo_markup('footer'); ?>
          <p>Residential and commercial electrical work, generator installation, and service calls in <?php echo p1_esc($address['city']); ?> and across <?php echo p1_esc($primaryCounty); ?>.</p>
          <div class="footer-badges">
            <span><?php echo p1_esc($address['city'] . ', ' . $address['state']); ?></span>
            <span><?php echo p1_esc($primaryCounty); ?></span>
            <span>Residential + Commercial</span>
          </div>
        </div>

        <div class="footer-col">
          <h4>Services</h4>
          <ul>
            <?php foreach ($services as $footSvc): ?>
            <li><a href="/services/<?php echo p1_esc($footSvc['slug']); ?>/"><?php echo p1_esc($footSvc['name']); ?></a></li>
            <?php endforeach; ?>
          </ul>
          <a class="footer-more" href="/services/">All services <?php icon('arrow-right', 16); ?></a>
        </div>

        <div class="footer-col">
          <h4>Service Areas</h4>
          <ul>
            <?php foreach ($footAreas as $footArea): ?>
            <li><a href="<?php echo p1_esc($footArea['href']); ?>"><?php echo p1_esc($footArea['name'] . ', ' . $address['state']); ?></a></li>
            <?php endforeach; ?>
          </ul>
          <a class="footer-more" href="/service-areas/">View all areas <?php icon('arrow-right', 16); ?></a>
          <h4 class="footer-subhead">Company</h4>
          <ul>
            <li><a href="/about/">About</a></li>
            <li><a href="/faq/">FAQ</a></li>
            <li><a href="/blog/">Blog</a></li>
            <li><a href="/contact/">Contact</a></li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>Contact</h4>
          <ul class="footer-contact">
            <li><?php icon('phone', 18); ?><a href="tel:<?php echo p1_esc($phoneE164); ?>"><?php echo p1_esc($phone); ?></a></li>
            <li><?php icon('mail', 18); ?><a href="mailto:<?php echo p1_esc($email); ?>"><?php echo p1_esc($email); ?></a></li>
            <li><?php icon('map-pin', 18); ?><span><?php echo !empty($addressIsPoBox) ? 'Mailing address: ' : ''; echo p1_esc($address['street'] . ', ' . $address['city'] . ', ' . $address['state'] . ' ' . $address['zip']); ?></span></li>
            <?php if (!empty($hours) && is_array($hours)): ?>
            <li><?php icon('clock', 18); ?><span><?php foreach ($hours as $footHour) { echo p1_esc($footHour) . '<br>'; } ?></span></li>
            <?php endif; ?>
          </ul>
          <a class="btn footer-cta" href="/contact/" data-open-estimate>Request a Quote</a>
        </div>

      </div>

      <div class="footer-entity" itemscope itemtype="https://schema.org/Electrician" itemid="<?php echo p1_esc($footOrgId); ?>">
        <meta itemprop="name" content="<?php echo p1_esc($siteName); ?>">
        <meta itemprop="url" content="<?php echo p1_esc(rtrim($siteUrl, '/') . '/'); ?>">
        <meta itemprop="telephone" content="<?php echo p1_esc($phoneE164); ?>">
        <p>
          <?php echo p1_esc($siteName); ?> is an electrician based in
          <span itemprop="address" itemscope itemtype="https://schema.org/PostalAddress"><span itemprop="addressLocality"><?php echo p1_esc($address['city']); ?></span>, <span itemprop="addressRegion"><?php echo p1_esc($address['state']); ?></span> <span itemprop="postalCode"><?php echo p1_esc($address['zip']); ?></span></span>,
          serving <?php echo p1_esc($primaryCounty); ?> with
          <?php echo p1_esc(implode(', ', array_slice($footSvcNames, 0, -1)) . ', and ' . end($footSvcNames)); ?>.
          Call <a href="tel:<?php echo p1_esc($phoneE164); ?>"><?php echo p1_esc($phone); ?></a> to talk through your project.
        </p>
      </div>
    </div>
  </div>

  <div class="footer-bottom-bar">
    <div class="container footer-bottom-inner">
      <nav class="footer-legal-row footer-legal-links" aria-label="Legal">
        <a href="/privacy-policy/">Privacy Policy</a>
        <span class="divider footer-legal-divider" aria-hidden="true">|</span>
        <a href="/terms/">Terms of Service</a>
        <span class="divider footer-legal-divider" aria-hidden="true">|</span>
        <a href="/cookie-policy/">Cookie Policy</a>
        <span class="divider footer-legal-divider" aria-hidden="true">|</span>
        <a href="/accessibility/">Accessibility</a>
        <span class="divider footer-legal-divider" aria-hidden="true">|</span>
        <a href="/privacy-policy/#ccpa-rights">Do Not Sell or Share My Personal Information</a>
        <span class="divider footer-legal-divider" aria-hidden="true">|</span>
        <a href="/sitemap.xml">Sitemap</a>
      </nav>
      <div class="footer-copyright-row">
        <p>&copy; <?php echo date('Y'); ?> <?php echo p1_esc($siteName); ?>. All rights reserved.</p>
        <p class="footer-credit"><a href="https://pageoneinsights.com" rel="dofollow" target="_blank">Web Design & Hosting by Page One Insights, LLC</a></p>
      </div>
    </div>
  </div>
  <?php include __DIR__ . '/partner-badge.php'; ?>
</footer>

<button class="back-to-top" type="button" aria-label="Back to top"><?php icon('chevron-down', 22); ?></button>

<dialog class="estimate-dialog" id="estimate-dialog" aria-labelledby="estimate-dialog-title">
  <div class="dialog-head">
    <div>
      <h3 id="estimate-dialog-title">Request a quote</h3>
      <p class="footnote">Every request is reviewed promptly, and we follow up to schedule.</p>
    </div>
    <button type="button" class="dialog-close" aria-label="Close" data-close-estimate><?php icon('x', 20); ?></button>
  </div>
  <div class="dialog-body">
    <form id="dialog" action="<?php echo p1_esc($formAction); ?>" method="POST" class="estimate-form">
      <input type="text" name="_honey" style="display:none !important" tabindex="-1" autocomplete="off" aria-hidden="true">
      <input type="hidden" name="_next" value="<?php echo p1_esc(rtrim($siteUrl, '/')); ?>/thank-you">
      <input type="hidden" name="form_location" value="dialog">
      <?php echo p1_attribution_fields('dialog'); ?>
      <input type="hidden" name="consent_version" value="v2.1">
      <input type="hidden" name="consent_page" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'] ?? '/'); ?>">
      <div class="form-grid">
        <div class="field"><label for="dlg-name">Your name *</label><input id="dlg-name" type="text" name="name" autocomplete="name" required></div>
        <div class="field"><label for="dlg-phone">Phone *</label><input id="dlg-phone" type="tel" name="phone" autocomplete="tel" required></div>
        <div class="field full"><label for="dlg-email">Email *</label><input id="dlg-email" type="email" name="email" autocomplete="email" required></div>
        <div class="field full"><label for="dlg-service">Service needed</label>
          <select id="dlg-service" name="service">
            <option value="">Select a service</option>
            <?php foreach ($services as $dlgSvc): ?>
            <option value="<?php echo p1_esc($dlgSvc['name']); ?>"><?php echo p1_esc($dlgSvc['name']); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="field full"><label for="dlg-message">About the job</label><textarea id="dlg-message" name="message" rows="3"></textarea></div>
      </div>
      <fieldset class="form-consent-fieldset">
        <legend class="form-consent-legend">Communication consent</legend>
        <label class="form-consent-item" for="dlg-email-opt">
          <input id="dlg-email-opt" type="checkbox" name="email_opt_in" value="yes" class="consent-checkbox">
          <span class="consent-label"><strong>Email updates (optional):</strong> I agree to receive emails from <?php echo p1_esc($siteName); ?> about my inquiry, services, promotions, and news. I understand I can unsubscribe anytime via the link in any email or by emailing <?php echo p1_esc($contactEmail); ?>. Message frequency varies.</span>
        </label>
        <label class="form-consent-item" for="dlg-sms-opt">
          <input id="dlg-sms-opt" type="checkbox" name="sms_opt_in" value="yes" class="consent-checkbox">
          <span class="consent-label"><strong>SMS/Text messages (optional):</strong> I agree to receive text messages from <?php echo p1_esc($siteName); ?> at the phone number I provided. Message types may include appointment reminders, service updates, and promotional offers. Message frequency varies. Message and data rates may apply. Reply STOP to unsubscribe, HELP for help. <strong>Consent is not a condition of purchase.</strong></span>
        </label>
        <label class="form-consent-item form-consent-required" for="dlg-terms">
          <input id="dlg-terms" type="checkbox" name="terms_accepted" value="yes" class="consent-checkbox" required>
          <span class="consent-label">I have read and agree to the <a href="/privacy-policy/">Privacy Policy</a> and <a href="/terms/">Terms of Service</a>. <span class="required-star">*</span></span>
        </label>
      </fieldset>
      <button type="submit" class="btn btn-primary btn-block">Send my request</button>
    </form>
  </div>
</dialog>

<div class="mobile-cta-bar" role="region" aria-label="Quick contact">
  <a class="mobile-cta-bar__call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>Call Now</a>
  <a class="mobile-cta-bar__estimate" href="/contact/" data-open-estimate>Request a Quote</a>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/text-us.php'; echo p1_text_us(); ?>

<div class="cookie-banner" id="cookie-banner" role="region" aria-label="Cookie notice">
  <p class="cookie-banner__text">We use cookies to improve your experience and analyze site usage. By continuing, you agree to our use of cookies. <a href="/cookie-policy/">Learn more</a>.</p>
  <button type="button" class="cookie-banner__dismiss" id="cookie-banner-dismiss" aria-label="Dismiss cookie notice">Got it</button>
</div>

<script src="/assets/js/main.js?v=<?php echo urlencode($cssVersion); ?>" defer></script>
<script src="/assets/js/animations.js?v=<?php echo urlencode($cssVersion); ?>" defer></script>
<script src="/assets/js/effects.js?v=<?php echo urlencode($cssVersion); ?>" defer></script>
</body>
</html>
