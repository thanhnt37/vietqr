<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogActivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_actives', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('business_id');
            $table->unsignedInteger('product_id')->nullable();
            $table->unsignedInteger('agency_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('code_id');
            $table->unsignedTinyInteger('type')->comment('0 = app, 1 = sms');
            $table->timestamp('time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_actives');
    }
}
