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
        Schema::create('ilocations__city_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');

            $table->integer('city_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['city_id', 'locale']);
            $table->foreign('city_id')->references('id')->on('ilocations__cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('ilocations__city_translations', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
        });
        Schema::dropIfExists('ilocations__city_translations');
    }
};
