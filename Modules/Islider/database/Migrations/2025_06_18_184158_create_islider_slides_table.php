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
        Schema::create('islider__slides', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('slider_id')->unsigned();
            $table->foreign('slider_id')->references('id')->on('islider__sliders')->onDelete('cascade');
            $table->integer('page_id')->unsigned()->nullable();
            $table->integer('position')->unsigned()->default(0);
            $table->string('target', 10)->nullable();
            $table->json('options')->nullable();
            $table->text('external_image_url')->nullable();
            $table->string('type')->default('')->nullable();
            $table->integer('responsive')->default(1);

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
        Schema::dropIfExists('islider__slides');
    }
};
