<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question_title')->nullable();
            $table->text('question')->nullable();
            $table->boolean('status_public')->default('0');
            $table->integer('asker_id')->unsigned();
            $table->timestamps();

        });
        Schema::table('questions', function($table) {
            $table->foreign('asker_id')->references('id')->on('askers')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
