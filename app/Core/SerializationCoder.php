<?php

namespace App\Core;

use ReflectionClass;

class SerializationCoder
{
    public static function encode(SerializationInterface $object): string
    {
        return $object::class . ':' . $object->toSerialization();
    }

    public static function decode(string $coder): object|null 
    {
        list($class, $archive) = explode(':', $coder);
        if (!(new ReflectionClass($class))->implementsInterface(SerializationInterface::class)) {
            return null;
        }
        /** @var SerializationInterface $class */
        return $class::fromSerialization($archive);
    }
}
