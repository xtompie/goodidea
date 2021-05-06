<?php

namespace App\System;

trait Instance
{
    public static function instance(): static
    {
        return new static;
    }
}
