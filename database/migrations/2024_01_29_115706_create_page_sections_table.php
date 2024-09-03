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
        Schema::create('page_sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('section_title')->nullable();
            $table->string('section_nickname')->nullable();
            $table->string('custom_class')->nullable();
            $table->string('default_section_classes')->nullable();
            $table->longText('section')->nullable();
            $table->integer('order')->nullable();
            $table->boolean('published')->default(0)->nullable();
            $table->boolean('use_editor')->default(0)->nullable();
            $table->longText('ps_cdn_css')->nullable();
            $table->longText('ps_cdn_js')->nullable();
            $table->longText('ps_js')->nullable();
            $table->longText('ps_css')->nullable();
            $table->integer('select_crud_section')->default(0)->nullable();
            $table->boolean('use_crud_section')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};
