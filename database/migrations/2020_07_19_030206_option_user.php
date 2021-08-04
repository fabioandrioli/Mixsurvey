<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OptionUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_user', function (Blueprint $table) {
            $table->increments('id');

            $table->bigInteger('option_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            $table->foreign('option_id')
                  ->references('id')
                  ->on('options')->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
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
        Schema::dropIfExists('option_user');
    }
}
