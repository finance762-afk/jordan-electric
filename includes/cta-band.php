<?php
/**
 * includes/cta-band.php — the ONE mid-page quote band for About and FAQ (v6.3 lead-form placement: those pages never
 * get a hero form). Compact form, fields three-up on desktop, same endpoint, attribution fields and consent as the
 * hero form. Form id is 'cta-band' (unique on the page; the footer dialog is 'dialog').
 * Pair it with includes/cta-band.css inlined into the page's <style>.
 *
 * Set before including (all optional):
 *   $ctaBandEyebrow   eyebrow text            $ctaBandTitle   H2            $ctaBandText   one-paragraph copy
 *   $ctaBandService   service name to preselect
 * Variables are prefixed $cb* so they never overwrite a page's own.
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/p1-form-helpers.php';
$cbEyebrow = $ctaBandEyebrow ?? 'Request a quote';
$cbTitle   = $ctaBandTitle ?? 'Ready to talk through your electrical project?';
$cbText    = $ctaBandText ?? 'Tell Jordan Electric what you need. Every request is reviewed promptly, and we follow up to schedule.';
$cbService = $ctaBandService ?? '';
?>
<section class="cta-band texture-grain" id="estimate" aria-labelledby="cta-band-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container cta-band__grid">
    <div class="cta-band__copy">
      <span class="eyebrow"><?php echo p1_esc($cbEyebrow); ?></span>
      <h2 id="cta-band-title"><?php echo p1_esc($cbTitle); ?></h2>
      <p><?php echo p1_esc($cbText); ?></p>
      <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
    </div>
    <form id="cta-band-form" class="cta-band__card" action="<?php echo p1_esc($formAction); ?>" method="POST">
      <?php echo p1_lead_hidden_fields('cta-band'); ?>
      <div class="cta-band__fields">
        <div><label class="sr-only" for="cb-name">Name</label><input id="cb-name" type="text" name="name" placeholder="Name" autocomplete="name" required></div>
        <div><label class="sr-only" for="cb-phone">Phone</label><input id="cb-phone" type="tel" name="phone" placeholder="Phone" autocomplete="tel" required></div>
        <div><label class="sr-only" for="cb-email">Email</label><input id="cb-email" type="email" name="email" placeholder="Email" autocomplete="email" required></div>
        <div class="cta-band__service"><label class="sr-only" for="cb-service">Service</label><select id="cb-service" name="service"><?php echo p1_service_options($cbService); ?></select></div>
        <button type="submit" class="btn btn-primary">Send my request</button>
      </div>
      <div class="cta-band__consent">
        <?php echo p1_consent_row('cb'); ?>
        <p class="cta-band__note">Consent to calls or texts is optional and never a condition of purchase. Message and data rates may apply. Reply STOP to unsubscribe.</p>
      </div>
    </form>
  </div>
</section>
