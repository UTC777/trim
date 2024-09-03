<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('instagram')->nullable();
            $table->string('github')->nullable();
            $table->string('google_map_link')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode')->nullable();
            $table->longText('long_bio')->nullable();
            $table->string('additional_social_link')->nullable();
            $table->string('additional_social_link_icon')->nullable();
            $table->string('additional_social_link_2')->nullable();
            $table->string('additional_social_link_icon_2')->nullable();
        });
    }
};
