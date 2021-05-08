<?php

namespace App\Core\Command;

interface CommandPublishesEvents
{
    public function events(): array;
}