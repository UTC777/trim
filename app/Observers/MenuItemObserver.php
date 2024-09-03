<?php

namespace App\Observers;

use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Cache;
//use Wecodelaravel\Menu\Models\MenuItems;
use App\Models\MenuItem;
class MenuItemObserver implements ShouldHandleEventsAfterCommit
{
    public function saved($menuItem)
    {
        Cache::forget('main_menu');
        Cache::forget('footer_menu');
        Cache::forget('footer_links');
        Cache::forget('copywright_menu');
        Cache::forget('blog_menu');
        Cache::forget('products_menu');
    }

    public function deleted($menuItem)
    {
        Cache::forget('main_menu');
        Cache::forget('footer_menu');
        Cache::forget('footer_links');
        Cache::forget('copywright_menu');
        Cache::forget('blog_menu');
        Cache::forget('products_menu');
    }
}
