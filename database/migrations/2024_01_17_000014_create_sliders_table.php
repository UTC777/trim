<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('location')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('main_title')->nullable();
            $table->string('sub_title_2')->nullable();
            $table->string('slider_description')->nullable();
            $table->string('text_heading')->nullable();
            $table->string('heading_1')->nullable();
            $table->string('heading_2')->nullable();
            $table->string('heading_3')->nullable();
            $table->string('text')->nullable();
            $table->string('main_button_text')->nullable();
            $table->string('main_button_link')->nullable();
            $table->integer('main_button_tab_index')->nullable();
            $table->string('second_button_text')->nullable();
            $table->string('second_button_link')->nullable();
            $table->integer('second_button_tab_index')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
