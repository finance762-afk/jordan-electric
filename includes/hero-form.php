<?php
/**
 * includes/hero-form.php — the compact hero lead form card for service and city pages (v6.3 placement).
 * Same card as the homepage hero, plus the email field the leads endpoint requires.
 *
 * Set before including (all optional):
 *   $heroFormService  service name to preselect in the dropdown (a $services[]['name'])
 *   $heroFormTitle    card heading (default "Request a quote")
 *   $heroFormTagline  one line under the heading
 * Form id is always 'hero' (unique on the page; the footer dialog is 'dialog').
 * Variables are prefixed $hf* so they never overwrite a page's own.
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php'; // p1_service_options()
$hfService = $heroFormService ?? '';
$hfTitle   = $heroFormTitle ?? 'Request a quote';
$hfTagline = $heroFormTagline ?? 'Tell us about the job. Every request is reviewed promptly.';
?>
<aside class="hero-form-card" id="estimate-form" aria-labelledby="hero-form-title">
  <p class="hero-form-card__title" id="hero-form-title"><?php echo p1_esc($hfTitle); ?></p>
  <p class="hero-form-tagline"><?php echo p1_esc($hfTagline); ?></p>
  <form id="hero" action="<?php echo p1_esc($formAction); ?>" method="POST" class="hero-form">
    <input type="hidden" name="_next" value="<?php echo p1_esc(rtrim($siteUrl, '/')); ?>/thank-you">
    <input type="text" name="_honey" style="display:none !important" tabindex="-1" autocomplete="off" aria-hidden="true">
    <input type="hidden" name="form_location" value="hero">
    <input type="hidden" name="consent_version" value="v2.1">
    <input type="hidden" name="consent_page" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'] ?? '/'); ?>">
    <?php echo p1_attribution_fields('hero'); ?>
    <div class="form-row"><label class="sr-only" for="hero-name">Name</label><input id="hero-name" type="text" name="name" placeholder="Name" autocomplete="name" required></div>
    <div class="form-row hf-pair">
      <div><label class="sr-only" for="hero-phone">Phone</label><input id="hero-phone" type="tel" name="phone" placeholder="Phone" autocomplete="tel" required></div>
      <div><label class="sr-only" for="hero-email">Email</label><input id="hero-email" type="email" name="email" placeholder="Email" autocomplete="email" required></div>
    </div>
    <div class="form-row"><label class="sr-only" for="hero-service">Service</label>
      <select id="hero-service" name="service"><?php echo p1_service_options($hfService); ?></select>
    </div>
    <label class="consent" for="hero-terms"><input id="hero-terms" type="checkbox" name="terms_accepted" value="yes" required><span>I agree to the <a href="/terms/" target="_blank" rel="noopener">Terms</a> and <a href="/privacy-policy/" target="_blank" rel="noopener">Privacy Policy</a> and consent to be contacted about my request. *</span></label>
    <button type="submit" class="btn btn-primary btn-block">Send my request</button>
  </form>
</aside>
