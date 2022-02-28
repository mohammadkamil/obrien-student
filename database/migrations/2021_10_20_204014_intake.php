<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Intake extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intake', function (Blueprint $table) {
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
            $table->string("name")->nullable()->default(null);
            $table->string("contact_no")->nullable()->default(null);
            $table->integer("address_parent")->nullable()->default(null);
            $table->string("email")->nullable()->default(null);
            $table->foreignId("programme_id")->nullable()->default(null);
            $table->foreignId("institution_id")->nullable()->default(null);
            $table->foreignId("academic_term_id")->nullable()->default(null);
            $table->foreignId("campus_id")->nullable()->default(null);
            $table->year('year')->nullable()->default(null);

                        $table->string("status")
                ->comment("1:application in process,2:offer later receive,3:accept,4:reject,5:complete")->nullable()->default(null);
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
