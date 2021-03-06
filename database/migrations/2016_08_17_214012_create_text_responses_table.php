<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextResponsesTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('respostas_abertas', function (Blueprint $table) {
         $table->increments('id');
         $table->text('resposta');
         $table->integer('pergunta_id')->unsigned();
         $table->integer('resposta_id')->unsigned();

         $table->unique( ['pergunta_id', 'resposta_id']);

         $table->foreign('resposta_id')->references('id')->on('respostas');
         $table->foreign('pergunta_id')->references('id')->on('perguntas');

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
      Schema::drop('respostas_abertas');
   }
}
