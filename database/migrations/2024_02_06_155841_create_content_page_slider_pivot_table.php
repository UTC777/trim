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
        Schema::create('content_page_slider', function (Blueprint $table) {
            $table->unsignedBigInteger('content_page_id');
            $table->foreign('content_page_id', 'content_page_id_fk_940430005')->references('id')->on('content_pages')->onDelete('cascade');
            $table->unsignedBigInteger('slider_id');
            $table->foreign('slider_id', 'slider_id_fk_940430005')->references('id')->on('sliders')->onDelete('cascade');
        });
    }
};
