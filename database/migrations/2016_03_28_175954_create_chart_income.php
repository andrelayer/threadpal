<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartIncome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_income', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('report_id')->unsigned();
            $table->integer('30K to 40K');
            $table->integer('40K to 50K');
            $table->integer('50K to 75K');
            $table->integer('75K to 100K');
            $table->integer('100K to 125K');
            $table->integer('125K to 150K');
            $table->integer('150K to 250K');
            $table->integer('250K to 350K');
            $table->integer('350K to 500K');
            $table->integer('Over 500K');
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
        Schema::drop('chart_income');
    }
}
