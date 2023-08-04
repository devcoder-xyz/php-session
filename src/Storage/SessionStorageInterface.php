<?php

declare(strict_types=1);

namespace DevCoder\Session\Storage;

use ArrayAccess;

interface SessionStorageInterface extends ArrayAccess
{
    public function get(string $key,  $default = null);
    public function put(string $key, $value = null): void;
    public function all(): array;
    public function has(string $key): bool;
    public function remove(string $key): void;
}
