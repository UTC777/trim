<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContentPagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('content_pages')->delete();
        
        \DB::table('content_pages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'published' => 1,
                'title' => 'How It Works',
                'page_text' => NULL,
            'excerpt' => 'Semaglutide (GLP-1 weight loss medication) is a new FDA-approved, prescribed, and custom-blended drug that promises lasting results. Learn how it works here!',
                'slug' => 'how-it-works',
                'created_at' => '2024-01-29 21:53:08',
                'updated_at' => '2024-01-29 21:55:24',
                'deleted_at' => NULL,
                'nickname' => 'how-it-works',
                'sub_title' => NULL,
                'path' => NULL,
                'add_to_sitemap' => 1,
                'custom_css' => NULL,
                'use_rev_slider' => 0,
                'use_textonly_header' => 0,
                'show_title' => 1,
                'show_tagline' => 1,
                'show_featured_content' => 1,
                'use_svg_header' => 0,
                'use_featured_image_header' => 0,
                'featured_image_content' => NULL,
                'svg_masthead' => NULL,
                'title_style' => NULL,
                'tagline_style' => NULL,
                'fi_content_style' => NULL,
                'meta_title' => 'How GLP-1 Weight Loss Medication Works',
            'meta_description' => 'Semaglutide (GLP-1 weight loss medication) is a new FDA-approved, prescribed, and custom-blended drug that promises lasting results. Learn how it works here!',
                'facebook_title' => NULL,
                'facebook_description' => NULL,
                'twitter_title' => NULL,
                'twitter_description' => NULL,
                'path2' => NULL,
                'path3' => NULL,
                'path4' => NULL,
                'path_segments' => 0,
                'is_homepage' => 0,
            ),
        ));
        
        
    }
}