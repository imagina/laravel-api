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
        Schema::create('ilocations__countries', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('status')->default('1');
            $table->string('currency')->default('')->nullable();
            $table->text('currency_symbol')->default('')->nullable();
            $table->text('currency_code')->default('')->nullable();
            $table->text('currency_sub_unit')->default('')->nullable();
            $table->text('region_code')->default('')->nullable();
            $table->text('sub_region_code')->default('')->nullable();
            $table->integer('country_code')->unsigned();
            $table->text('iso_2')->default('')->nullable();
            $table->text('iso_3')->default('')->nullable();
            $table->integer('calling_code')->unsigned();

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
        Schema::dropIfExists('ilocations__countries');
    }
};
