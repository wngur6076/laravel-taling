<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    const THUMB_IMG_PATH = 'uploads/product/';

    public static function thumbImgPath()
    {
        return self::THUMB_IMG_PATH . date('Y/m/d');
    }

    public function productReals()
    {
        return $this->hasMany(ProductReal::class)
            ->orderBy('stock_quantity', 'desc');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function isFavorited()
    {
        return $this->favorites()->where('user_id', optional(Auth::user())->id)->count() > 0;
    }

    public static function findBySerialNumber($serialNumber)
    {
        return self::where('serial_number', $serialNumber)->firstOrFail();
    }

    public function getColorsAttribute()
    {
        return self::productReals()->get()->map(fn ($productReal) => $productReal->rgb_color)
            ->reduce(function ($html, $rgbColor) {
                return $html . "<span><span style='width:10px; height:10px; display:inline-block; border-radius:50%; margin:0 3px; background-color:#{$rgbColor};'></span></span>";
            }, '');
    }

    public function colors()
    {
        return self::productReals()->get()->map(fn ($productReal) => $productReal->rgb_color);
    }

    public function getSalePriceInWonsAttribute()
    {
        return number_format($this->sale_price);
    }

    public function getPriceInWonsAttribute()
    {
        return number_format($this->price);
    }

    public function getProductAtAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function thumbnailUrl()
    {
        return Storage::disk('public')->url($this->thumb_img_path);
    }
}
