<?php
/**
 * includes/service-cards.php — card copy for the four services (icon, one-line description, exactly 3 bullets).
 * Drawn from the client's own services page (jordanelectricllc.net/services-content, read 2026-10-19);
 * matches the homepage cards. Used by /services/ and includes/related-services.php.
 */
$serviceCardCopy = [
    'residential-electrical' => [
        'icon'    => 'house',
        'desc'    => 'Wiring for new construction homes, panel upgrades, system improvements and repairs.',
        'bullets' => ['New construction home wiring', 'Panel and system upgrades', 'Built to current electrical code'],
    ],
    'commercial-electrical' => [
        'icon'    => 'building-2',
        'desc'    => 'New construction, system upgrades and electrical installations for local businesses.',
        'bullets' => ['Projects of all sizes', 'Limited disruption to operations', 'Code-compliant installations'],
    ],
    'generator-installation' => [
        'icon'    => 'battery-charging',
        'desc'    => 'Backup generator systems for homes or businesses, tied into existing wiring.',
        'bullets' => ['Home and business systems', 'Integrated with existing electrical', 'Ready before the next outage'],
    ],
    'electrical-repairs' => [
        'icon'    => 'wrench',
        'desc'    => 'Troubleshooting and repair for faulty outlets, lighting problems and system failures.',
        'bullets' => ['Residential and commercial calls', 'Faulty outlets and lighting', 'Done right the first time'],
    ],
];
