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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('instagram_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('email')->nullable();
            $table->longText('opening_hours')->nullable();
        });
    }
};
