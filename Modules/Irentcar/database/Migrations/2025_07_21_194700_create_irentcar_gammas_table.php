<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irentcar__gammas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your fields...
            $table->string('title');
            $table->text('summary')->nullable();
            $table->text('description');
            $table->tinyInteger('transmission_type')->default(0)->unsigned();
            $table->integer('passengers_number')->unsigned();
            $table->integer('luggages')->unsigned();
            $table->integer('doors')->unsigned();
            $table->tinyInteger('fuel_type')->default(0)->unsigned();
            $table->tinyInteger('vehicle_type')->default(0)->unsigned();

            $table->integer('next_gamma_id')->unsigned()->nullable();
            $table->foreign('next_gamma_id')->references('id')->on('irentcar__gammas')->onDelete('restrict');

            $table->json('options')->nullable();

            // Audit fields
            $table->timestamps();
            $table->auditStamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('irentcar__gammas');
    }
};
