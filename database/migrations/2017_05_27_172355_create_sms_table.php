<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('partnerid')->nullable();
            $table->string('moid')->nullable();
            $table->string('userid')->nullable();
            $table->string('shortcode')->nullable();
            $table->string('telcocode')->nullable();
            $table->string('keyword')->nullable();
            $table->string('content')->nullable();
            $table->string('transdate')->nullable();
            $table->string('checksum')->nullable();
            $table->string('amount')->nullable();
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
        Schema::dropIfExists('sms');
    }
}
