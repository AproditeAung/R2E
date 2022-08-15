<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->constrained('blogs','id')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('report_blogs');
    }
}
