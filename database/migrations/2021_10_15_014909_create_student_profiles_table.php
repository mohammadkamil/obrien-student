<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentprofiles', function (Blueprint $table) {
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
        Schema::dropIfExists('student_profiles');
    }
}
