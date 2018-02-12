<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTbCustomerDevicesTable extends Migration
{
    public function up()
    {
        Schema::table('tb_customer_devices', function($table) {
            $table->dropColumn('price');
        });
    }

    public function down()
    {
        Schema::table('tb_customer_devices', function($table) {
            $table->integer('price');
        });
    }
}
