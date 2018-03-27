<?php

return [
    'plugin' => [
        'name' => 'SEO',
        'title' => 'SEO',
        'description' => 'Gerir SEO com multi-idiomas',
        'manage' => 'Gerir SEO',

    ],
    'component_seo' => [
        'name' => 'SEO',
        'description' => 'Conteúdo SEO',
        'property_append' => [
            'title' => 'Acrescentar',
            'description' => 'Acrescentar ao título da página (ex. | SiteName)',
        ],
    ],
    'component_canonical_url' => [
        'name' => 'URL Canônica',
        'description' => 'Constrói a URL canônica.',
    ],
    'seo' => [
        'update_title' => 'Atualizar SEO',
        'create_title' => 'Criar SEO para Página',
        'page' => 'Página',
        'title' => 'Título',
        'description' => 'Descrição',
        'keywords' => 'Palavras chaves (separadas por ,)',
        'image' => 'Imagem para as Redes Sociais'
    ],
];
