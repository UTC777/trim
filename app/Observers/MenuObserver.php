<?php

namespace App\Observers;

use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Cache;
//use Wecodelaravel\Menu\Models\Menus;

use App\Models\Menu;

class MenuObserver implements ShouldHandleEventsAfterCommit
{
    public function saved($menu)
    {
        Cache::forget('main_menu');
        Cache::forget('footer_menu');
        Cache::forget('footer_links');
        Cache::forget('copywright_menu');
        Cache::forget('blog_menu');
        Cache::forget('products_menu');
    }

    public function deleted($menu)
    {
        Cache::forget('main_menu');
        Cache::forget('footer_menu');
        Cache::forget('footer_links');
        Cache::forget('copywright_menu');
        Cache::forget('blog_menu');
        Cache::forget('products_menu');
    }
}
