<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
?>
<?php
/* ---- Blog post: When to Install a Generator Before Florida Hurricane Season (storm/seasonal launch post) ---------------
 * Keyword source: build-plan seo.secondary_keywords ("generator installation", "emergency electrician").
 * SOURCES: Atlantic season June 1 - November 30, peak mid-August to mid-October (NOAA National Hurricane Center,
 * https://www.nhc.noaa.gov/climo/). Hurricane Idalia, Aug 30 2023: NWS Jacksonville impact narrative - a spotter reported a large
 * tree and power lines blown down about 3 miles NNE of Newberry
 * (https://www.weather.gov/media/jax/TropicalEventSummary/PSHJAX_2023AL10_Idalia_ImpactNarratives.pdf). City of Newberry
 * Building Department page (https://www.newberryfl.gov/1224/Building, fetched 2026-10-19) for permits/inspection scheduling.
 * Portable-generator safety (outdoors, 20 ft from doors/windows, never backfeed through an outlet) is CDC/CPSC general guidance,
 * as already stated on /services/generator-installation/.
 * ACCURACY: no prices, no lead times, no brands, no claim about which fuel or transfer-switch types Jordan Electric installs
 * (all open questions in content-confirmations.json). The only company claims are the client's own: installs backup generator
 * systems for homes and businesses, integrated with the existing electrical setup; license EC 13016035.
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/blog-card.php';
$bpSlug = 'generator-installation-before-hurricane-season';
$bpPost = [];
foreach ($blogPosts as $bpRow) if ($bpRow['slug'] === $bpSlug) $bpPost = $bpRow;

$pageTitle       = $bpPost['title'];
$pageDescription = 'Plan a backup generator in Newberry, FL before hurricane season starts June 1: when to install, what to decide first, and how a safe connection works.';
$metaDescription = $pageDescription;
$canonicalUrl    = $siteUrl . '/blog/' . $bpSlug . '/';
$ogImage         = '';
$ogType          = 'article';
$currentPage     = 'blog';
$pageType        = 'blog';
$bodyClass       = 'svc-page blog-page page-blog-post page-blog-generator';

$bpFaqs = [
    ['q' => 'When is the best time to install a generator in Florida?',
     'a' => 'Spring, before the Atlantic hurricane season opens on June 1. Activity peaks from mid-August to mid-October, and once a storm is in the forecast there is no time to plan, place and connect a system properly.'],
    ['q' => 'Can a generator be plugged into a wall outlet?',
     'a' => 'No. Feeding a house through a wall outlet, called backfeeding, can energize utility lines and injure line workers. A generator should connect through a transfer switch or interlock installed by a licensed electrician.'],
    ['q' => 'Does Jordan Electric install generators for homes and businesses in Newberry?',
     'a' => 'Yes. Jordan Electric installs backup generator systems for homes and businesses in Newberry and across Alachua County, integrated with the existing electrical setup. Call ' . $phone . ' to talk through your property.'],
];

$bpToc = [
    ['bp-when', 'When to install'],
    ['bp-decide', 'What to decide first'],
    ['bp-connect', 'A safe connection'],
    ['bp-permit', 'Permits in Newberry'],
    ['bp-faq', 'Common questions'],
];

$bpAuthor = ['@type' => 'Organization', 'name' => 'Page One Insights LLC', 'url' => 'https://pageoneinsights.com'];
$schemaMarkup = [
    "@context" => "https://schema.org",
    '@graph'   => [
        ['@type' => 'BlogPosting', '@id' => $canonicalUrl . '#post', 'headline' => $bpPost['title'], 'description' => $pageDescription,
         'datePublished' => $bpPost['dateISO'], 'dateModified' => $bpPost['dateISO'], 'inLanguage' => 'en-US',
         'keywords' => 'generator installation, backup generator, hurricane season, emergency electrician, electrician Newberry FL',
         'author' => $bpAuthor, 'publisher' => ['@id' => p1_org_id()], 'mainEntityOfPage' => $canonicalUrl,
         'about' => ['@id' => p1_org_id()], 'isPartOf' => ['@type' => 'Blog', 'name' => $siteName . ' blog', 'url' => $siteUrl . '/blog/']],
        generateBreadcrumbSchema([['Home', rtrim($siteUrl, '/') . '/'], ['Blog', $siteUrl . '/blog/'], [$bpPost['title'], $canonicalUrl]]),
        generateFAQSchema($bpFaqs),
    ],
];
foreach ($schemaMarkup['@graph'] as $bpK => $bpNode) unset($schemaMarkup['@graph'][$bpK]['@context']);
$schemaBlocks = [$schemaMarkup];

/* Season strip (NOAA: June 1 - November 30; peak mid-August to mid-October) */
$bpMonths = [
    ['Mar', ''], ['Apr', 'plan'], ['May', 'plan'], ['Jun', 'season'], ['Jul', 'season'], ['Aug', 'peak'],
    ['Sep', 'peak'], ['Oct', 'peak'], ['Nov', 'season'], ['Dec', ''],
];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<style>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/service-page.css'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/blog-post.css'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/cta-band.css'; ?>

/* Generator post: the season strip is the signature element */
.bpg-months { list-style: none; margin: var(--space-lg) 0 var(--space-xs); padding: 0; display: grid; grid-template-columns: repeat(10, minmax(0, 1fr)); gap: var(--space-1); align-items: end; }
.bpg-month { display: grid; place-items: end center; min-height: 64px; padding: var(--space-xs) 0; border-radius: var(--radius-sm); background: var(--color-paper-2); font-family: var(--font-accent); font-size: var(--fs-eyebrow); letter-spacing: .1em; text-transform: uppercase; color: var(--color-muted); }
.bpg-month--plan { background: var(--color-card-tint-2); color: var(--color-ink); border-top: 4px solid var(--color-secondary); }
.bpg-month--season { background: var(--color-card-tint-3); color: var(--color-ink); border-top: 4px solid var(--color-accent); min-height: 84px; }
.bpg-month--peak { background: var(--color-accent-dark); color: var(--color-white); min-height: 108px; }
.bpg-legend { display: flex; flex-wrap: wrap; gap: var(--space-xs) var(--space-lg); margin: 0 0 var(--space-lg); padding: 0; list-style: none; font-size: var(--fs-small); color: var(--color-ink-2); }
.bpg-legend li { display: inline-flex; align-items: center; gap: var(--space-xs); }
.bpg-legend i { width: 12px; height: 12px; border-radius: var(--radius-sm); display: inline-block; }
.bpg-legend .is-plan { background: var(--color-secondary); } .bpg-legend .is-season { background: var(--color-accent); } .bpg-legend .is-peak { background: var(--color-accent-dark); }
@media (max-width: 600px) { .bpg-months { grid-template-columns: repeat(5, minmax(0, 1fr)); } }
</style>

<!-- ============ 1. POST HEADER ============ -->
<section class="hero hero--interior svc-hero bp-hero" aria-labelledby="svc-hero-title">
  <span class="grain" aria-hidden="true"></span>
  <div class="container">
    <div class="bp-hero__inner">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <ol>
          <li><a href="/">Home</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>
          <li><a href="/blog/">Blog</a></li><li class="breadcrumb-sep" aria-hidden="true">/</li>
          <li><span aria-current="page">Generator before hurricane season</span></li>
        </ol>
      </nav>
      <span class="bp-hero__cat blog-post__category"><?php echo p1_esc($bpPost['category']); ?></span>
      <h1 class="hero-title blog-post__title" id="svc-hero-title"><?php echo p1_esc($bpPost['title']); ?></h1>
      <p class="bp-hero__meta blog-post__meta"><time datetime="<?php echo p1_esc($bpPost['dateISO']); ?>"><?php echo p1_esc($bpPost['date']); ?></time> · <?php echo p1_esc($bpPost['readtime']); ?> · Published by Page One Insights LLC</p>
    </div>
  </div>
</section>

<article class="svc-article" aria-labelledby="svc-hero-title">

<!-- ============ 2. FIRST CONTENT SECTION + TOC SIDEBAR ============ -->
<section class="section" aria-label="Article, part one">
  <div class="container-wide">
    <div class="bp-layout">
      <div class="blog-post__content">
        <div class="answer-block">
          <h3>When should I install a generator in Florida?</h3>
          <p>Install a generator in spring, before hurricane season opens on June 1. The Atlantic season runs through November 30 and peaks from mid-August to mid-October, and once a storm is in the forecast there is no time left to plan, place and connect a system.</p>
        </div>

        <p>For Newberry homeowners the reminder is local. During Hurricane Idalia on August 30, 2023, a National Weather Service spotter reported a large tree and power lines blown down about three miles north-northeast of Newberry. Storms that never make landfall here still knock lines down, and summer thunderstorms do the same from June through September.</p>

        <h2 id="bp-when">When is the right time to plan a backup generator?</h2>
        <p>Plan in April and May, so the system is in place when the season opens. A generator is an electrical project with parts to choose, a pad or location to prepare and a connection to the building's wiring, and none of that goes well on a storm-forecast deadline.</p>
        <ol class="bpg-months" aria-label="Atlantic hurricane season by month, March to December">
          <?php foreach ($bpMonths as $bpMo): ?>
          <li class="bpg-month<?php echo $bpMo[1] !== '' ? ' bpg-month--' . $bpMo[1] : ''; ?>"><?php echo p1_esc($bpMo[0]); ?><?php if ($bpMo[1] !== ''): ?><span class="sr-only"> (<?php echo $bpMo[1] === 'plan' ? 'best time to plan' : ($bpMo[1] === 'peak' ? 'peak of season' : 'hurricane season'); ?>)</span><?php endif; ?></li>
          <?php endforeach; ?>
        </ol>
        <ul class="bpg-legend" aria-hidden="true">
          <li><i class="is-plan"></i>Plan and install</li>
          <li><i class="is-season"></i>Hurricane season</li>
          <li><i class="is-peak"></i>Peak activity</li>
        </ul>
        <p>Season dates and the peak window come from the <a href="https://www.nhc.noaa.gov/climo/" target="_blank" rel="noopener">National Hurricane Center</a>. If it is already autumn, do not wait for next spring to start: a site visit and a quote can happen any month.</p>

        <h2 id="bp-decide">What should I decide before asking for a generator quote?</h2>
        <p>Decide what has to keep running, because everything else is sized around that list. Write it down before you call <a href="/services/generator-installation/">Jordan Electric about generator installation</a>:</p>
        <ul>
          <li><b>The essentials.</b> A refrigerator and freezer, lights, the internet router and phone chargers are a short list. Air conditioning, an electric water heater and a well pump make it a much bigger one.</li>
          <li><b>Who depends on power.</b> Powered medical equipment moves backup power from convenience to necessity.</li>
          <li><b>Home or business.</b> A shop with coolers, card readers or a security system has different priorities than a house. Jordan Electric installs backup systems for both.</li>
          <li><b>The panel.</b> A generator connects through the electrical panel. If yours is crowded, damaged or out of space, that comes first; the <a href="/blog/electrical-panel-upgrade-cost-newberry-fl/">panel upgrade cost guide</a> covers what to expect.</li>
        </ul>
      </div>

      <aside class="bp-aside" aria-label="Article tools">
        <nav class="bp-toc" aria-label="In this article">
          <b>In this article</b>
          <ol>
            <?php foreach ($bpToc as $bpT): ?><li><a href="#<?php echo p1_esc($bpT[0]); ?>"><?php echo p1_esc($bpT[1]); ?></a></li><?php endforeach; ?>
          </ol>
        </nav>
        <div class="bp-side-cta">
          <b>Talk to Jordan Electric</b>
          <p>Florida license <?php echo p1_esc($licenseNumber); ?>. Based in Newberry, serving <?php echo p1_esc($primaryCounty); ?>.</p>
          <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?><?php echo p1_esc($phone); ?></a>
          <button type="button" class="btn btn-primary" data-open-estimate>Request a quote</button>
        </div>
      </aside>
    </div>
  </div>
</section>

<!-- ============ 3. MID-PAGE QUOTE BAND (the one lead form on a post) ============ -->
<?php
$ctaBandEyebrow = 'Generator quote';
$ctaBandTitle   = 'Planning backup power for next season?';
$ctaBandText    = 'Tell Jordan Electric what has to stay on at your home or business. We follow up to look at the property and plan the system.';
$ctaBandService = 'Generator Installation';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/cta-band.php';
?>

<!-- ============ 4. REST OF THE ARTICLE + RELATED SERVICES SIDEBAR ============ -->
<section class="section" aria-label="Article, part two">
  <div class="container-wide">
    <div class="bp-layout">
      <div class="blog-post__content">
        <h2 id="bp-type">Which generator type fits a Newberry property?</h2>
        <p>The right generator type depends on what you need to keep running and for how long, not on a brand. A portable unit suits a short list of circuits and an owner who is home to start it. A standby unit suits a whole-house or business load and starts without anyone present. Either must be sized to the load you listed.</p>
        <p>Rural properties on acreage around Newberry add one more question: how far the generator sits from the building it feeds, and whether a detached shop or barn needs its own connection. Raise it during the site visit so the quote covers the full run.</p>

        <h2 id="bp-connect">What does a safe generator connection look like?</h2>
        <p>A safe connection keeps generator power out of the utility lines. A portable generator should feed the house only through a transfer switch or interlock installed for that purpose, never through a wall outlet, because backfeeding can energize lines that utility workers believe are dead. A standby generator is hard-wired through a transfer switch and starts on its own.</p>
        <p>Placement matters as much as wiring. The CDC advises running portable generators outdoors, at least 20 feet from doors and windows, because the exhaust contains carbon monoxide. The <a href="/services/generator-installation/">generator installation page</a> has a side-by-side comparison of portable and standby systems.</p>
        <div class="bp-callout"><p>Jordan Electric ties each generator into the existing electrical system as part of the installation. If a storm has already damaged your wiring, <a href="/services/electrical-repairs/">electrical repairs</a> come before backup power.</p></div>

        <h2 id="bp-permit">Does a generator installation need a permit in Newberry?</h2>
        <p>Plan on it and confirm with the city. The City of Newberry Building Department enforces the Florida Building Code and the National Electric Code, takes permit applications through its SmartGov portal and asks for inspections to be scheduled 24 hours ahead. Call 352-472-3927 or read the <a href="https://www.newberryfl.gov/1224/Building" target="_blank" rel="noopener">department's page</a> for current rules, and ask your electrician who handles the permit and inspection and put the answer in the quote.</p>
        <p>Also look at your power bill: the City of Newberry runs its own electric utility, and Clay Electric Cooperative serves other parts of the area, so the provider tells you who to ask about utility-side requirements.</p>

        <section class="bp-faq" aria-labelledby="bp-faq">
          <h2 id="bp-faq">What do Newberry homeowners ask about generators?</h2>
          <p>Newberry homeowners ask about the best timing, how a generator connects safely and who installs backup generators locally. The three answers below summarize the guide above for quick reference before you call.</p>
          <div class="faq-grid">
            <?php foreach ($bpFaqs as $bpFi => $bpFaq): ?>
            <details class="faq"<?php echo $bpFi === 0 ? ' open' : ''; ?>>
              <summary><?php echo p1_esc($bpFaq['q']); ?></summary>
              <p class="faq-answer"><?php echo p1_esc($bpFaq['a']); ?></p>
            </details>
            <?php endforeach; ?>
          </div>
        </section>

        <div class="bp-sources">
          <b>Sources</b>
          <ul>
            <li><a href="https://www.nhc.noaa.gov/climo/" target="_blank" rel="noopener">NOAA National Hurricane Center</a>, Atlantic hurricane climatology.</li>
            <li><a href="https://www.weather.gov/media/jax/TropicalEventSummary/PSHJAX_2023AL10_Idalia_ImpactNarratives.pdf" target="_blank" rel="noopener">National Weather Service Jacksonville</a>, Hurricane Idalia impact narratives (August 30, 2023).</li>
            <li><a href="https://www.newberryfl.gov/1224/Building" target="_blank" rel="noopener">City of Newberry Building Department</a>, read October 2026.</li>
          </ul>
        </div>
        <p class="bp-byline">Published by Page One Insights LLC on behalf of Jordan Electric. This article is general information, not a quote or a substitute for a licensed electrician's site visit.</p>
      </div>

      <aside class="bp-aside" aria-label="Related services">
        <div class="bp-side-links">
          <b>Related services</b>
          <ul>
            <li><a href="/services/generator-installation/">Generator installation</a></li>
            <li><a href="/services/residential-electrical/">Residential electrical services</a></li>
            <li><a href="/services/commercial-electrical/">Commercial electrical services</a></li>
            <li><a href="/service-areas/newberry/">Electrician in Newberry, FL</a></li>
            <li><a href="/contact/">Contact Jordan Electric</a></li>
          </ul>
        </div>
        <div class="bp-side-cta">
          <b>Call for a quote</b>
          <p>Jordan Electric is based in Newberry and serves <?php echo p1_esc($primaryCounty); ?>.</p>
          <a class="link-call" href="tel:<?php echo p1_esc($phoneE164); ?>"><?php icon('phone', 18); ?><?php echo p1_esc($phone); ?></a>
        </div>
      </aside>
    </div>
  </div>
</section>

</article>

<!-- ============ 5. RELATED ARTICLES + SERVICES ============ -->
<?php $bpRelated = p1_blog_related($bpSlug, 3); ?>
<section class="section bp-related blog-post__related-articles edge-wave-top" aria-labelledby="bp-related-title">
  <div class="container-wide">
    <div class="section-head reveal-up">
      <span class="eyebrow">Keep reading</span>
      <h2 id="bp-related-title">What else should Newberry property owners read?</h2>
      <p>Newberry property owners planning electrical work can keep reading with the related guides below, or open the Jordan Electric service pages that match the job they have in mind.</p>
    </div>
    <div class="blog-grid">
      <?php foreach ($bpRelated as $bpRi => $bpRel): echo p1_blog_card($bpRel, false, 'reveal-up'); endforeach; ?>
    </div>
    <ul class="bp-related__services">
      <?php foreach ($services as $bpSvc): ?>
      <li><a href="/services/<?php echo p1_esc($bpSvc['slug']); ?>/"><?php echo p1_esc($bpSvc['name']); ?> <?php icon('arrow-right', 16); ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
