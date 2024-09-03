<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ContentPage;
use App\Models\Post;
use App\Models\Product;
use App\Models\FaqQuestion;
use App\Models\StaticSeo;

class GenerateSeoRecords extends Command
{
    protected $signature = 'seo:generate-records';
    protected $description = 'Generates SEO records for all content items';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Starting to generate SEO records for Content Pages...');
        $contentPages = ContentPage::all();
        foreach ($contentPages as $page) {
            $this->generateOrUpdateSeoRecord($page, 'ContentPage');
        }

        $this->info('Starting to generate SEO records for Posts...');
        $posts = Post::all();
        foreach ($posts as $post) {
            $this->generateOrUpdateSeoRecord($post, 'Post');
        }

        $this->info('Starting to generate SEO records for Products...');
        $products = Product::all();
        foreach ($products as $product) {
            $this->generateOrUpdateSeoRecord($product, 'Product');
        }

        // FAQ handling is commented out for now
        // $this->info('Starting to generate SEO records for FAQs...');
        // $faqs = FaqQuestion::all();
        // foreach ($faqs as $faq) {
        //     $this->generateOrUpdateSeoRecord($faq, 'FaqQuestion');
        // }

        $this->info('SEO records generation completed successfully.');
    }


    protected function generateOrUpdateSeoRecord($item, $type)
    {
        $seoRecord = null;
        $contentTitle = ''; // This will hold the title/name of the content item.

        switch ($type) {
            case 'ContentPage':
                $seoRecord = StaticSeo::where('page_id', $item->id)->firstOrNew([]);
                $seoRecord->page_id = $item->id;
                $seoRecord->content_type = 'custom'; // Or another appropriate type
                $contentTitle = $item->title;
                break;
            case 'Post':
                $seoRecord = StaticSeo::where('post_id', $item->id)->firstOrNew([]);
                $seoRecord->post_id = $item->id;
                $seoRecord->content_type = 'post';
                $contentTitle = $item->title;
                break;
            case 'Product':
                $seoRecord = StaticSeo::where('product_id', $item->id)->firstOrNew([]);
                $seoRecord->product_id = $item->id;
                $seoRecord->content_type = 'product';
                $contentTitle = $item->name;
                break;
            // Uncomment and adjust if handling FAQs
            // case 'FaqQuestion':
            //     $seoRecord = StaticSeo::where('faq_id', $item->id)->firstOrNew([]);
            //     $seoRecord->faq_id = $item->id; // Assuming you have a faq_id column
            //     $seoRecord->content_type = 'faq';
            //     $contentTitle = $item->question;
            //     break;
        }

        if ($seoRecord) {
            // Set common SEO fields
            $seoRecord->meta_title = $contentTitle; // Assuming you want the meta_title to match the content title/name
            $seoRecord->meta_description = $item->excerpt ?? $item->description ?? ''; // Adjust based on your model's fields

            // Specifically update menu_name and page_name for SEO records
            $seoRecord->menu_name = $contentTitle;
            $seoRecord->page_name = $contentTitle;

            $seoRecord->save();
            $this->info("SEO record for {$type} (ID: {$item->id}, Title/Name: {$contentTitle}) updated/created.");
        } else {
            $this->error("Failed to generate or update SEO record for {$type} (ID: {$item->id}).");
        }
    }


}

