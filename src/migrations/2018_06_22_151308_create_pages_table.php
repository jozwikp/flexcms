<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path')->unique();

            $table->string('title');
            $table->string('description')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('tags')->nullable();

            $table->text('content')->nullable();
            $table->string('img')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_published')->default(0);

            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('user_id')->on('authors');

            $table->integer('list_id')->unsigned()->nullable();
            $table->foreign('list_id')->references('id')->on('lists');

            $table->string('template')->default('default');

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
        Schema::dropIfExists('pages');
    }
}
