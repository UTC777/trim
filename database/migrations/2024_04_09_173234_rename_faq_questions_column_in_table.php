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
            $table->renameColumn('use_html_asnwer', 'use_html_answer');
        });
    }
};
