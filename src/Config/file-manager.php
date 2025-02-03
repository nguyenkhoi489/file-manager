<?php

return [
    'diskList' => 'public',
    'mime_types' => [
        'image/png',
        'image/jpeg',
        'image/svg+xml',
        'image/webp',
        'text/csv',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/vnd.ms-excel',
        'application/pdf',
        'video/mp4',
        'video/mpeg',
        'video/ogg',
        'image/vnd.microsoft.icon',
        'image/x-icon'
    ],
    'extensions' => [
        'png',
        'jpg',
        'svg',
        'webp',
        'csv',
        'xlsx',
        'xls',
        'pdf',
        'mp4',
        'mpeg',
        'ogv',
        'ico'
    ],
    'max_file_size' => 2097152,
    'limit_upload_files' => 20,
    'path_folder' => 'uploads',
    'permission' => 0755,
    'base_path' => '/uploads',
];
