<?php

namespace Core\Middleware;

class Middleware
{
    const array MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class
    ];

    public static function resolve($key)
    {
        if (!$key) {
            return;
        }

        $middleware = static::MAP[$key];

        if (!$middleware) {
            throw new \Exception("$key is not a valid middleware");
        }

        (new $middleware())->handle();
    }

}
