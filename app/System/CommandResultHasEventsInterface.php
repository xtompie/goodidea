<?php

namespace App\System;

interface CommandResultHasEventsInterface
{
    public function events(): array;
}