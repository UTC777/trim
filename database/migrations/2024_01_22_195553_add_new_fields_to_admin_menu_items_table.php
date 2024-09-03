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
        Schema::table('admin_menu_items', function (Blueprint $table) {
            $table->boolean('local')->default(1)->nullable();
            $table->boolean('development')->default(1)->nullable();
            $table->boolean('stage')->default(0)->nullable();
            $table->boolean('production')->default(0)->nullable();
            $table->boolean('marketing')->default(0)->nullable();
            $table->boolean('logged_in_only')->default(0)->nullable();
            $table->boolean('icon_only_menu')->default(0)->nullable();
            $table->string('link')->nullable()->change();
            $table->string('menu_icon_class')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_menu_items', function (Blueprint $table) {
            $table->dropColumn('local');
            $table->dropColumn('development');
            $table->dropColumn('stage');
            $table->dropColumn('production');
            $table->dropColumn('marketing')->default(0)->nullable();
            $table->dropColumn('logged_in_only')->default(0)->nullable();
            $table->dropColumn('icon_only_menu')->default(0)->nullable();
            $table->dropColumn('menu_icon_class')->nullable();
        });
    }
};
