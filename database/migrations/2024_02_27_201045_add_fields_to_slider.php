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
        Schema::table('sliders', function (Blueprint $table) {
            $table->string('sub_title_css')->nullable();
            $table->string('main_title_css')->nullable();
            $table->string('sub_title_2_css')->nullable();
            $table->string('slider_description_css')->nullable();
            $table->string('text_heading_css')->nullable();
            $table->string('heading_1_css')->nullable();
            $table->string('heading_2_css')->nullable();
            $table->string('heading_3_css')->nullable();
            $table->string('text_css')->nullable();
            $table->string('main_button_css')->nullable();
            $table->string('second_button_css')->nullable();
        });
    }
};
