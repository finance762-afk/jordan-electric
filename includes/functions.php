<?php
/**
 * includes/functions.php — shared helpers for Jordan Electric. Loaded by head.php (require_once).
 * Everything reads config.php globals; nothing here carries a business fact of its own.
 * Local variables are prefixed or function-scoped so they can never collide with a page's variables.
 */

if (!function_exists('p1_esc')) {
    function p1_esc($v): string { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); }
}

/* ---- Icons: inline SVG from references/lucide-icons (v6.2 — no runtime injection) -------------- */
if (!function_exists('p1_icon')) {
    /** Returns the raw <svg> with aria-hidden + width/height set. Unknown name -> empty string. */
    function p1_icon(string $name, int $size = 20, string $class = ''): string {
        static $cache = [];
        $key = $name . '|' . $size . '|' . $class;
        if (isset($cache[$key])) return $cache[$key];
        $file = $_SERVER['DOCUMENT_ROOT'] . '/references/lucide-icons/' . preg_replace('/[^a-z0-9-]/', '', $name) . '.svg';
        if (!is_file($file)) return $cache[$key] = '';
        $svg = (string) file_get_contents($file);
        $svg = preg_replace('/<!--.*?-->/s', '', $svg);
        $svg = trim(preg_replace('/\s+/', ' ', $svg));
        $svg = preg_replace('/>\s+</', '><', $svg);
        $svg = preg_replace('/\sclass="[^"]*"/', ' class="icon icon-' . $name . ($class !== '' ? ' ' . p1_esc($class) : '') . '" aria-hidden="true" focusable="false"', $svg, 1);
        $svg = preg_replace('/\swidth="\d+"/', ' width="' . $size . '"', $svg, 1);
        $svg = preg_replace('/\sheight="\d+"/', ' height="' . $size . '"', $svg, 1);
        return $cache[$key] = $svg;
    }
}
if (!function_exists('icon')) {
    function icon(string $name, int $size = 20, string $class = ''): void { echo p1_icon($name, $size, $class); }
}

/* ---- Navigation state --------------------------------------------------------------------------- */
function isActivePage($page): bool {
    global $currentPage;
    if (!isset($currentPage)) return false;
    return is_array($page) ? in_array($currentPage, $page, true) : $currentPage === $page;
}
function ariaCurrent($page): string { return isActivePage($page) ? ' aria-current="page"' : ''; }

/* ---- Formatting / slugs ------------------------------------------------------------------------- */
function formatPhone($phone): string {
    $digits = preg_replace('/\D+/', '', (string) $phone);
    if (strlen($digits) === 11 && $digits[0] === '1') $digits = substr($digits, 1);
    if (strlen($digits) !== 10) return (string) $phone;
    return '(' . substr($digits, 0, 3) . ') ' . substr($digits, 3, 3) . '-' . substr($digits, 6);
}
function p1_slugify(string $s): string {
    $s = strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', str_replace('&', ' and ', $s)), '-'));
    return $s;
}
function getServiceSlug($name): string {
    global $services;
    foreach ((array) ($services ?? []) as $navSlugSvc) {
        if (strcasecmp($navSlugSvc['name'], (string) $name) === 0) return $navSlugSvc['slug'];
    }
    return p1_slugify((string) $name);
}
function getAreaSlug($city): string {
    return p1_slugify(preg_replace('/,\s*[A-Za-z]{2}$/', '', (string) $city)); // "Newberry, FL" -> newberry
}

/** Area links for nav/footer. An area page is linked only once it exists on disk; until then it points at the hub anchor. */
function p1_area_links(): array {
    global $areaPages;
    $out = [];
    foreach ((array) ($areaPages ?? []) as $fnArea) {
        $built = is_dir($_SERVER['DOCUMENT_ROOT'] . '/service-areas/' . $fnArea['slug']);
        $out[] = [
            'name'  => $fnArea['name'],
            'slug'  => $fnArea['slug'],
            'built' => $built,
            'href'  => $built ? '/service-areas/' . $fnArea['slug'] . '/' : '/service-areas/#' . $fnArea['slug'],
        ];
    }
    return $out;
}

/* ---- Logo: image-first, analysed by aspect ratio; text mark when no logo file exists ------------- */
function p1_logo_markup(string $context = 'header'): string {
    global $siteName, $address;
    $root = $_SERVER['DOCUMENT_ROOT'];
    $file = '';
    foreach (['logo-mark*.png', 'logo-mark*.webp', 'logo.svg', 'logo*.png', 'logo*.webp'] as $fnPattern) {
        $hit = glob($root . '/assets/images/' . $fnPattern);
        if ($hit) { sort($hit); $file = end($hit); break; } // highest version suffix wins
    }
    $name = p1_esc($siteName);
    if ($file !== '') {
        $w = $h = 0;
        if (substr($file, -4) === '.svg') {
            $svg = (string) file_get_contents($file);
            if (preg_match('/viewBox="[\d.\s-]*?\s([\d.]+)\s([\d.]+)"/', $svg, $m)) { $w = (float) $m[1]; $h = (float) $m[2]; }
        } else {
            $dim = @getimagesize($file);
            if ($dim) { $w = $dim[0]; $h = $dim[1]; }
        }
        if ($w > 0 && $h > 0) {
            $ratio = $w / $h;
            $cls = $ratio > 3 ? 'logo--wordmark' : ($ratio < 1.5 ? 'logo--square' : 'logo--combo');
            $renderH = $ratio > 3 ? 120 : ($ratio < 1.5 ? 88 : 96);
            $renderW = (int) round($renderH * $ratio);
            $src = '/assets/images/' . basename($file);
            return '<a class="brand site-logo" href="/" aria-label="' . $name . ' — home"><img class="' . $cls . '" src="' . p1_esc($src) . '" alt="' . $name . '" width="' . $renderW . '" height="' . $renderH . '"' . ($context === 'footer' ? ' loading="lazy"' : '') . '></a>';
        }
    }
    $sub = p1_esc($address['city'] . ', ' . $address['state']);
    $initial = p1_esc(strtoupper(substr((string) $siteName, 0, 1)));
    return '<a class="brand site-logo" href="/" aria-label="' . $name . ' — home"><span class="logo-mark" aria-hidden="true">' . $initial . '</span><span class="logo-text"><span class="brand-name logo-name">' . $name . '</span><span class="brand-sub">' . $sub . '</span></span></a>';
}

/* ---- SEO: meta defaults + tag block ------------------------------------------------------------- */
function p1_default_title(): string {
    global $siteName, $primaryKeyword, $address;
    return ucwords($primaryKeyword) . ' in ' . $address['city'] . ', ' . $address['state'] . ' | ' . $siteName;
}
function p1_default_description(): string {
    global $siteName, $primaryKeyword, $address, $phone, $primaryCounty;
    return sprintf(
        '%s: %s in %s, %s. Residential and commercial wiring, generators and repairs across %s. Call %s.',
        $siteName, $primaryKeyword, $address['city'], $address['state'], $primaryCounty, $phone
    );
}
/** Canonical from the request path: query stripped, /index.php collapsed, trailing slash on directory pages. */
function p1_request_canonical(): string {
    global $siteUrl;
    $path = (string) parse_url((string) ($_SERVER['REQUEST_URI'] ?? '/'), PHP_URL_PATH);
    $path = preg_replace('#/index(\.php)?$#', '/', $path) ?: '/';
    $path = preg_replace('#\.php$#', '', $path);
    if ($path === '' || $path[0] !== '/') $path = '/' . $path;
    if (substr($path, -1) !== '/' && is_dir($_SERVER['DOCUMENT_ROOT'] . $path)) $path .= '/';
    return rtrim($siteUrl, '/') . $path;
}
function generateMetaTags($title, $description, $canonical): string {
    global $noindex;
    $out  = '<title>' . p1_esc($title) . "</title>\n";
    $out .= '<meta name="description" content="' . p1_esc($description) . "\">\n";
    if (!empty($noindex)) $out .= "<meta name=\"robots\" content=\"noindex, follow\">\n";
    $out .= '<link rel="canonical" href="' . p1_esc($canonical) . "\">\n";
    return $out;
}

/* ---- Schema ------------------------------------------------------------------------------------- */
function p1_schema_script($data): string {
    if (is_string($data)) return $data; // already a <script> block
    return '<script type="application/ld+json">' . json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) . "</script>\n";
}
function p1_org_id(): string { global $siteUrl; return rtrim($siteUrl, '/') . '/#organization'; }
function p1_area_served(): array {
    global $areaPages, $primaryCounty, $address;
    $out = [];
    foreach ((array) ($areaPages ?? []) as $fnArea) $out[] = ['@type' => 'City', 'name' => $fnArea['name'] . ', ' . $fnArea['state']];
    if (!empty($primaryCounty)) $out[] = ['@type' => 'AdministrativeArea', 'name' => $primaryCounty . ', ' . $address['state']];
    return $out;
}
/** Homepage LocalBusiness block. Every field comes from config.php; empty config values are omitted, never defaulted. */
function p1_local_business_schema(string $image = ''): array {
    global $siteName, $siteUrl, $phoneE164, $email, $businessDescription, $address, $addressPublic, $addressIsPoBox,
           $geo, $hours, $services, $gbp, $socialLinks;
    $base = rtrim($siteUrl, '/');
    $addr = ['@type' => 'PostalAddress', 'addressLocality' => $address['city'], 'addressRegion' => $address['state'],
             'postalCode' => $address['zip'], 'addressCountry' => 'US'];
    if (!empty($addressPublic) && empty($addressIsPoBox) && !empty($address['street'])) $addr = ['@type' => 'PostalAddress', 'streetAddress' => $address['street']] + array_slice($addr, 1);
    $lb = [
        '@context'    => 'https://schema.org',
        '@type'       => 'Electrician',
        '@id'         => p1_org_id(),
        'name'        => $siteName,
        'url'         => $base . '/',
        'telephone'   => $phoneE164,
        'email'       => $email,
        'description' => $businessDescription,
        'address'     => $addr,
        'areaServed'  => p1_area_served(),
    ];
    if ($image !== '') $lb['image'] = $image;
    if (!empty($geo['lat']) && !empty($geo['lng'])) $lb['geo'] = ['@type' => 'GeoCoordinates', 'latitude' => $geo['lat'], 'longitude' => $geo['lng']];
    if (!empty($hours) && is_array($hours)) $lb['openingHours'] = array_values(array_filter($hours, 'is_string'));
    if (!empty($gbp['share_url'])) $lb['hasMap'] = $gbp['share_url'];
    if (!empty($socialLinks)) $lb['sameAs'] = array_values(array_filter((array) $socialLinks));
    $offers = [];
    foreach ((array) $services as $fnSvc) {
        $offers[] = ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => $fnSvc['name'], 'description' => $fnSvc['description'],
                     'url' => $base . '/services/' . $fnSvc['slug'] . '/']];
    }
    if ($offers) $lb['hasOfferCatalog'] = ['@type' => 'OfferCatalog', 'name' => 'Electrical services', 'itemListElement' => $offers];
    return $lb; // NEVER aggregateRating — GBP review counts are visible page content only
}
function generateServiceSchema($service, string $url = ''): array {
    global $siteUrl;
    $slug = $service['slug'] ?? getServiceSlug($service['name'] ?? '');
    return [
        '@context'    => 'https://schema.org',
        '@type'       => 'Service',
        'name'        => $service['name'],
        'serviceType' => $service['name'],
        'description' => $service['description'] ?? '',
        'url'         => $url !== '' ? $url : rtrim($siteUrl, '/') . '/services/' . $slug . '/',
        'provider'    => ['@id' => p1_org_id()],
        'areaServed'  => p1_area_served(),
    ];
}
/** $faqs: list of ['q' => ..., 'a' => ...] (or question/answer). AI-comprehension aid only — not a rich-result feature. */
function generateFAQSchema(array $faqs): array {
    $items = [];
    foreach ($faqs as $fnFaq) {
        $q = $fnFaq['q'] ?? $fnFaq['question'] ?? '';
        $a = $fnFaq['a'] ?? $fnFaq['answer'] ?? '';
        if ($q === '' || $a === '') continue;
        $items[] = ['@type' => 'Question', 'name' => strip_tags($q), 'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags($a)]];
    }
    return ['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $items];
}
/** $crumbs: list of [name, absoluteUrl]; the current page is the last item. */
function generateBreadcrumbSchema(array $crumbs): array {
    $items = [];
    foreach (array_values($crumbs) as $i => $fnCrumb) {
        $items[] = ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $fnCrumb[0], 'item' => $fnCrumb[1]];
    }
    return ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $items];
}

/**
 * @graph nodes for a /services/<slug>/ page: Service (@id <url>#service-<slug>, provider -> homepage Electrician
 * @id), WebPage with Speakable, BreadcrumbList, plus the page's FAQPage node when it shows FAQs.
 * The page wraps the result: ["@context" => "https://schema.org", "@graph" => p1_service_page_nodes(...)].
 * $faqNode is generateFAQSchema($faqs) from the page (omit when the page has no FAQs).
 */
function p1_service_page_nodes(array $svc, string $url, string $title, string $description, string $serviceType, array $faqNode = []): array {
    global $siteUrl, $siteName;
    $base = rtrim($siteUrl, '/');
    $service = generateServiceSchema($svc, $url);
    unset($service['@context']);
    $service['@id'] = $url . '#service-' . $svc['slug'];
    $service['serviceType'] = $serviceType;
    $service['description'] = $description;
    $service['provider'] = ['@id' => p1_org_id(), '@type' => 'Electrician', 'name' => $siteName];
    $nodes = [
        $service,
        ['@type' => 'WebPage', '@id' => $url . '#webpage', 'url' => $url, 'name' => $title, 'description' => $description,
         'about' => ['@id' => $service['@id']], 'isPartOf' => ['@type' => 'WebSite', 'name' => $siteName, 'url' => $base . '/'],
         'speakable' => ['@type' => 'SpeakableSpecification', 'cssSelector' => ['h1', '.hero-answer', '.answer-block']]],
    ];
    $crumbs = generateBreadcrumbSchema([['Home', $base . '/'], ['Services', $base . '/services/'], [$svc['name'], $url]]);
    unset($crumbs['@context']);
    $nodes[] = $crumbs;
    if (!empty($faqNode['mainEntity'])) {
        unset($faqNode['@context']);
        $faqNode['@id'] = $url . '#faq';
        $nodes[] = $faqNode;
    }
    return $nodes;
}

/** The $services row for a slug (empty array when absent). */
function p1_service_by_slug(string $slugWanted): array {
    global $services;
    foreach ((array) $services as $fnSvcRow) if ($fnSvcRow['slug'] === $slugWanted) return $fnSvcRow;
    return [];
}

/**
 * @graph for a compliance page (privacy-policy, terms, cookie-policy, accessibility): WebPage + BreadcrumbList.
 * Compliance pages are indexable informational pages — no Service, no FAQPage.
 */
function p1_legal_page_schema(string $name, string $url, string $title, string $description): array {
    global $siteUrl, $siteName;
    $base = rtrim($siteUrl, '/');
    $crumbs = generateBreadcrumbSchema([['Home', $base . '/'], [$name, $url]]);
    unset($crumbs['@context']);
    return [
        '@context' => 'https://schema.org',
        '@graph'   => [
            ['@type' => 'WebPage', '@id' => $url . '#webpage', 'url' => $url, 'name' => $title, 'description' => $description,
             'isPartOf' => ['@type' => 'WebSite', 'name' => $siteName, 'url' => $base . '/'], 'about' => ['@id' => p1_org_id()]],
            $crumbs,
        ],
    ];
}
