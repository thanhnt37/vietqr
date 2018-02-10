<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_times', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('business_id');
            $table->date('date');
            $table->unsignedInteger('activated_count')->default(0);
            $table->unsignedInteger('guarantee_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_times');
    }
}
