<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sruveyanswered extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveyanswered', function (Blueprint $table) {
            $table->id();
            $table->integer("alumnis_id")->nullable()->default(null);
            $table->integer("subject_id")->nullable()->default(null);

            $table->json("answer")->nullable()->default(null);


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
