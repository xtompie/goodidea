<?php

namespace App\Core\Query;

interface QueryMemoIdentifyInterface
{
    public function memoIdentify(object $query): string;
}
