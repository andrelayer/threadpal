<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider');
            $table->integer('user_id')->unsigned();
            $table->string('social_id');
            $table->string('token');
            $table->timestamp('token_updated_at')->nullable();
            $table->timestamp('token_expires_at')->nullable();
            $table->timestamps();


        });

        Schema::table('connections', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('connections');
    }
}
