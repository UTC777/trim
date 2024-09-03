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
            $table->longText('facebook_description')->nullable()->change();
            $table->longText('twitter_description')->nullable()->change();
            $table->longText('meta_description')->nullable()->change();
        });
    }
};
