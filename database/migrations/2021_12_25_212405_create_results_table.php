<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->integer('event')->nullable();
            $table->date('event_date')->nullable();
            $table->integer('w1')->nullable();
            $table->integer('w2')->nullable();
            $table->integer('w3')->nullable();
            $table->integer('w4')->nullable();
            $table->integer('w5')->nullable();
            $table->integer('wtotal')->nullable();
            $table->string('m1')->nullable();
            $table->string('m2')->nullable();
            $table->string('m3')->nullable();
            $table->string('m4')->nullable();
            $table->string('m5')->nullable();
            $table->integer('mtotal')->nullable();
            $table->bigInteger('game_id')->unsigned();
            $table->timestamps();

            $table->foreign('game_id')->references('id')->on('lotteries')
            ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
