<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratable', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('rating');
            $table->foreignId('comment_id')->constrained('comments');
            $table->foreignId('user_id')->constrained('users');
            $table->morphs('rateable');
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
        Schema::dropIfExists('rates');
    }
};
