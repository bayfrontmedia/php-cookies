## PHP cookies

Helper class to easily and safely work with cookies.

- [License](#license)
- [Author](#author)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)

## License

This project is open source and available under the [MIT License](LICENSE).

## Author

<img src="https://cdn1.onbayfront.com/bfm/brand/bfm-logo.svg" alt="Bayfront Media" width="250" />

- [Bayfront Media homepage](https://www.bayfrontmedia.com?utm_source=github&amp;utm_medium=direct)
- [Bayfront Media GitHub](https://github.com/bayfrontmedia)

## Requirements

* PHP `^8.0` (Tested up to `8.4`)

## Installation

```
composer require bayfrontmedia/php-cookies
```

## Usage

- [get](#get)
- [has](#has)
- [set](#set)
- [forget](#forget)
- [forgetAll](#forgetall)

<hr />

### get

**Description:**

Returns value of single `$_COOKIE` array key or entire array, with optional default value.

**Parameters:**

- `$key = NULL` (string|null)
- `$default = NULL` (mixed): Default value to return if the array key is not found

**Returns:**

- (mixed)

**Example:**

```
use Bayfront\Cookies\Cookie;

print_r(Cookie::get());
```

<hr />

### has

**Description:**

Checks if `$_COOKIE` array key exists.

**Parameters:**

- `$key` (string)

**Returns:**

- (bool)

**Example:**

```
use Bayfront\Cookies\Cookie;

if (Cookie::has('cart_id')) {
    // Do something
}
```

<hr />

### set

**Description:**

Creates a cookie.

See: [https://www.php.net/manual/en/function.setcookie.php](https://www.php.net/manual/en/function.setcookie.php)

**Parameters:**

- `$name` (string): Cookie name
- `$value` (string): Cookie value
- `$minutes = 0` (int): Minutes from now until the cookie expires
- `$path = '/'` (string): Path on the server in which the cookie will be available
- `$domain = ''` (string): Domain/subdomain that the cookie is available to
- `$secure = true` (bool): Transmit the cookie only over a secure https connection
- `$http_only = true` (bool): Accessible only through the http protocol
- `$same_site = 'Lax'` (string): Acceptable values of `None`, `Lax` or `Strict`

**Returns:**

- (bool)

**Example:**

```
use Bayfront\Cookies\Cookie;

Cookie::set('cart_id', 'abc123', 60);
```

<hr />

### forget

**Description:**

Removes validity of cookie.

**Parameters:**

- `$name` (string)

**Returns:**

- (void)

**Example:**

```
use Bayfront\Cookies\Cookie;

Cookie::forget('cart_id');
```

<hr />

### forgetAll

**Description:**

Removes the validity of all cookies.

**Parameters:**

- None

**Returns:**

- (void)

**Example:**

```
use Bayfront\Cookies\Cookie;

Cookie::forgetAll();
```