<?php
/**
 * includes/head.php — doctype through <body>. Included first on every page (nothing may print before it:
 * config.php -> attribution.php sets the first-touch cookie).
 *
 * A page sets these BEFORE including this file (all optional except $pageType):
 *   $pageTitle, $metaDescription, $canonicalUrl   defaults: primary keyword + city/state + brand; request path
 *   $pageType      home|service|city|blog|about|faq|contact|other   (lead attribution reads it)
 *   $currentPage   nav highlight: home|services|areas|about|blog|faq|contact
 *   $ogImage       absolute or /root-relative path (omitted when none exists on disk)   $ogType (default website)
 *   $noindex       true on thank-you / utility pages
 *   $heroPreload   ['srcset' => '...avif 480w, ...', 'sizes' => '100vw']   photo heroes only
 *   $schemaBlocks  extra JSON-LD: array of arrays (or ready <script> strings), rendered after the homepage block
 *   $bodyClass     extra body classes
 * Variables in this file are prefixed $head* so they never overwrite a page's own.
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';

$headTitle = $pageTitle ?? p1_default_title();
$headDesc  = $metaDescription ?? p1_default_description();
$headCanon = $canonicalUrl ?? p1_request_canonical();

$headOg = $ogImage ?? '';
if ($headOg === '' && is_file($_SERVER['DOCUMENT_ROOT'] . '/assets/images/og-default.jpg')) $headOg = '/assets/images/og-default.jpg';
if ($headOg !== '' && $headOg[0] === '/') $headOg = rtrim($siteUrl, '/') . $headOg;
$headIsHome = ($pageType ?? '') === 'home';
$headBody = trim(($bodyClass ?? '') . (!empty($textUsNumber) ? ' has-sticky-bar' : '')); // text-us pill sits above the sticky bar
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php echo generateMetaTags($headTitle, $headDesc, $headCanon); ?>

<meta property="og:type" content="<?php echo p1_esc($ogType ?? 'website'); ?>">
<meta property="og:title" content="<?php echo p1_esc($headTitle); ?>">
<meta property="og:description" content="<?php echo p1_esc($headDesc); ?>">
<meta property="og:url" content="<?php echo p1_esc($headCanon); ?>">
<?php if ($headOg !== ''): ?>
<meta property="og:image" content="<?php echo p1_esc($headOg); ?>">
<?php endif; ?>
<meta property="og:site_name" content="<?php echo p1_esc($siteName); ?>">
<meta property="og:locale" content="en_US">

<link rel="icon" type="image/svg+xml" href="/assets/images/favicon.svg">
<link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon-16x16.png">

<link rel="preload" href="/assets/fonts/space-grotesk.woff2" as="font" type="font/woff2" crossorigin>
<style><?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/critical.css'; ?></style>
<link rel="preload" href="/assets/css/framework.css?v=<?php echo urlencode($cssVersion); ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="/assets/css/framework.css?v=<?php echo urlencode($cssVersion); ?>"></noscript>
<?php if (!empty($heroPreload['srcset'])): ?>
<link rel="preload" as="image" type="image/avif" imagesrcset="<?php echo p1_esc($heroPreload['srcset']); ?>" imagesizes="<?php echo p1_esc($heroPreload['sizes'] ?? '100vw'); ?>" fetchpriority="high">
<?php endif; ?>

<!-- Google Analytics 4 — placeholder until the client's measurement ID is set in config.php ($googleAnalyticsId).
<script src="https://www.googletagmanager.com/gtag/js?id=<?php echo p1_esc($googleAnalyticsId); ?>" defer></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','<?php echo p1_esc($googleAnalyticsId); ?>');</script>
-->

<?php
if ($headIsHome) echo p1_schema_script(p1_local_business_schema($headOg));
foreach ((array) ($schemaBlocks ?? []) as $headBlock) echo p1_schema_script($headBlock);
?>
</head>
<body<?php echo $headBody !== '' ? ' class="' . p1_esc($headBody) . '"' : ''; ?>>
