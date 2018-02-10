<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('product_id')->nullable();
            $table->unsignedInteger('guarantee_days')->default(0);
            $table->unsignedInteger('business_id');
            $table->unsignedTinyInteger('generate_code_status')->default(0);
            $table->longText('metadata');
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
        Schema::dropIfExists('batches');
    }
}
