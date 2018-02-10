<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sms_id')->nullable();
            $table->string('partnerid')->nullable();
            $table->string('moid')->nullable();
            $table->string('mtid')->nullable();
            $table->string('userid')->nullable();
            $table->string('shortcode')->nullable();
            $table->string('keyword')->nullable();
            $table->string('content')->nullable();
            $table->string('messagetype')->nullable();
            $table->string('transdate')->nullable();
            $table->string('checksum')->nullable();
            $table->string('amount')->nullable();
            $table->string('response')->nullable();
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
        Schema::dropIfExists('mts');
    }
}
