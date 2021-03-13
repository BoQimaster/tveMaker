<?php


return [
    'secret'      => env('JWT_SECRET'),
    //Asymmetric key
    'public_key'  => env('JWT_PUBLIC_KEY'),
    'private_key' => env('JWT_PRIVATE_KEY'),
    'password'    => env('JWT_PASSWORD'),
    // token有效时间
    'ttl'         => env('JWT_TTL', 30),
    //Refresh time to live
    'refresh_ttl' => env('JWT_REFRESH_TTL', 15768000),
    //JWT hashing algorithm
    'algo'        => env('JWT_ALGO', 'HS256'),
    //token获取方式，数组靠前值优先
    'token_mode'    => ['header', 'cookie', 'param'],
    'blacklist_storage' => thans\jwt\provider\storage\Tp5::class,
];
