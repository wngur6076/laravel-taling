<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReal extends Model
{
    use HasFactory;

    protected $guarded = [];

    const RGB = [
        'red' => 'FF0000', 'green' => '008000', 'blue' => '0000FF',
        'pink' => 'FFC0CB', 'wine' => '722F37', 'black' => '000000',
    ];

    public function getRgbColorAttribute()
    {
        return self::RGB[\Str::lower($this->option_2_name)];
    }

    public function getAddPriceInWonsAttribute()
    {
        return number_format($this->add_price);
    }

}
