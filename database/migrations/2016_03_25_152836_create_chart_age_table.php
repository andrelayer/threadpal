<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartAgeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_age', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('report_id')->unsigned();
            $table->integer('13 to 19');
            $table->integer('20 to 24');
            $table->integer('25 to 29');
            $table->integer('30 to 34');
            $table->integer('35 to 39');
            $table->integer('40 to 44');
            $table->integer('45 to 49');
            $table->integer('50 to 54');
            $table->integer('55 to 59');
            $table->integer('60 to 64');
            $table->integer('65 and older');
            $table->integer('total');
            $table->timestamps();

            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('chart_age');
    }
}
