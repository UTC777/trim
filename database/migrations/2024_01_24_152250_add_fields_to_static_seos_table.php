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
        Schema::table('static_seos', function (Blueprint $table) {
            $table->string('html_classes')->nullable();
            $table->string('body_classes')->nullable();
            $table->string('main_classes')->nullable();
            $table->string('footer_classes')->nullable();
            $table->boolean('meta_title_check')->default(0)->nullable();
            $table->boolean('meta_desc_check')->default(0)->nullable();
            $table->boolean('facebook_title_check')->default(0)->nullable();
            $table->boolean('facebook_desc_check')->default(0)->nullable();
            $table->boolean('twitter_title_check')->default(0)->nullable();
            $table->boolean('twitter_desc_check')->default(0)->nullable();
        });
    }
};
