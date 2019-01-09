<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObituariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obituaries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('photo')->nullable();
            $table->unsignedInteger('member_id')->nullable();
            $table->date('birth_date')->nullable();
            $table->date('died_on')->nullable();
            $table->date('obituary_date')->nullable();
            $table->text('description')->nullable();
            $table->text('description_one')->nullable();
            $table->text('description_two')->nullable();
            $table->text('description_three')->nullable();
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
        Schema::dropIfExists('obituaries');
    }
}
