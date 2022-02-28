<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Students extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            // $table->foreignId("student_profile_id")->nullable()->default(null)->references('id')->on('studentprofiles');
            // $table->foreignId("programme_id")->nullable()->default(null)->references('id')->on('programmes');
            // $table->foreignId("institution_id")->nullable()->default(null)->references('id')->on('institution');
            // $table->foreignId("academic_term_id")->nullable()->default(null)->references('id')->on('academicterms');
            // $table->foreignId("campus_id")->nullable()->default(null)->references('id')->on('campuses');
             $table->foreignId("student_profile_id")->nullable()->default(null);
            $table->foreignId("programme_id")->nullable()->default(null);
            $table->foreignId("institution_id")->nullable()->default(null);
            $table->foreignId("academic_term_id")->nullable()->default(null);
            $table->foreignId("campus_id")->nullable()->default(null);
            $table->integer('status')->nullable()->default(null);
            $table->year('year')->nullable()->default(null);

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
