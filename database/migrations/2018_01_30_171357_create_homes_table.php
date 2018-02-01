<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatehomesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('ip');
            $table->text('status');
            $table->text('type');
            $table->text('version');
            $table->integer('freq');
            $table->text('elapsed');
            $table->float('hash_rate_5s');
            $table->float('hash_rate_avg');
            $table->integer('hw');
            $table->text('hwp');
            $table->text('temp');
            $table->text('fan');
            $table->text('pool1');
            $table->text('worker1');
            $table->text('pool2');
            $table->text('worker2');
            $table->text('pool3');
            $table->text('worker3');
            $table->text('dummy');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('homes');
    }
}
