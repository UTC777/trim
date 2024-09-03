<?php

namespace App\Models;

use Wecodelaravel\Menu\Models\Menus as VendorMenu;
use Illuminate\Support\Facades\Cache;

class Menu extends VendorMenu
{
    protected static function booted()
    {
        static::saved(function ($menu) {
            Cache::forget('main_menu');
            Cache::forget('footer_menu');
            Cache::forget('footer_links');
            Cache::forget('copywright_menu');
            Cache::forget('blog_menu');
            Cache::forget('products_menu');
        });

        static::deleted(function ($menu) {
            Cache::forget('main_menu');
            Cache::forget('footer_menu');
            Cache::forget('footer_links');
            Cache::forget('copywright_menu');
            Cache::forget('blog_menu');
            Cache::forget('products_menu');
        });
    }
}
