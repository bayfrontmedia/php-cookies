<?php

/**
 * @package php-cookies
 * @link https://github.com/bayfrontmedia/php-cookies
 * @author John Robinson <john@bayfrontmedia.com>
 * @copyright 2020 Bayfront Media
 */

namespace Bayfront\Cookies;

class Cookie
{

    /**
     * Returns value of single $_COOKIE array key or entire array, with optional default value.
     *
     * @param string|null $key
     * @param mixed $default (Default value to return if the array key is not found)
     *
     * @return mixed
     */

    public static function get(string $key = NULL, $default = NULL)
    {

        if (NULL === $key) { // Return the entire array

            return $_COOKIE;

        }

        // Return a specific key

        if (isset($_COOKIE[$key])) {

            return $_COOKIE[$key];

        }

        return $default;

    }

    /**
     * Checks if $_COOKIE array key exists.
     *
     * @param string $key
     *
     * @return bool
     */

    public static function has(string $key): bool
    {
        return (self::get($key)) ? true : false;
    }

    /**
     * Creates a cookie.
     *
     * @param string $name (Cookie name)
     * @param string $value (Cookie value)
     * @param int $minutes (Minutes from now until the cookie expires)
     * @param string $path (Path on the server in which the cookie will be available)
     * @param string $domain (Domain/subdomain that the cookie is available to)
     * @param bool $secure (Transmit the cookie only over a secure https connection)
     * @param bool $http_only (Accessible only through the http protocol)
     *
     * @return bool
     */

    public static function set(string $name, string $value, int $minutes = 0, string $path = '/', string $domain = '', bool $secure = true, bool $http_only = true): bool
    {

        // -1 = Delete, 0 = Expire at end of session, > 0 = Minutes from now

        if ($minutes < 0) {

            $time = 1;

        } else if ($minutes == 0) {

            $time = 0;

        } else {

            $time = time() + 60 * $minutes;

        }

        $set = setcookie($name, $value, $time, $path, $domain, $secure, $http_only);

        if ($set) {

            $_COOKIE[$name] = $value; // Make available without reloading page

            return true;

        }

        return false;

    }

    /**
     * Removes validity of cookie.
     *
     * @param string $name
     *
     * @return void
     */

    public static function forget(string $name): void
    {

        self::set($name, false, -1); // Expire in browser

        unset($_COOKIE[$name]); // Remove from script

    }

    /**
     * Removes the validity of all cookies.
     *
     * @return void
     */

    public static function forgetAll(): void
    {

        $cookies = self::get();

        if (is_array($cookies)) {

            foreach ($cookies as $cookie) {

                self::forget($cookie);

            }

        }

    }

}