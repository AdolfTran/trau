<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('address')->nullable()->after('role');
            $table->string('phonenumber')->after('address');
            $table->string('date')->after('phonenumber');
            $table->string('salary')->nullable()->after('date');
            $table->string('day_work')->nullable()->after('salary');
            $table->string('over_time')->nullable()->after('day_work');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
