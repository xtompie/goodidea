<?php

namespace App\Core;

interface SerializationInterface
{
    public static function fromSerialization(string $serialization): static;
    public function toSerialization(): string;
}
