<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Prospect extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospects', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable()->default(null);
            $table->string("tel")->nullable()->default(null);
            $table->string("parent_name")->nullable()->default(null);
            $table->string("parent_tel")->nullable()->default(null);
            $table->string("program")->nullable()->default(null);
            $table->string("considering_intake")->nullable()->default(null);
            $table->string("currentstatus")->nullable()->default(null);
            $table->string("source")->nullable()->default(null);
            // $table->string("funding")->nullable()->default(null);
            $table->text("notes")->nullable()->default(null);
            // $table->foreignId("programme_id")->references('id')->on('programmes')->nullable()->default(null);
            // $table->foreignId("academic_term_id")->references('id')->on('academicterms')->nullable()->default(null);
            $table->string("status")
                ->comment("0:prospect,1:application in process,2:offer later receive,3:accept,4:reject,5:complete")->nullable()->default(null);
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
