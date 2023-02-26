<?php

return [
    /*
    |--------------------------------------------------------------------------
    | You can choose not to have main locale in URLs
    |--------------------------------------------------------------------------
    |
    | If set to false, the fallback_locale defined in config/app.php
    | will not appears in URLs.
    |
    */
    'main_locale_in_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Max file upload size allowed
    |--------------------------------------------------------------------------
    */
    'max_file_upload_size' => 51200,

    /*
    |--------------------------------------------------------------------------
    | Welcome message url present in Dashboard
    |--------------------------------------------------------------------------
    */
    'welcome_message_url' => env('WELCOME_MESSAGE_URL'),

    /*
    |--------------------------------------------------------------------------
    | Folder to find template files for pages.
    | This folder is a subfolder of /resources/views/vendor/pages
    |--------------------------------------------------------------------------
    |
    */
    'template_dir' => 'public',

    /*
    |--------------------------------------------------------------------------
    | If you use MariaDB, set this value to true
    |--------------------------------------------------------------------------
    |
    */
    'mariadb' => false,

    /*
    |--------------------------------------------------------------------------
    | The following IP’s can visit the website without login when
    | the website is protected by a login and a password.
    |--------------------------------------------------------------------------
    |
    */
    'authorized_ips' => [
        // '127.0.0.1',
    ],

    'webmaster_email' => 'info@dignifykeramos.com'
];
