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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            // $table->unsignedBigInteger('event_category_id');
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('body');
            $table->integer('price');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('location')->nullable();
            $table->integer('views')->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('event_category_id')->references('id')->on('event_categories');
            // $table->foreign('profile_id')->references('id')->on('profiles');
            $table->softDeletes();
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
        Schema::dropIfExists('events');
        Schema::disableForeignKeyConstraints();
        Schema::enableForeignKeyConstraints();
    }
};
