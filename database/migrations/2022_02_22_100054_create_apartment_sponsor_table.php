<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentSponsorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_sponsor', function (Blueprint $table) {
            $table->unsignedBigInteger('apartment_id')->nullable();
            $table->unsignedBigInteger('sponsor_id')->nullable();
            $table->foreign('apartment_id')->references('id')->on('apartments')->cascadeOnDelete();
            $table->foreign('sponsor_id')->references('id')->on('sponsors')->cascadeOnDelete();
            $table->date('start_date');
            $table->date('end_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartment_sponsor');
    }
}
