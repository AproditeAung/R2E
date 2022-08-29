<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportMusicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_music', function (Blueprint $table) {
            $table->id();
            $table->foreignId('music_id')->constrained('music','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('viewers')->default(0);
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
        Schema::dropIfExists('report_music');
    }
}
