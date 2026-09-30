<?php

return [

    'show_warnings' => false,

    'public_path' => null,

    'convert_entities' => true,

    'options' => [

        'font_dir' => storage_path('fonts'),

        'font_cache' => storage_path('fonts'),

        'temp_dir' => storage_path('app'),

        'chroot' => realpath(base_path()),

        'allowed_protocols' => [
            'file://' => [
                'rules' => [],
            ],
            'http://' => [
                'rules' => [],
            ],
            'https://' => [
                'rules' => [],
            ],
        ],

        'log_output_file' => null,

        'enable_font_subsetting' => true,

        'pdf_backend' => 'CPDF',

        'default_media_type' => 'screen',

        'default_paper_size' => 'a4',

        'default_paper_orientation' => 'portrait',

        'default_font' => 'DejaVu Sans',

        'dpi' => 96,

        'enable_php' => false,

        'enable_javascript' => true,

        'enable_remote' => false,

        'font_height_ratio' => 1.1,

        'enable_html5_parser' => true,

    ],

];
