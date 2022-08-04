<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id');
            $table->foreignId('user_id')->constrained('users','id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('title');
            $table->longText('body');
            $table->text('sample');
            $table->text('slug');
            $table->string('ImageRec')->default('blogPic.png');
            $table->bigInteger('like')->default(0);
            $table->bigInteger('dislike')->default(0);
            $table->unsignedBigInteger('countUser');
            $table->enum('pinBlog',[0,1])->comment('0 is no pin');
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
        Schema::dropIfExists('blogs');
    }
}
