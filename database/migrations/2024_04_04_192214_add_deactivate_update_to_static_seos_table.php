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
        Schema::table('static_seos', function (Blueprint $table) {
            // Check if the column already exists before adding it
            if (!Schema::hasColumn('static_seos', 'deactivate_update')) {
                Schema::table('static_seos', function (Blueprint $table) {
                    $table->boolean('deactivate_update')->default(0)->nullable();
                });
            }
        });
    }
};
