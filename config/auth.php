<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'employees',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'employees',
        ],

        // Se você precisar de um guard API
        'api' => [
            'driver' => 'token',
            'provider' => 'employees',
            'hash' => false,
        ],
    ],

    'providers' => [
        'employees' => [
            'driver' => 'eloquent',
            'model' => App\Models\Employee::class,
        ],

        // Caso precise de um provider baseado em banco de dados
        // 'employees' => [
        //     'driver' => 'database',
        //     'table' => 'employees',
        // ],
    ],

    'passwords' => [
        'employees' => [
            'provider' => 'employees',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
