<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Page setup: Blog index (/blog/) --------------------------------------------------------------------------
 * Registry-driven: every card comes from $blogPosts (includes/blog-data.php) through p1_blog_card(). Never a placeholder.
 * No lead form here (blog INDEX is not a post); the closing CTA band links to the quote dialog.
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/blog-card.php';
$pageTitle       = 'Electrician Blog: Newberry, FL Guides | Jordan Electric';
$pageDescription = 'Plain-language electrical guides from Jordan Electric in Newberry, FL: panel upgrade costs, generator planning for hurricane season, permits and more. Read now.';
$metaDescription = $pageDescription;
$canonicalUrl    = $siteUrl . '/blog/';
$ogImage         = '';
$currentPage     = 'blog';
$pageType        = 'blog';
$bodyClass       = 'svc-page blog-page page-blog-index';

$blogFeatured = $blogPosts[0] ?? null;
$blogRest     = array_slice($blogPosts, 1);
$blogCats     = array_values(array_unique(array_column($blogPosts, 'category')));

$blogItems = [];
foreach ($blogPosts as $blogPos => $blogP) {
    $blogItems[] = ['@type' => 'ListItem', 'position' => $blogPos + 1, 'name' => $blogP['title'], 'url' => $siteUrl . '/blog/' . $blogP['slug'] . '/'];
}
$schemaMarkup = [
    "@context" => "https://schema.org",
    '@graph'   => [
        ['@type' => 'CollectionPage', '@id' => $canonicalUrl . '#webpage', 'url' => $canonicalUrl, 'name' => $pageTitle,
         'description' => $pageDescription, 'about' => ['@id' => p1_org_id()], 'mainEntity' => ['@id' => $canonicalUrl . '#posts'],
         'isPartOf' => ['@type' => 'WebSite', 'name' => $siteName, 'url' => rtrim($siteUrl, '/') . '/']],
        ['@type' => 'ItemList', '@id' => $canonicalUrl . '#posts', 'name' => 'Jordan Electric blog articles', 'itemListElement' => $blogItems],
        ['@type' => 'BreadcrumbList', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => rtrim($siteUrl, '/') . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => $canonicalUrl],
        ]],
    ],
];
$schemaBlocks = [$schemaMarkup];   // head.php renders $schemaBlocks
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/blog-post.css'; ?>

/* ==========================================================================
   Blog index — page-specific composition (.bl-)
   Signature: a featured article as a wide split card above the registry grid, with a category rail.
   ========================================================================== */
.bl-hero .hero-copy { max-width: 44rem; }
.bl-cats { list-style: none; margin: var(--space-md) 0 0; padding: 0; display: flex; flex-wrap: wrap; gap: var(--space-xs); }
.bl-cats li { padding: .3rem .85rem; border-radius: 999px; border: 1px solid color-mix(in srgb, var(--color-white) 24%, transparent); background: color-mix(in srgb, var(--color-white) 8%, transparent); color: var(--color-white); font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .14em; text-transform: uppercase; }
.bl-feature { background: var(--color-paper); }
.bl-feature .blog-card--featured { box-shadow: var(--shadow-lg); border-top: 4px solid var(--color-accent); }
.bl-grid-section { background: var(--color-surface); }
.bl-grid-section .section-head { margin-bottom: var(--space-xl); }
.bl-note { margin-top: var(--space-xl); padding: var(--space-md) var(--space-lg); border-inline-start: 3px solid var(--color-secondary); background: var(--color-paper-2); border-radius: 0 var(--radius) var(--radius) 0; font-size: var(--fs-small); color: var(--color-ink-2); max-width: 70ch; }
.bl-note a { color: var(--color-accent-dark); }
</style>

<!-- ============ 1. HERO (interior, type-led) ============ -->
<section class="hero hero--interior svc-hero bl-hero" aria-labelledby="svc-hero-title">
  <span class="grain" aria-hidden="true"></span>
  <div class="container">
    <div class="hero-copy">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <ol>
          <li><a href="/">Home</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>
          <li><span aria-current="page">Blog</span></li>
        </ol>
      </nav>
      <span class="eyebrow">The Jordan Electric blog</span>
      <h1 class="hero-title" id="svc-hero-title">Electrical guides for <span class="text-accent">Newberry, FL</span> homes and businesses</h1>
      <p class="hero-answer">Plain-language answers on panel upgrade costs, storm-season generators, permits and the other questions Alachua County property owners ask before hiring an electrician.</p>
      <ul class="bl-cats" aria-label="Article categories">
        <?php foreach ($blogCats as $blogCat): ?><li><?php echo p1_esc($blogCat); ?></li><?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<!-- ============ 2. FEATURED ARTICLE ============ -->
<?php if ($blogFeatured): ?>
<section class="section bl-feature" aria-labelledby="bl-feature-title">
  <div class="container-wide">
    <div class="section-head reveal-up">
      <span class="eyebrow">Latest article</span>
      <h2 id="bl-feature-title" class="sr-only">Latest article from Jordan Electric</h2>
    </div>
    <?php echo p1_blog_card($blogFeatured, true, 'reveal-scale'); ?>
  </div>
</section>
<?php endif; ?>

<!-- ============ 3. ALL ARTICLES (registry grid) ============ -->
<section class="section bl-grid-section edge-torn-top" aria-labelledby="bl-all-title">
  <div class="container-wide">
    <div class="section-head reveal-up">
      <span class="eyebrow">All articles</span>
      <h2 id="bl-all-title">What can I learn from the Jordan Electric blog?</h2>
      <p class="answer-block">The Jordan Electric blog answers practical questions for Newberry and Alachua County property owners: what an electrical project costs, when to plan it, and how the City of Newberry's permit process works. Every article links to the matching service page.</p>
    </div>
    <div class="blog-grid">
      <?php foreach ($blogPosts as $blogI => $blogPost): ?>
      <?php echo p1_blog_card($blogPost, false, ['reveal-up', 'reveal-left', 'reveal-right'][$blogI % 3] . ' reveal-delay-' . (($blogI % 3) + 1)); ?>
      <?php endforeach; ?>
    </div>
    <p class="bl-note">New guides are added as property owners ask new questions. Need an answer sooner? <a href="tel:<?php echo p1_esc($phoneE164); ?>">Call <?php echo p1_esc($phone); ?></a> or browse the <a href="/services/">electrical services</a> pages.</p>
  </div>
</section>

<!-- ============ 4. FINAL CTA ============ -->
<section class="cta-banner texture-grain edge-curve-top svc-final" aria-labelledby="bl-final-title">
  <span class="grain-layer" aria-hidden="true"></span>
  <div class="container reveal-up">
    <div>
      <span class="eyebrow">Newberry electrician</span>
      <h2 id="bl-final-title">Have a project in Newberry or Alachua County?</h2>
      <p>Tell Jordan Electric what you are planning, and we will follow up to look at the job and schedule it.</p>
    </div>
    <div class="actions">
      <button type="button" class="btn btn-primary btn-lg" data-open-estimate>Request a quote</button>
      <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?>or call <?php echo p1_esc($phone); ?></a>
    </div>
  </div>
  <svg class="svc-final__mark" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/></svg>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
