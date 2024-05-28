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

        'ftp' => [
            'driver' => 'ftp',
            'host' => env('FTP_HOST'),
            'username' => env('FTP_USERNAME'),
            'password' => env('FTP_PASSWORD'),


            // Optional FTP Settings...
            'port' => 22,
            // 'root' => env('FTP_ROOT'),
            'passive' => true,
            // 'ssl' => true,
            // 'timeout' => 30,
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
            'port' => 22222,
            // Settings for basic authentication...
            'username' => env('SFTP_USERNAME'),
            'password' => env('SFTP_PASSWORD'),

            // Settings for SSH key based authentication with encryption password...
            'privateKey' => '-----BEGIN RSA PRIVATE KEY-----
            MIIEpgIBAAKCAQEA7rFxr1dwreHlTsKzlUTIosOqqVEUOnSG3dVqkLj+Z9Gnotuc
            gdcVmbfxtiPx4bDUMYn7TXrnIr+83+9t6khhs3Esnlc1Mvc7AI0ZBKbA6CPc4kp0
            Lj0bMD6+ACBAcFfgDYnBdrJtrXvD6O9cVgaN7ETmeAmsIl3s6Oqlf9wUgl4Je5ET
            tlQTHnHaOB638xOJgj3FFp0qMvtFhIlbxXrD33Zwwy7Svup54Nbo140RPfkN6Wej
            +gBXwWOeCUp/PmXTZTlHgaMv5nBisKrPcN6G8eRhCuwscEq2iDDmUIvR0WUtioQ7
            zLxFta8qZmjRQ0ZU4NiFzv9Z+cXImu92pUIP1QIDAQABAoIBAQCquVpB+r3KcQdN
            dS9zdXY4DNGVNzvLr6sDIfGNv/OfGDLZ5lAkAk4d25ZUG5OXRJ4RLMsFGQIXNaMH
            XL52Uv0mlq0+N8wCPxkBhOo/DHJv167WYECHDgfTUx0dA/RzJjdIF567olWWPy7Z
            /dJCaX+7XXCmrOxkzF92HNbxA93be7uY1bJrokYYtDhxlwAD4njSajFo0RJUGj0s
            t+pZ+RysWGbLMhmVpY651LtxziLZ+p4KLd/1sY3jdU6wax1raNy87QSiiihqnwr8
            gX2Et2tnD89+/RK151KEIhYQznwiO77hTEf2qpVQIQKTWhUeZEge4T4x0lBj3Ed9
            c93PLaJBAoGBAPe1QFTRF/iZFCEZXywqAaJDcjQuvvgmnBMlZoCC2nZfVTmW+cxv
            ZGQhSasZR7ROVm5twoCWK00JJWZSwZff72cP8B3kyRb+Jd1h8+4roi4uS5CHowSM
            +3HqcwJcm5ASApyFQZqteTGxk5ZgphlZWvBPvVhcRu9I4OB9xQYz/VgxAoGBAPau
            8HYDHCU1e0BykPwgLPBB0hfh7clss4NFRVKUf/1t7T0/dXsCgdx+tld3+ZbCkjvB
            M3npKCvN7Gfy8vmFBJ/jqJtyGKbSQ1X0aJul82j0S2LZsR6QyING625xJFu3wDCD
            WcSDCDoa3mmzXgqn48mxhcx58WTJTXvdxi27ZezlAoGBAKLoTCe73/T5z9g41HO6
            KJrrmochGy0eT1T0KuZnqH9jESyv0xcVR0Pm9IkXNiYpwwQbIWjp2g5u7m7ODE3y
            04LHY5Z1aZ66hHKFQiSoA6A1iDLEUXzjr1Zq5zptZ02n2pnPtaahYexBqhui8noH
            XxxehNtAzNH/7w0VCeebd4lxAoGBAIpV8GM9uzrikwvBM60wHgNd5gOen0qlusWS
            wx1cSapFSxVd0PP6o/iS1o6WqVDyLC92WPe02OI3yKtCgx+KiN1hPdxuT4S9xSUe
            ussOdUIWPXBhxAHwD4IO81gr+se0dALApkaddK+hAbkk7UfsfsFM3Eue1tA+U0Vz
            SP+8Z5xBAoGBAPAlhW6kFStD2EX4IqU2RAT+m6G/uGpiKuQxLBGZUc2RADypIUT1
            omeDmijxdoaPWNozTINL4e7Ob+VJmT+niZVFJ2j/YmhdqjGBnz5DtAvYwdRxytuL
            GnNzJJfeByjnL6EnjcEZsSDqO4mTROy+wL9fC4bkKa84IFo0GZI+Xfyh
            -----END RSA PRIVATE KEY-----',
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
