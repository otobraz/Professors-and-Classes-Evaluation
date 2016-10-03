<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_survey', function (Blueprint $table) {
            $table->integer('section_id')->unsigned();
            $table->integer('survey_id')->unsigned();

            $table->primary(['section_id', 'survey_id']);

            $table->foreign('section_id')->references('id')->on('sections');
            $table->foreign('survey_id')->references('id')->on('surveys');

            $table->timestamp('updated_at');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('section_survey');
    }
}