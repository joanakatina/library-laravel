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
            $table->id('id');
            $table->string('title', 100);
            $table->string('isbn', 13);
            $table->year('year')->unsigned();
            $table->unsignedSmallInteger('pages');
            $table->unsignedTinyInteger('quantity');
            $table->unsignedDecimal('price', 8, 2);
            $table->string('cover');
            $table->foreignId('publisher_id');
            $table->foreignId('genre_id');
            $table->timestamps();

            $table->foreign('publisher_id')->references('id')->on('publishers');
            $table->foreign('genre_id')->references('id')->on('genres');
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
