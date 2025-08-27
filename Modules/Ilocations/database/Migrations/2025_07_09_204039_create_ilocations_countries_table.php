<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('ilocations__countries', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('status')->default('1');
            $table->string('currency')->default('')->nullable();
            $table->text('currency_symbol')->nullable();
            $table->text('currency_code')->nullable();
            $table->text('currency_sub_unit')->nullable();
            $table->text('region_code')->nullable();
            $table->text('sub_region_code')->nullable();
            $table->integer('country_code')->unsigned();
            $table->text('iso_2')->nullable();
            $table->text('iso_3')->nullable();
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
    public function down(): void
    {
        Schema::dropIfExists('ilocations__countries');
    }
};
