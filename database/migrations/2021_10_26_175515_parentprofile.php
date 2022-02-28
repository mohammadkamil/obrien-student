<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Parentprofile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parentprofile', function (Blueprint $table) {
            $table->id();
           $table->integer("student_id")->nullable()->default(null)->references('id')->on('student');
           $table->string("name")->nullable()->default(null);
           $table->string("contact_no")->nullable()->default(null);
           $table->integer("address_id")->nullable()->default(null)->references('id')->on('address');
           $table->string("email")->nullable()->default(null);
            $table->timestamps();
        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
