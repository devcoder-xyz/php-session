<?php

declare(strict_types=1);

namespace DevCoder\Session\Storage;

use function session_start;
use function session_status;
use const PHP_SESSION_NONE;

class NativeSessionStorage implements SessionStorageInterface
{
    private array $storage;
    public function __construct(array $options = [])
    {
        if (session_status() === PHP_SESSION_NONE) {
            if (!session_start($options)) {
                throw new \RuntimeException('Failed to start the session.');
            }
        }

        $this->storage = &$_SESSION;
    }

    public function offsetExists($offset): bool
    {
        return isset($this->storage[$offset]);
    }

    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset)) {
            return $this->storage[$offset];
        }
        return null;
    }

    public function offsetSet($offset, $value): self
    {
        $this->storage[$offset] = $value;
        return $this;
    }

    public function offsetUnset($offset): void
    {
        if ($this->offsetExists($offset)) {
            unset($this->storage[$offset]);
        }
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return $this->offsetGet($key) ?: $default;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function put(string $key, $value = null): void
    {
        $this->offsetSet($key, $value);
    }

    public function all(): array
    {
        return $this->storage;
    }

    public function has(string $key): bool
    {
        return $this->offsetExists($key);
    }

    public function remove(string $key): void
    {
        $this->offsetUnset($key);
    }
}
