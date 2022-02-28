<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academicterms', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable()->default(null);
            $table->date("start_date")->nullable()->default(null);
            $table->date("end_date")->nullable()->default(null);
            $table->integer("status")->comment("0- not active,1- active")->nullable()->default(null);
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
        Schema::dropIfExists('academic_terms');
    }
}
