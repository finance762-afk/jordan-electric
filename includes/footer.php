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
