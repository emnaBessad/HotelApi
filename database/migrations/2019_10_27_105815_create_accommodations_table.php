<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('rating');
            $table->enum('category', ['hotel', 'alternative', 'hostel', 'lodge', 'resort', 'guest-house'] );
            $table->bigInteger('location_id')->unsigned();
            $table->foreign('location_id')
                ->references('id')->on('locations')
                ->onDelete('cascade');
            $table->string('image');
            $table->integer('reputation');
            $table->integer('price');
            $table->integer('availability');
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
        Schema::dropIfExists('accommodations');
    }
}
