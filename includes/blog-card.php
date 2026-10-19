<?php
/**
 * includes/blog-card.php — renderers for blog cards, shared by /blog/, the homepage and the Related Articles blocks.
 * Reads posts from includes/blog-data.php ($blogPosts); callers never hardcode post lists.
 *   p1_blog_card(array $post, bool $featured = false, string $reveal = '')  one <article class="blog-card">
 *   p1_blog_related(string $currentSlug, int $max = 3)                      posts for a Related Articles block:
 *                                                                           same category first, then most recent
 * A post with an empty 'image' gets a typographic icon tile (no client photos on disk yet).
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/blog-data.php';

if (!function_exists('p1_blog_card')) {
    function p1_blog_card(array $post, bool $featured = false, string $reveal = ''): string {
        $url = '/blog/' . $post['slug'] . '/';
        $img = '';
        $imgFile = !empty($post['image']) ? $_SERVER['DOCUMENT_ROOT'] . $post['image'] : '';
        if ($imgFile !== '' && is_file($imgFile)) {
            $dim = @getimagesize($imgFile);
            $img = '<img src="' . p1_esc($post['image']) . '" alt="' . p1_esc($post['alt']) . '"' . ($dim ? ' width="' . $dim[0] . '" height="' . $dim[1] . '"' : '') . ' loading="lazy" decoding="async">';
        } else {
            $img = '<span class="blog-card__tile" aria-hidden="true">' . p1_icon($post['icon'] ?? 'zap', $featured ? 56 : 40) . '<i>' . p1_esc($post['category']) . '</i></span>';
        }
        $cls = 'blog-card' . ($featured ? ' blog-card--featured' : '') . ($reveal !== '' ? ' ' . $reveal : '');
        return '<article class="' . $cls . '">'
            . '<a class="blog-card__image" href="' . p1_esc($url) . '" tabindex="-1" aria-hidden="true">' . $img . '</a>'
            . '<div class="blog-card__body">'
            . '<span class="blog-card__category">' . p1_esc($post['category']) . '</span>'
            . '<h' . ($featured ? '2' : '3') . ' class="blog-card__title"><a href="' . p1_esc($url) . '">' . p1_esc($post['title']) . '</a></h' . ($featured ? '2' : '3') . '>'
            . '<p class="blog-card__excerpt">' . p1_esc($post['excerpt']) . '</p>'
            . '<p class="blog-card__meta"><time datetime="' . p1_esc($post['dateISO']) . '">' . p1_esc($post['date']) . '</time> · ' . p1_esc($post['readtime']) . '</p>'
            . '<a class="blog-card__cta" href="' . p1_esc($url) . '">Read Article<span class="sr-only">: ' . p1_esc($post['title']) . '</span> ' . p1_icon('arrow-right', 16) . '</a>'
            . '</div></article>';
    }
}
if (!function_exists('p1_blog_related')) {
    function p1_blog_related(string $currentSlug, int $max = 3): array {
        global $blogPosts;
        $cur = null;
        foreach ($blogPosts as $p) if ($p['slug'] === $currentSlug) $cur = $p;
        $others = array_values(array_filter($blogPosts, fn($p) => $p['slug'] !== $currentSlug));
        usort($others, function ($a, $b) use ($cur) {
            $sa = ($cur && $a['category'] === $cur['category']) ? 0 : 1;
            $sb = ($cur && $b['category'] === $cur['category']) ? 0 : 1;
            return $sa <=> $sb ?: strcmp($b['dateISO'], $a['dateISO']);
        });
        return array_slice($others, 0, $max);
    }
}
