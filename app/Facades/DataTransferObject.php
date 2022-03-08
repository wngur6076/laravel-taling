<?php

namespace App\Facades;

use App\Models\DataTransferObjectMapper\DataTransferObjectMapper;
use Illuminate\Support\Facades\Facade;

class DataTransferObject extends Facade
{
    protected static function getFacadeAccessor()
    {
        return DataTransferObjectMapper::class;
    }
}
