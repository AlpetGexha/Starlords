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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->string('stripe_id');
            $table->string('stripe_token');
            $table->integer('price')->nullable();
            $table->string('date_expire')->nullable();
            $table->string('refund_date_expire')->nullable();
            $table->string('status')->nullable();
            $table->integer('quantity');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('profile_id')->references('id')->on('profiles');
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
        Schema::dropIfExists('tickets');
    }
};
