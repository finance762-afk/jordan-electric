<?php
/**
 * includes/config.php — single source of site-wide variables (Jordan Electric).
 * Every value below traces to build-plan.json, except the four services, which build-plan.json leaves empty and
 * which are taken verbatim from the client's own site (web_sources: https://www.jordanelectricllc.net/services-content,
 * read 2026-10-19). Nothing here is invented: values the plan leaves blank (tagline, hours, license, insurance,
 * social links, GBP data, geo) stay empty and the templates omit anything empty.
 */

// ---- Identity ---------------------------------------------------------------------------------
$slug          = 'jordan-electric';                    // exact build directory name
$siteName      = 'Jordan Electric';                    // build-plan company_name
$tagline       = '';                                   // build-plan tagline is empty — never invent
$industry      = 'electrician';
$industryLabel = 'Electrician';                        // build-plan industry
$ownerName     = 'Mallory Jordan';                     // build-plan owner_name

// ---- Contact ----------------------------------------------------------------------------------
$phone          = '(352) 472-5511';
$phoneRaw       = '3524725511';
$phoneE164      = '+13524725511';
$phoneSecondary = '';
$email          = 'mallory@jordanelectricllc.net';
$contactEmail   = $email;
// Lead routing only (server-side, never rendered)
$leadNotificationEmail = 'mallory@jordanelectricllc.net';
$leadNotificationPhone = '(352) 472-5511';

// address_public is true, but the street is a PO box. Print the mailing address in the footer NAP if wanted, but
// leave streetAddress OUT of LocalBusiness schema (Google does not accept PO boxes as a business location).
$addressPublic = true;
$addressIsPoBox = true;
$address = ['street' => 'PO Box 215', 'city' => 'Newberry', 'state' => 'FL', 'zip' => '32669'];
$primaryCity = 'Newberry';
$primaryCounty = 'Alachua County';                     // client site: "homeowners across Alachua County"

// ---- Domain / URLs ----------------------------------------------------------------------------
// build-plan has no production_domain (its "domain" field holds only the slug), so default to the preview host.
$domain  = 'jordan-electric.pageone.cloud';
$siteUrl = 'https://' . $domain;
// $canonicalUrl is NOT set here — each page sets its own from $siteUrl + path before including head.php.

// ---- SEO --------------------------------------------------------------------------------------
$primaryKeyword    = 'new home electrician';           // build-plan seo.primary_keyword
// build-plan seo.secondary_keywords, verbatim (lowercased)
$secondaryKeywords = [
    'electrician near me', 'local electrician', 'licensed electrician', 'residential electrician',
    'commercial electrician', 'emergency electrician', 'affordable electrician', 'best electrician near me',
    'electrical repair services', 'electrical wiring', 'electrical panel upgrade', 'circuit breaker repair',
    'electrical outlet installation', 'lighting installation', 'ceiling fan installation',
    'electrical troubleshooting', 'generator installation', 'ev charger installation', 'whole-house rewiring',
    'electrical maintenance', 'commercial electrician near me', 'commercial electrical contractor',
    'commercial electrical services', 'commercial electrical company', 'licensed commercial electrician',
    'commercial electrical repair', 'commercial electrical installation', 'commercial electrical maintenance',
    'electrical maintenance for businesses', 'office electrical installation', 'warehouse electrical services',
    'retail store electrical contractor', 'restaurant electrical contractor', 'three-phase electrical installation',
    'electrician',
];
$serviceRadiusMiles = 25;                              // build-plan seo.target_radius

// ---- Services (4 — from the client's services page; build-plan services[] is empty) ------------
// Names and descriptions quote the client's site. Keywords are the build-plan secondary keywords that fit each one.
$services = [
    ['name' => 'Residential Electrical Services', 'slug' => 'residential-electrical',
     'description' => 'Complete residential electrical services for homeowners across Alachua County.',
     'keywords' => ['new home electrician', 'residential electrician', 'electrical wiring', 'electrical panel upgrade',
                    'electrical outlet installation', 'lighting installation', 'ceiling fan installation',
                    'ev charger installation', 'whole-house rewiring']],
    ['name' => 'Commercial Electrical Services', 'slug' => 'commercial-electrical',
     'description' => 'Electrical solutions for businesses that support daily operations and future growth.',
     'keywords' => ['commercial electrician', 'commercial electrical contractor', 'commercial electrical services',
                    'commercial electrical installation', 'commercial electrical maintenance',
                    'electrical maintenance for businesses', 'office electrical installation',
                    'warehouse electrical services', 'retail store electrical contractor',
                    'restaurant electrical contractor', 'three-phase electrical installation']],
    ['name' => 'Generator Installation', 'slug' => 'generator-installation',
     'description' => 'Generator systems that provide reliable backup power when it is needed most.',
     'keywords' => ['generator installation']],
    ['name' => 'Electrical Service Calls & Repairs', 'slug' => 'electrical-repairs',
     'description' => 'Troubleshooting and repair for both residential and commercial properties.',
     'keywords' => ['electrical repair services', 'electrical troubleshooting', 'circuit breaker repair',
                    'commercial electrical repair', 'electrical maintenance']],
];

// ---- Service areas (Premium: /areas/{slug}/ per town) -----------------------------------------
$serviceAreas = ['Newberry, FL'];                      // build-plan service_areas
$areaPages = [
    ['slug' => 'newberry', 'name' => 'Newberry', 'state' => 'FL'],
];

// ---- Hours ------------------------------------------------------------------------------------
$hours = [];                                           // build-plan business_hours is empty — confirm at onboarding
$businessHours = '';                                   // one-line form for the v8 components (omitted when empty)

// ---- Brand ------------------------------------------------------------------------------------
// build-plan design.colors holds no hex values and assets.logo is null; these match the tokens the scaffold wrote into
// framework.css (:root --color-primary/secondary/accent). Replace with logo-analysis values once a logo is supplied.
$colors = ['primary' => '#1f2428', 'secondary' => '#5a6570', 'accent' => '#c8461a'];
$yearEstablished = 2026;                               // build-plan content: "in business since 2026" (content.years = 0)
$yearsInBusiness = (int) date('Y') - $yearEstablished;
$yearsExperience = 20;                                 // client site: "20 years of hands-on experience" — confirm whose

// Short factual description for schema / AEO (build-plan content.description, with the real service names)
$businessDescription = 'Jordan Electric is an electrician based in Newberry, FL, serving Alachua County. Services include residential electrical services, commercial electrical services, generator installation, and electrical service calls and repairs.';

// ---- Google Business Profile ------------------------------------------------------------------
$gbp = [
    'place_id'      => '',                             // integrations.gbp_place_id is null
    'share_url'     => '',                             // google_business_profile_url is empty
    'url'           => '',
    'directions'    => '',                             // integrations.directions_url is null
    'review_url'    => '',                             // integrations.review_request_url is null
    'embed_src'     => '',                             // integrations.gbp_map_embed is null — no map embed
    'reviews_count' => 0,                              // no review data in the plan: no ratings, never AggregateRating
];
$geo = [];                                             // integrations.geo is null — omit GeoCoordinates

// ---- Social / analytics -----------------------------------------------------------------------
$socialLinks       = [];                               // none provided — footer renders icons only for platforms the client uses
$googleAnalyticsId = 'G-XXXXXXXXXX';                   // placeholder until the client's GA4 measurement ID is set

// ---- Forms ------------------------------------------------------------------------------------
$formAction      = 'https://db.pageone.cloud/functions/v1/leads/jordan-electric';   // build-plan form_action, verbatim
// HMAC secret for the spam-shield `_ft` field. Blank in the repo: the real value is injected by
// ~/crm/scripts/patch-leads-spamshield.py at promote time. p1-form-helpers.php skips the shield when empty.
$leadsFormSecret = '';

// ---- v8 components (written exactly as build-plan integrations holds them) ---------------------
$estimateTool   = [];   // integrations.estimate_tool.authorized is false
$bookingWindows = [];   // integrations.booking.authorized is false
$textUsNumber   = '';   // integrations.text_us_number is null (accepts_sms false) -> two-button sticky bar
$financing      = [];   // integrations.financing is null
$serviceZips    = [];   // integrations.service_zips not provided

$cssVersion = '2';      // the SINGLE framework.css cache-bust; bump here on every framework.css / critical.css change

// ---- Lead attribution (first-touch cookie + p1_attribution_fields()) — must stay last, before any output ----
require_once __DIR__ . '/attribution.php';
