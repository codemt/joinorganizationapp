<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('salutation','10');
            $table->string('f_name');
            $table->string('l_name')->nullable();
            $table->string('m_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('gender','10')->nullable();
            $table->date('dob')->nullable();
            $table->string('marital_status')->nullable();
            $table->date('dom')->nullable();
            $table->string('contact','20')->nullable();
            $table->string('alt_contact','20')->nullable();
            $table->string('tel','20')->nullable();
            $table->string('email')->nullable();
            $table->string('alt_email')->nullable();
            $table->string('blood_group','5')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            $table->text('alt_address')->nullable();
            $table->string('alt_city')->nullable();
            $table->string('alt_pincode')->nullable();
            $table->string('khanp')->nullable();
            $table->string('up_khanp')->nullable();
            $table->string('occupation')->nullable();
            $table->string('member_type')->nullable();
            $table->string('member_code')->nullable();
            $table->text('company_details')->nullable();
            $table->string('qualification')->nullable();
            $table->text('native_address')->nullable();
            $table->string('dist')->nullable();
            $table->string('native_pincode')->nullable();
            $table->string('profile_photo')->nullable();
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
        Schema::dropIfExists('members');
    }
}
