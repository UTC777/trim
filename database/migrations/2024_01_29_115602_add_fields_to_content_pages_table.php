<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('content_pages', function (Blueprint $table) {
            $table->string('nickname')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('path')->nullable();
            $table->boolean('add_to_sitemap')->default(0)->nullable();
            $table->longText('custom_css')->nullable();
            $table->boolean('use_rev_slider')->default(0)->nullable();
            $table->boolean('use_textonly_header')->default(0)->nullable();
            $table->boolean('show_title')->default(0)->nullable();
            $table->boolean('show_tagline')->default(0)->nullable();
            $table->boolean('show_featured_content')->default(0)->nullable();
            $table->boolean('use_svg_header')->default(0)->nullable();
            $table->boolean('use_featured_image_header')->default(0)->nullable();
            $table->text('featured_image_content')->nullable();
            $table->text('svg_masthead')->nullable();
            $table->string('title_style')->nullable();
            $table->string('tagline_style')->nullable();
            $table->string('fi_content_style')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('facebook_title')->nullable();
            $table->string('facebook_description')->nullable();
            $table->string('twitter_title')->nullable();
            $table->string('twitter_description')->nullable();
            $table->string('path2')->nullable();
            $table->string('path3')->nullable();
            $table->string('path4')->nullable();
            $table->integer('path_segments')->default(1);
            $table->boolean('is_homepage')->default(0)->nullable();
        });
    }
};
