<?php

return [
    'plugin' => [
        'name' => 'SEO',
        'description' => 'Multilanguage basic SEO',
        'manage' => 'Manage SEO',
    ],
    'component_seo' => [
        'name' => 'SEO',
        'description' => 'SEO content',
        'property_append' => [
            'title' => 'Append',
            'description' => 'Append to the page title (ej. | SiteName)',
        ],
    ],
    'seo' => [
        'update_title' => 'Update SEO',
        'create_title' => 'Create SEO Page',
        'page' => 'Page',
        'title' => 'Title',
        'description' => 'Description',
        'keywords' => 'Keywords (separated with a ,)',
        'image' => 'Social Networks Image'
    ],
];