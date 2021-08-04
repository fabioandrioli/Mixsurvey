<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title',150);
            $table->string('slug',250);
            $table->string('description',150)->nullable();
            $table->boolean('Spotlight')->default(false);
            $table->softDeletes();
            $table->bigInteger('views')->default(0);
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
            $table->timestamps();
        });

        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('title',150);
            $table->string('slug',250);
            $table->string('description',150)->nullable();
            $table->string('image',150)->nullable();
            $table->date('start_date');
            $table->date('finish_date');
            $table->boolean('status')->default(true);
            $table->boolean('spotlight')->default(false);
            $table->boolean('inSession')->default(false);
            $table->boolean('capa')->default(false);
            $table->bigInteger('views')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');

        });

        Schema::create('survey_user', function (Blueprint $table) {
            $table->increments('id');

            $table->bigInteger('survey_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            $table->foreign('survey_id')
                  ->references('id')
                  ->on('surveys')->onDelete('cascade');

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
        Schema::dropIfExists('surveys');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('survey_user');
    }
}
