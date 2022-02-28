<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examresults', function (Blueprint $table) {
            $table->id();
            $table->foreignId("student_id")->references('id')->on('students')->nullable()->default(null);
            $table->foreignId("academic_term_id")->references('id')->on('academicterms')->nullable()->default(null);
            $table->foreignId("subject_id")->references('id')->on('subjects')->nullable()->default(null);
            $table->string("mark");
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
        Schema::dropIfExists('exam_results');
    }
}
