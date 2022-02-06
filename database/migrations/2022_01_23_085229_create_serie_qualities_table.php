<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerieQualitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serie_qualities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('serie_id')->references('id')->on('series')->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('quality',[0,1,2,3]);
            $table->string('download_link');
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
        Schema::dropIfExists('serie_qualities');
    }
}
