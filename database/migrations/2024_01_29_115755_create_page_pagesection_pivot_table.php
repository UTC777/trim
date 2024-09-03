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
        Schema::create('page_pagesection', function (Blueprint $table) {
            $table->unsignedBigInteger('pagesection_id');
            $table->foreign('pagesection_id', 'pagesection_id_fk_564984812')->references('id')->on('page_sections')->onDelete('cascade');
            $table->unsignedBigInteger('page_id');
            $table->foreign('page_id', 'page_id_fk_564984812')->references('id')->on('content_pages')->onDelete('cascade');
        });
    }
};
