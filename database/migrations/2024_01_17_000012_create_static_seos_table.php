<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaticSeosTable extends Migration
{
    public function up()
    {
        Schema::create('static_seos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('deactivate_update')->default(0)->nullable();
            $table->string('page_name')->nullable();
            $table->string('page_path')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('facebook_title')->nullable();
            $table->string('twitter_title')->nullable();
            $table->string('content_type')->nullable();
            $table->longText('json_ld_tag')->nullable();
            $table->boolean('canonical')->default(0)->nullable();
            $table->string('html_schema_1')->nullable();
            $table->string('html_schema_2')->nullable();
            $table->string('html_schema_3')->nullable();
            $table->string('body_schema')->nullable();
            $table->longText('facebook_description')->nullable();
            $table->longText('twitter_description')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('open_graph_type')->nullable();
            $table->string('menu_name')->nullable();
            $table->string('seo_image_url')->nullable();
            $table->boolean('noindex')->default(0)->nullable();
            $table->boolean('nofollow')->default(0)->nullable();
            $table->boolean('noimageindex')->default(0)->nullable();
            $table->boolean('noarchive')->default(0)->nullable();
            $table->boolean('nosnippet')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
