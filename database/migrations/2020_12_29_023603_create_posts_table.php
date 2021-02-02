<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('content')->nullable();
            $table->json('json_content')->nullable();
            $table->text('searchable_content')->nullable();
            $table->unsignedBigInteger('activity_id');//social activity
            $table->unsignedBigInteger('customer_id');
            $table->json('tag_followers')->nullable();
            $table->string('location')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
