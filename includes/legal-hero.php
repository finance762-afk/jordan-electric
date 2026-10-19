<?php
/**
 * includes/legal-hero.php — compact dark hero + breadcrumb for the four compliance pages.
 * Set before including:  $legalName (H1 and breadcrumb label)   $legalSub (one line under the H1)   $lastUpdated (display date)
 * No data-animate / reveal classes: legal text must never start hidden.
 */
?>
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
