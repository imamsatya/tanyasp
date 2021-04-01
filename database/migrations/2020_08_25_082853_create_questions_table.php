<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            // $table->string('judul');
            $table->string('siapa');
            $table->text('pertanyaan');
            $table->text('jawaban')->nullable();
            $table->string('status');
            $table->timestamps();
        });

          Schema::table('questions', function (Blueprint $table){
            $table->integer('kabupaten_kota_id')->unsigned()->nullable();
            $table->foreign('kabupaten_kota_id')->references('id')->on('kabupatens');
            
        });

          Schema::table('questions', function (Blueprint $table){
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            
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
