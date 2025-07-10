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
        Schema::create('iblog__categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('parent_id')->nullable()->default(null);
            $table->tinyInteger('status')->default(1)->unsigned();
            $table->tinyInteger('show_menu')->default(0)->unsigned();
            $table->boolean('featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->json('options')->nullable();
            $table->string('external_id')->nullable();
            $table->boolean('internal')->default(false);

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
        Schema::dropIfExists('iblog__categories');
    }
};
