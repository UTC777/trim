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
        Schema::create('role_admin_menu_item', function (Blueprint $table) {
            $table->unsignedBigInteger('admin_menu_item_id');
            $table->foreign('admin_menu_item_id', 'admin_menu_item_id_fk_233187500')->references('id')->on('admin_menu_items')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_233187500')->references('id')->on('roles')->onDelete('cascade');
        });
    }
};
