<?php

namespace App\Traits;

trait AsJsonTrait
{
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}