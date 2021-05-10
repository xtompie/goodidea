<?php

namespace App\Core;

interface NativeInterface
{
    public static function fromNative(mixed $native): static;
    public function toNative(): mixed;
}
