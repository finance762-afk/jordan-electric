<?php
/**
 * includes/blog-data.php — single source of truth for all blog post metadata (Jordan Electric).
 * Newest post FIRST. The blog index, the homepage "From the Blog" card, the Related Articles blocks and sitemap.php all read
 * this array; never hardcode a post list anywhere else. Adding a post = one entry here + one /blog/{slug}/index.php.
 *
 * 'image' is a root-relative path under /assets/images/ (use the -960.webp variant) and must exist on disk. No client photos
 * are on disk yet (assets/images holds only the favicons), so both launch posts leave it '' and the card renderer
 * (includes/blog-card.php) draws a typographic icon tile instead. Fill 'image' + 'alt' once photos are staged.
 * 'icon' is a references/lucide-icons name used by that fallback tile. Titles stay <= 60 characters, no brand suffix.
 */
$blogPosts = [
    [
        'slug'     => 'electrical-panel-upgrade-cost-newberry-fl',
        'title'    => 'Electrical Panel Upgrade Cost in Newberry: What Drives It',
        'excerpt'  => 'No two panel upgrades cost the same. See what moves the price, how to spot a panel that needs replacing, and how permits work in Newberry.',
        'image'    => '',
        'alt'      => '',
        'icon'     => 'zap',
        'date'     => 'October 19, 2026',
        'dateISO'  => '2026-10-19',
        'category' => 'Cost Guide',
        'readtime' => '6 min read',
    ],
    [
        'slug'     => 'generator-installation-before-hurricane-season',
        'title'    => 'When to Install a Generator Before Florida Hurricane Season',
        'excerpt'  => 'Hurricane season runs June 1 to November 30. Here is when to plan a backup generator in Newberry, and what to decide before the quote.',
        'image'    => '',
        'alt'      => '',
        'icon'     => 'battery-charging',
        'date'     => 'October 19, 2026',
        'dateISO'  => '2026-10-19',
        'category' => 'Storm Season',
        'readtime' => '6 min read',
    ],
];
