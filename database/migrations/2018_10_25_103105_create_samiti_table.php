<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSamitiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samiti', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('samiti_year');
            $table->integer('valid_till');
            $table->mediumText('regions');
            $table->mediumText('admin_id');
            $table->mediumText('members');
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
        Schema::dropIfExists('samiti');
    }
}
