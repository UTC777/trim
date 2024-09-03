<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use Wecodelaravel\Menu\Facades\Menu;
//use Wecodelaravel\Menu\Models\MenuItems;
//use Wecodelaravel\Menu\Models\Menus;
use App\Models\Menus;
use App\Models\MenuItems;
use App\Models\Post;
use App\Models\ContentPage;
use App\Models\Product;
use App\Models\StaticSeo;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $env = \App::environment();

            $top_sections='';
            $bottom_sections='';

            $pagename=\Route::current()->getName();

            if ($pagename=='home') {
                $top_sections=Cache::remember('home_top_sections', 60*60*24, function () {
                    return ContentPage::where('slug','home')->first()->pagesFrontContentSections;
                });
                $bottom_sections=Cache::remember('home_bottom_sections', 60*60*24, function () {
                    return ContentPage::where('slug','home')->first()->pagesFrontContentSections;
                });
            } elseif ($pagename=='page.show') {
                $pageData=ContentPage::where('slug',request()->route('pageslug'))->first();
                if ($pageData) {
                    $top_sections=$pageData->pagesFrontContentSections;
                    $bottom_sections=$pageData->pagesFrontContentSections;
                }
            }

            $staticpageseo = StaticSeo::where('page_path',request()->path())->orderBy('id','DESC')->first();

//            $main_menu = Menu::getByName('Main Menu');
//            $footer_menu = Menu::getByName('Footer Widget Menu');
//            $footer_links = Menu::getByName('Footer Links');
//            $copywright_menu = Menu::getByName('Copyright Menu');
//            $blog_menu = Menu::getByName('Blog Sidebar Menu');
//            $products_menu = Menu::getByName('Products Sidebar Menu');

            $main_menu = Cache::remember('main_menu', now()->addDay(), function () {
                return Menu::getByName('Main Menu');
            });

            $footer_menu = Cache::remember('footer_menu', now()->addDay(), function () {
                return Menu::getByName('Footer Widget Menu');
            });

            $footer_links = Cache::remember('footer_links', now()->addDay(), function () {
                return Menu::getByName('Footer Links');
            });

            $copywright_menu = Cache::remember('copywright_menu', now()->addDay(), function () {
                return Menu::getByName('Copyright Menu');
            });

            $blog_menu = Cache::remember('blog_menu', now()->addDay(), function () {
                return Menu::getByName('Blog Sidebar Menu');
            });

            $products_menu = Cache::remember('products_menu', now()->addDay(), function () {
                return Menu::getByName('Products Sidebar Menu');
            });

            $menuposts = Post::all();
            $menuLandingPages = ContentPage::all();
            $menuProducts = Product::all();
            $setting = Setting::orderBy('id','DESC')->first();

            View::share('env', $env);
            View::share('main_menu', $main_menu);
            View::share('footer_menu', $footer_menu);
            View::share('footer_links', $footer_links);
            View::share('copywright_menu', $copywright_menu);
            View::share('blog_menu', $blog_menu);
            View::share('products_menu', $products_menu);

            View::share('menuposts', $menuposts);
            View::share('menuLandingPages', $menuLandingPages);
            View::share('menuProducts', $menuProducts);

            View::share('staticpageseo', $staticpageseo);
            View::share('top_sections', $top_sections);
            View::share('bottom_sections', $bottom_sections);

            View::share('setting', $setting);

            return $next($request);
        });
    }
}
