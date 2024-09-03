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
        Schema::table('faq_questions', function (Blueprint $table) {
            $table->boolean('published')->default(0)->nullable();
            $table->boolean('use_html_asnwer')->default(0)->nullable();
            $table->longText('html_answer')->nullable();
            $table->string('youtube_video_id_only')->nullable();
            $table->string('video_button_text')->nullable();
            $table->string('read_more_link')->nullable();
            $table->string('read_more_button_text')->nullable();
        });
    }
};
