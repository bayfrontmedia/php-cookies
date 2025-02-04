<?php

namespace Bayfront\Cookies;

class Cookie
{

    /**
     * Returns value of single $_COOKIE array key or entire array, with optional default value.
     *
     * @param string|null $key
     * @param mixed|null $default (Default value to return if the array key is not found)
     * @return mixed
     */
    public static function get(?string $key = NULL, mixed $default = NULL): mixed
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
     * @return bool
     */
    public static function has(string $key): bool
    {
        return (bool)self::get($key);
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
     * @param string $same_site (Acceptable values of None, Lax or Strict)
     * @return bool
     */
    public static function set(string $name, string $value, int $minutes = 0, string $path = '/', string $domain = '', bool $secure = true, bool $http_only = true, string $same_site = 'Lax'): bool
    {

        // < 0 = Delete, 0 = Expire at end of session, > 0 = Minutes from now

        if ($minutes < 0) {

            $time = time() - 3600;

        } else if ($minutes == 0) {

            $time = time();

        } else {

            $time = time() + 60 * $minutes;

        }

        $set = setcookie($name, $value, [
            'expires' => $time,
            'path' => $path,
            'domain' => $domain,
            'secure' => $secure,
            'httponly' => $http_only,
            'samesite' => $same_site
        ]);

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
     * @param string $path (Path on the server for the cookie to be removed)
     * @return void
     */
    public static function forget(string $name, string $path = '/'): void
    {
        self::set($name, '', -1, $path); // Expire in browser
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