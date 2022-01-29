<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('title')->nullable();
            $table->string('path');
            $table->jsonb('files');
            $table->string('cover');
            $table->string('slug');
            $table->string('author')->nullable();
            $table->string('writer')->nullable();
            $table->string('publisher')->nullable();
            $table->json('genre')->nullable();
            $table->integer('pages');
            $table->integer('download');
            $table->integer('read');
            $table->integer('num_book')->nullable();
            $table->text('description')->nullable();
            $table->boolean('publish')->default(0);
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
        Schema::dropIfExists('books');
    }
}
