<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider');
            $table->string('token');
            $table->timestamps();
        });

        DB::table('tokens')->insert(
            array(
                array(
                    'provider' => 'facebook',
                    'token' => 'CAAGAck4T3RoBACYa1gPuepXpEclWXYQOZB0OKmvcxNRdv1Xl8Q5FUtRmRmMgMNtSBxBtzIgGFsWXQumf1vqcj35yoVlfzRZCZAbpYXZAZCZAQ4yzbXdfuhLJAXo0B7qR7bigT0ZCKj6kSIZBjlRiUbdNBQwmFjZAjr7x00yiJFZBNtwgldIeVzYzaE'
                ),

            ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tokens');
    }
}
