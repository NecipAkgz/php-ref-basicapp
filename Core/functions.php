<?php

use Core\Response;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

/**
 * Check if the current URL matches the given value.
 *
 * @param string $value The value to compare the current URL against.
 * @return bool Returns true if the current URL matches the given value, false otherwise.
 */
function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($code = Response::NOT_FOUND)
{
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}

/**
 * Authorize the action based on the given condition.
 *
 * @param mixed $condition The condition to check for authorization.
 * @param int $status The status code to use for aborting the request.
 */
function authorize($condition, $status = Response::FORBIDDEN)
{
    if (!$condition) {
        abort($status);
    }
}

function base_path($path = ''): string
{
    return BASE_PATH . $path;
}

function view($path, $data = [])
{
    extract($data);
    require base_path('views/' . $path);
}