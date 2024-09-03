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
        Schema::create('user_admin_menu_item', function (Blueprint $table) {
            $table->unsignedBigInteger('admin_menu_item_id');
            $table->foreign('admin_menu_item_id', 'admin_menu_item_id_fk_233187511')->references('id')->on('admin_menu_items')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_233187511')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
