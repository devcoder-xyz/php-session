# PHP SessionStorage Library

## Introduction

The `SessionStorage` is a PHP library that provides a simple implementation of the `SessionStorageInterface`. It allows developers to work with PHP sessions in a convenient way, providing methods to get, set, check, and remove session data. This library requires PHP version 7.4 or higher.

## Installation

Use [Composer](https://getcomposer.org/)

### Composer Require
```
composer require devcoder-xyz/php-session
```

## Usage

To start using the `SessionStorage`, you need to create an instance of the `NativeSessionStorage` class. Here's an example of how to do it:

```php
use DevCoder\Session\Storage\NativeSessionStorage;

// Create a new session storage instance
$sessionStorage = new NativeSessionStorage();
```

## Use Cases

The `SessionStorage` library offers the following methods to interact with PHP sessions:

### 1. Check if a key exists in the session:

```php
if ($sessionStorage->has('user_id')) {
    // Do something with the user_id
}
```

### 2. Get the value of a session key:

```php
$userName = $sessionStorage->get('username', 'Guest');
// If the 'username' key exists in the session, $userName will be set to its value,
// otherwise, it will be set to 'Guest'.
```

### 3. Set a value in the session:

```php
$userId = 123;
$sessionStorage->put('user_id', $userId);
```

### 4. Remove a key from the session:

```php
$sessionStorage->remove('user_id');
```

### 5. Get all session data as an array:

```php
$allData = $sessionStorage->all();
```

## Interface Implementation

The NativeSessionStorage class implements the SessionStorageInterface, which extends the ArrayAccess interface. As a result, any class implementing the SessionStorageInterface should also implement the methods defined in the ArrayAccess interface. Here's how you can implement the SessionStorageInterface in a custom class:
```php
use DevCoder\Session\Storage\SessionStorageInterface;

class MyCustomSessionStorage implements SessionStorageInterface
{
    private array $storage;

    public function __construct()
    {
        // Initialize your custom storage mechanism here
        // For example, you could use a database, Redis, or any other storage solution.
        // In this example, we will use an array as a simple custom storage mechanism.
        $this->storage = [];
    }

    public function get(string $key, $default = null)
    {
        return $this->storage[$key] ?? $default;
    }

    public function put(string $key, $value = null): void
    {
        $this->storage[$key] = $value;
    }

    public function all(): array
    {
        return $this->storage;
    }

    public function has(string $key): bool
    {
        return isset($this->storage[$key]);
    }

    public function remove(string $key): void
    {
        unset($this->storage[$key]);
    }

    // Implementing ArrayAccess methods

    public function offsetExists($offset): bool
    {
        return isset($this->storage[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value): void
    {
        $this->put($offset, $value);
    }

    public function offsetUnset($offset): void
    {
        $this->remove($offset);
    }
}
```

In this example, we create a custom session storage class `MyCustomSessionStorage`, which implements the `SessionStorageInterface`. It uses a simple array to store session data, but you can replace this with any custom storage mechanism like a database, Redis, etc., depending on your specific use case.

## Conclusion

The `SessionStorage` library simplifies working with PHP sessions by providing a clean and easy-to-use interface. It is well-suited for applications that need to manage session data efficiently. Feel free to explore the library's source code and contribute to its development on GitHub.
