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
        Schema::create('irentcar__gamma_office_extra', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your fields...
            $table->integer('gamma_office_id')->unsigned();
            $table->foreign('gamma_office_id')->references('id')->on('irentcar__gamma_office')->onDelete('restrict');

            $table->integer('extra_id')->unsigned();
            $table->foreign('extra_id')->references('id')->on('irentcar__extras')->onDelete('restrict');

            $table->decimal('price', 15, 2)->default(0);

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
        Schema::dropIfExists('irentcar__gamma_office_extra');
    }
};
