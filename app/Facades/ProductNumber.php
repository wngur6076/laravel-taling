<?php

namespace App\Facades;

use App\Models\NumberGenerator\ProductNumberGenerator;
use Illuminate\Support\Facades\Facade;

class ProductNumber extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ProductNumberGenerator::class;
    }
}
