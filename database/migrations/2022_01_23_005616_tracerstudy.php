<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tracerstudy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracerstudystudent', function (Blueprint $table) {
            $table->id();
            $table->integer("alumnis_id")->nullable()->default(null);

            $table->string("study_status")->nullable()->default(null);
            $table->string("current_address")->nullable()->default(null);
            $table->string("phone_no")->nullable()->default(null);
            $table->json("employer_info")->nullable()->default(null);
            $table->json("working_info")->nullable()->default(null);
            $table->string("salary")->nullable()->default(null);
            $table->string("futher_study")->nullable()->default(null);

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
        //
    }
}
