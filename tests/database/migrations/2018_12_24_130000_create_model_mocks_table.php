<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelMocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_mocks', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('region_id')->unsigned();
			$table->foreign('region_id')->references('id')->on('regions')->onDelete('RESTRICT');

			$table->integer('municipality_id')->unsigned();
            $table->foreign('municipality_id')->references('id')->on('municipalities')->onDelete('RESTRICT');
            
            $table->integer('municipality_district_id')->unsigned();
			$table->foreign('municipality_district_id')->references('id')->on('municipality_districts')->onDelete('RESTRICT');

			$table->integer('community_id')->unsigned();
			$table->foreign('community_id')->references('id')->on('communities')->onDelete('RESTRICT');
 
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
        Schema::dropIfExists('model_mocks');
    }

}
