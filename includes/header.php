<?php
/**
 * includes/header.php — skip link, fixed glass header, mobile overlay menu, opens <main id="main-content">.
 * Included right after head.php. Loop variables are prefixed ($navSvc, $navArea, $mmSvc, $mmArea) so they never
 * overwrite a page's own $svc / $area. Area links are gated by p1_area_links() (is_dir) until the page is built.
 */
$navAreas = p1_area_links();
?>
<a href="#main-content" class="skip-link">Skip to main content</a>

<header class="site-header" data-header>
  <nav class="navbar" aria-label="Main navigation">
    <div class="navbar-inner container">
      <?php echo p1_logo_markup('header'); ?>

      <ul class="navbar-links">
        <li><a href="/"<?php echo ariaCurrent('home'); ?>>Home</a></li>
        <li class="has-dropdown">
          <a href="/services/" aria-haspopup="true"<?php echo ariaCurrent('services'); ?>>Services <?php icon('chevron-down', 14); ?></a>
          <ul class="dropdown" style="display:none">
            <?php foreach ($services as $navSvc): ?>
            <li><a href="/services/<?php echo p1_esc($navSvc['slug']); ?>/"<?php echo (($currentService ?? '') === $navSvc['slug']) ? ' aria-current="page"' : ''; ?>><?php echo p1_esc($navSvc['name']); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <li class="has-dropdown">
          <a href="/service-areas/" aria-haspopup="true"<?php echo ariaCurrent('areas'); ?>>Service Areas <?php icon('chevron-down', 14); ?></a>
          <ul class="dropdown" style="display:none">
            <?php foreach ($navAreas as $navArea): ?>
            <li><a href="<?php echo p1_esc($navArea['href']); ?>"><?php echo p1_esc($navArea['name'] . ', ' . $address['state']); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <li><a href="/about/"<?php echo ariaCurrent('about'); ?>>About</a></li>
        <li><a href="/blog/"<?php echo ariaCurrent('blog'); ?>>Blog</a></li>
        <li><a href="/contact/"<?php echo ariaCurrent('contact'); ?>>Contact</a></li>
      </ul>

      <div class="navbar-cta">
        <a class="btn btn-secondary navbar-phone" href="tel:<?php echo p1_esc($phoneE164); ?>" aria-label="Call <?php echo p1_esc($siteName); ?> at <?php echo p1_esc($phone); ?>"><?php icon('phone', 18); ?><span><?php echo p1_esc($phone); ?></span></a>
        <a class="btn btn-primary" href="/contact/" data-open-estimate>Request a Quote</a>
      </div>

      <button class="hamburger" type="button" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-menu">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
      </button>
    </div>
  </nav>
</header>

<?php /* Mobile overlay lives OUTSIDE <header>: the header's backdrop-filter would otherwise become the containing block for position:fixed and shrink the overlay to the bar height. */ ?>
<div class="mobile-menu" id="mobile-menu" aria-hidden="true">
  <div class="mobile-menu-inner">
    <nav aria-label="Mobile navigation">
      <ul class="mobile-menu-links mm-top">
        <li><a href="/"<?php echo ariaCurrent('home'); ?>>Home</a></li>
        <li>
          <a href="/services/"<?php echo ariaCurrent('services'); ?>>Services</a>
          <ul class="mobile-submenu">
            <?php foreach ($services as $mmSvc): ?>
            <li><a href="/services/<?php echo p1_esc($mmSvc['slug']); ?>/"><?php echo p1_esc($mmSvc['name']); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <li>
          <a href="/service-areas/"<?php echo ariaCurrent('areas'); ?>>Service Areas</a>
          <ul class="mobile-submenu">
            <?php foreach ($navAreas as $mmArea): ?>
            <li><a href="<?php echo p1_esc($mmArea['href']); ?>"><?php echo p1_esc($mmArea['name'] . ', ' . $address['state']); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <li><a href="/about/"<?php echo ariaCurrent('about'); ?>>About</a></li>
        <li><a href="/blog/"<?php echo ariaCurrent('blog'); ?>>Blog</a></li>
        <li><a href="/contact/"<?php echo ariaCurrent('contact'); ?>>Contact</a></li>
      </ul>
    </nav>
    <div class="mobile-menu-cta">
      <a class="btn btn-primary btn-lg" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 20); ?>Call <?php echo p1_esc($phone); ?></a>
      <a class="btn btn-outline-white btn-lg" href="/contact/" data-open-estimate>Request a Quote</a>
    </div>
  </div>
</div>

<main id="main-content">
