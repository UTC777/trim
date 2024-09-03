<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Models\Product;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Spatie\Crawler\Crawler;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Sitemap as TagSitemap;
use Spatie\Sitemap\Tags\Url;
use Wecodelaravel\Menu\Facades\Menu;
use Wecodelaravel\Menu\Models\MenuItems;
use Wecodelaravel\Menu\Models\Menus;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically Generate an XML Sitemap';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (app()->environment()) {
            ini_set('memory_limit', '-1');
            $take = 50000;
            $skip = 0;
            $group = floor(Product::count() / $take);

            $sitemapIndex = SitemapIndex::create();

            for ($i = 0; $i <= $group; $i++) {
                $sitemap = Sitemap::create();
                $products = Product::orderBy('id', 'asc')->skip($skip)->take($take)->where('published', 1)->get();
                foreach ($products as $product) {
                    $sitemap->add(Url::create('products/'.$product->slug)->setLastModificationDate($product->updated_at));
                }
                if (! empty($products)) {
                    $this->info('Generated Products SiteMap');
                    $filename = 'sitemap-products.xml';
                    $sitemap->writeToFile(public_path($filename));
                    $sitemapIndex->add(TagSitemap::create('/'.$filename)->setLastModificationDate(Carbon::yesterday()));
                }
                $skip = $skip + $take;
            }

            $group = floor(Post::count() / $take);

            for ($i = 0; $i <= $group; $i++) {
                $sitemap = Sitemap::create();
                $posts = Post::orderBy('id', 'desc')->where('published', 1)->get();
                foreach ($posts as $post) {
                    $sitemap->add(Url::create('blogs/'.$post->slug)->setLastModificationDate($post->updated_at));
                }
                if (! empty($posts)) {
                    $this->info('Generated Posts SiteMap');
                    $filename = 'sitemap-posts.xml';
                    $sitemap->writeToFile(public_path($filename));
                    $sitemapIndex->add(TagSitemap::create('/'.$filename)->setLastModificationDate(Carbon::yesterday()));
                }
                $skip = $skip + $take;
            }

            $group = floor(MenuItems::count() / $take);

            for ($i = 0; $i <= $group; $i++) {
                $sitemap = Sitemap::create();
                // $menu_links = MenuItems::whereNot('link', '#')->whereNot('link', 'LIKE', '%http%')->where('production', 1)->get();
                $menu_links = MenuItems::whereNot('link', '#')->whereNot('link', 'LIKE', '%http%')->get();
                foreach ($menu_links as $link) {
                    $sitemap->add(Url::create($link->link)->setLastModificationDate($link->updated_at ? $link->updated_at : now()));
                }
                if (! empty($menu_links)) {
                    $this->info('Generated Menu Page Links to SiteMap');
                    $filename = 'sitemap-pages.xml';
                    $sitemap->writeToFile(public_path($filename));
                    $sitemapIndex->add(TagSitemap::create('/'.$filename)->setLastModificationDate(Carbon::yesterday()));
                }
                $skip = $skip + $take;
            }

            $this->info('Generated Site map Index');

            $sitemapIndex->writeToFile(public_path('sitemap-index.xml'));

            $this->info('Finished');

            return 'done';
        } else {
            $this->info('Sitemap Generator only Runs on Production');
        }
    }
}
