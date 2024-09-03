<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceSuccessStoryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('service_success_story', function (Blueprint $table) {
            $table->unsignedBigInteger('success_story_id');
            $table->foreign('success_story_id', 'success_story_id_fk_9446850')->references('id')->on('success_stories')->onDelete('cascade');
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id', 'service_id_fk_9446850')->references('id')->on('services')->onDelete('cascade');
        });
    }
}
