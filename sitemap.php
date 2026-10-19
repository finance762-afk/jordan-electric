<?php
/**
 * sitemap.php — dynamic sitemap, served at /sitemap.xml by the .htaccess rewrite. Never hand-edit URL lists into this file:
 * static pages are the registry below, services come from config.php $services, areas from $areaPages (only once the page
 * exists on disk), blog posts from includes/blog-data.php $blogPosts (lastmod = dateISO).
 * URLs are the trailing-slash directory form and match each page's canonical exactly. /thank-you is noindex and excluded.
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/blog-data.php';

$smBase = rtrim($siteUrl, '/');
$smRoot = $_SERVER['DOCUMENT_ROOT'];
$smLastmod = function (string $file) use ($smRoot): string {
    $t = @filemtime($smRoot . $file);
    return date('Y-m-d', $t ?: time());
};

$smUrls = [];
$smAdd = function (string $path, string $file, string $freq, string $prio, ?string $lastmod = null) use (&$smUrls, $smLastmod): void {
    $smUrls[] = ['path' => $path, 'lastmod' => $lastmod ?? $smLastmod($file), 'freq' => $freq, 'prio' => $prio];
};

$smAdd('/', '/index.php', 'weekly', '1.0');
$smAdd('/services/', '/services/index.php', 'monthly', '0.9');
foreach ($services as $smSvc) {
    $smAdd('/services/' . $smSvc['slug'] . '/', '/services/' . $smSvc['slug'] . '/index.php', 'monthly', '0.9');
}
$smAdd('/service-areas/', '/service-areas/index.php', 'monthly', '0.8');
foreach ($areaPages as $smArea) {
    if (is_file($smRoot . '/service-areas/' . $smArea['slug'] . '/index.php')) {
        $smAdd('/service-areas/' . $smArea['slug'] . '/', '/service-areas/' . $smArea['slug'] . '/index.php', 'monthly', '0.8');
    }
}
$smAdd('/about/', '/about/index.php', 'monthly', '0.7');
$smAdd('/faq/', '/faq/index.php', 'monthly', '0.7');
$smAdd('/contact/', '/contact/index.php', 'yearly', '0.7');
$smAdd('/blog/', '/blog/index.php', 'weekly', '0.7', !empty($blogPosts) ? max(array_column($blogPosts, 'dateISO')) : null);
foreach ($blogPosts as $smPost) {
    $smAdd('/blog/' . $smPost['slug'] . '/', '/blog/' . $smPost['slug'] . '/index.php', 'monthly', '0.6', $smPost['dateISO']);
}
foreach (['privacy-policy', 'terms', 'cookie-policy', 'accessibility'] as $smLegal) {
    $smAdd('/' . $smLegal . '/', '/' . $smLegal . '/index.php', 'yearly', '0.3');
}

header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
<?php foreach ($smUrls as $smU): ?>
  <url>
    <loc><?php echo htmlspecialchars($smBase . $smU['path'], ENT_XML1); ?></loc>
    <lastmod><?php echo $smU['lastmod']; ?></lastmod>
    <changefreq><?php echo $smU['freq']; ?></changefreq>
    <priority><?php echo $smU['prio']; ?></priority>
  </url>
<?php endforeach; ?>
</urlset>
