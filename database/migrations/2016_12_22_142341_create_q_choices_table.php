<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_choices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->unsigned()->index();
                $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->string('text');
            $table->boolean('correct')->default(0);
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
        Schema::dropIfExists('q_choices');
    }
}
