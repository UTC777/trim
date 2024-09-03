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
        Schema::table('success_stories', function (Blueprint $table) {
            $table->boolean('use_before_after')->default(0)->nullable();
            $table->boolean('use_combined')->default(0)->nullable();
            $table->string('slug')->nullable();
        });
    }
};
