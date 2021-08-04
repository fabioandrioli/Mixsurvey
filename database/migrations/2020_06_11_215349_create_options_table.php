<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();

            $table->string('title',150);
            $table->string('description',150)->nullable();
            $table->string('image',150)->nullable();
            $table->bigInteger('votes')->nullable();
            $table->bigInteger('survey_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('survey_id')
                  ->references('id')
                  ->on('surveys');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options');
    }
}
