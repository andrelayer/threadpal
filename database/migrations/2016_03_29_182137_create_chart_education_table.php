<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_education', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('report_id')->unsigned();
            $table->integer('Some High School');
            $table->integer('In High School');
            $table->integer('High School Grad');
            $table->integer('Some College');
            $table->integer('In College');
            $table->integer('College Graduate');
            $table->integer('Some Grad School');
            $table->integer('In Grad School');
            $table->integer('Master Degree');
            $table->integer('Professional Degree');
            $table->integer('Doctorate Degree');
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
        Schema::drop('chart_education');
    }
}
