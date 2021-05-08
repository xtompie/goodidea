<?php

namespace App\Core;

trait Instance
{
    public static function instance(): static
    {
        return new static;
    }
}
