<?php

namespace App\Models;

use Wecodelaravel\Menu\Models\MenuItems as VendorMenuItem;
use Illuminate\Support\Facades\Cache;

class MenuItem extends VendorMenuItem
{
    protected static function booted()
    {
        static::saved(function ($menuItem) {
            Cache::forget('main_menu');
            Cache::forget('footer_menu');
            Cache::forget('footer_links');
            Cache::forget('copywright_menu');
            Cache::forget('blog_menu');
            Cache::forget('products_menu');
        });

        static::deleted(function ($menuItem) {
            Cache::forget('main_menu');
            Cache::forget('footer_menu');
            Cache::forget('footer_links');
            Cache::forget('copywright_menu');
            Cache::forget('blog_menu');
            Cache::forget('products_menu');
        });
    }
}
