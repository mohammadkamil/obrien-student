<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string("address1")->nullable()->default(null);
            $table->string("address2")->nullable()->default(null);
            $table->string("address3")->nullable()->default(null);
            $table->string("city")->nullable()->default(null);
            $table->string("state")->nullable()->default(null);
            $table->string("country")->nullable()->default(null);
            $table->string("postcode")->nullable()->default(null);
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
        Schema::dropIfExists('addresses');
    }
}
