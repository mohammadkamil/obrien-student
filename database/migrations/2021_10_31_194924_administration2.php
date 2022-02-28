<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Administration2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administration2', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable()->default(null);
            $table->string("tel")->nullable()->default(null);
            $table->string("ic_no")->nullable()->default(null);
            $table->string("email")->nullable()->default(null);
            $table->string("gander")->nullable()->default(null);
            $table->string("funding")->nullable()->default(null);
            $table->string("student_no")->nullable()->default(null);
            $table->string("fees")->nullable()->default(null);
            $table->string("passport_no")->nullable()->default(null);
            $table->string("parent_name")->nullable()->default(null);
            $table->string("parent_contact_no")->nullable()->default(null);
            $table->string("parent_address")->nullable()->default(null);
            $table->string("parent_email")->nullable()->default(null);
            $table->foreignId("programme_id")->nullable()->default(null);
            $table->foreignId("institution_id")->nullable()->default(null);
            $table->foreignId("academic_term_id")->nullable()->default(null);
            $table->foreignId("campus_id")->nullable()->default(null);
            $table->year('year')->nullable()->default(null);
        //    $table->integer("student_id")->nullable()->default(null)->references('id')->on('student');
           $table->string("vaccine_type")->nullable()->default(null);
           $table->string("second_dose")->nullable()->default(null);
           $table->string("address_iceland")->nullable()->default(null);
           $table->string("flight_routing")->nullable()->default(null);
           $table->date("date_arrival")->nullable()->default(null);
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
