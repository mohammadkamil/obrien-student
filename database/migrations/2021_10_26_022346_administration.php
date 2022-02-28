<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Administration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administration', function (Blueprint $table) {
            $table->id();
           $table->integer("student_id")->nullable()->default(null)->references('id')->on('student');
           $table->string("vaccine_type")->nullable()->default(null);
           $table->string("second_dose")->nullable()->default(null);
           $table->integer("address_id")->nullable()->default(null)->references('id')->on('address');
           $table->string("flight_routing")->nullable()->default(null);
           $table->date("date_arrival")->nullable()->default(null);
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
