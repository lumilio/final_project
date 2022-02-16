<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->text('description')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->integer('n_rooms')->nullable();
            $table->integer('n_bathroom')->nullable();
            $table->integer('n_bed')->nullable();
            $table->integer('square_meters')->nullable();
            $table->decimal('latitude', 11, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->boolean('visibility')->default(true);
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
        Schema::dropIfExists('apartments');
    }
}
