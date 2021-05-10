<?php

namespace App\Core;

use ReflectionClass;

class NativeCoder
{
    public static function encode(NativeInterface $object): string
    {
        return json_encode([
            'class' => $object::class,
            'native' => $object->toNative(),
        ]);
    }

    public static function decode(string $encode): object|null 
    {
        $value = json_decode($encode);
        if (!$value) {
            return null;
        }

        /** @var NativeInterface $class */
        $class = $value->class;
        if (!(new ReflectionClass($class))->implementsInterface(NativeInterface::class)) {
            return null;
        }

        return $class::fromNative($value->native);
    }
}