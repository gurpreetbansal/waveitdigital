<?php
return [
    'pdf' => array(
        'enabled' => true,
        //'binary' => base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'),
        'binary' => base_path('vendor\wemersonjanuario\wkhtmltopdf-windows\bin\64bit\wkhtmltopdf'),
        'timeout' => false,
        'options' => array(),
        'env' => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary' => 'vendor\wemersonjanuario\wkhtmltopdf-windows\bin\64bit\wkhtmltoimage',
        'timeout' => false,
        'options' => array(),
        'env' => array(),
    ),
];

// return [
//     'pdf' => [
//         'enabled' => true,
//         // 'binary'  => env('WKHTML_PDF_BINARY', '/usr/local/bin/wkhtmltopdf'),
//         'binary'  => '/usr/local/bin/wkhtmltopdf-amd64',
//         // 'binary' => base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'),
//         'timeout' => false,
//         'options' => [],
//         'env'     => [],
//     ],
    
//     'image' => [
//         'enabled' => true,
//         // 'binary'  => env('WKHTML_IMG_BINARY', '/usr/local/bin/wkhtmltoimage'),
//         'binary'  => '/usr/local/bin/wkhtmltoimage-amd64',
//         'timeout' => false,
//         'options' => [],
//         'env'     => [],
//     ],
// ];
