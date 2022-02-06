<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOneMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('one__movies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->references('id')->on('movies')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('download_link');
            $table->enum('rating',[1,2,3,4,5]);
            $table->enum('quality',[0,1,2,3]);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('one__movies');
    }
}
