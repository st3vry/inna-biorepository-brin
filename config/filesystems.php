<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

        'sftp' => [
            'driver' => 'sftp',
            'host' => env('SFTP_HOST'),
            'port' => 22,
            // Settings for basic authentication...
            'username' => env('SFTP_USERNAME'),
            'password' => env('SFTP_PASSWORD'),

            // Settings for SSH key based authentication with encryption password...
            'privateKey' => '-----BEGIN OPENSSH PRIVATE KEY-----
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
-----END OPENSSH PRIVATE KEY-----',
            // 'password' => env('SFTP_PASSWORD'),

            // Optional SFTP Settings...
            // 'hostFingerprint' => env('SFTP_HOST_FINGERPRINT'),
            // 'maxTries' => 4,
            // 'passphrase' => env('SFTP_PASSPHRASE'),

            'root' => env('SFTP_ROOT'),
            'permPublic' => 0755,
            'directoryPerm' => 0755,
            'visibility' => 'public',
            'timeout' => 30,
            'useAgent' => true,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
