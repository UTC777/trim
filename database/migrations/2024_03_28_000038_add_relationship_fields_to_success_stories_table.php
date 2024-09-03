<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSuccessStoriesTable extends Migration
{
    public function up()
    {
        Schema::table('success_stories', function (Blueprint $table) {
            $table->unsignedBigInteger('story_category_id')->nullable();
            $table->foreign('story_category_id', 'story_category_fk_9641868')->references('id')->on('story_categories');
        });
    }
}
