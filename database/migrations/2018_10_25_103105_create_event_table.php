<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->mediumText('regions');
            $table->mediumText('samiti');
            $table->mediumText('sponsorship');
            $table->mediumText('description');
            $table->mediumText('timing');
            $table->string('featured_image');
            $table->mediumText('category');
            $table->mediumText('interested');
            $table->string('venue_id');
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
        Schema::dropIfExists('event');
    }
}
