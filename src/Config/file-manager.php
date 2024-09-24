<?php

return [
    'diskList' => file_manager_setting('default_disk','public'),
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
        'video/ogg'
    ],
    'max_file_size' => file_manager_setting('default_file_size',1024*2),
    'limit_upload_files' => file_manager_setting('default_limit_file_upload',20),
    'path_folder' => 'uploads',
    'permission' => 0775,
    'base_path' => '/uploads',
];
