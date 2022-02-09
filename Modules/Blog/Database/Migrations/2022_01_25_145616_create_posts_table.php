<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->longText('content');
            $table->timestamp('published_at')->nullable();
            $table->integer('user_id');
            $table->timestamps();
            //category: use 'many to many' relationship
            //tag: use spatie tag
            //image: use spatie media
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
