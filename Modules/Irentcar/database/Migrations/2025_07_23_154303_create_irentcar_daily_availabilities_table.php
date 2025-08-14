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
        Schema::create('irentcar__daily_availabilities', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your fields...
            $table->integer('gamma_office_id')->unsigned();
            $table->foreign('gamma_office_id')->references('id')->on('irentcar__gamma_office')->onDelete('restrict');

            $table->integer('quantity')->default(0)->unsigned();
            $table->decimal('price', 15, 2)->nullable();
            $table->timestamp('date');
            $table->text('reason')->nullable();
            $table->integer('reserved_quantity')->default(0)->unsigned();

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
        Schema::dropIfExists('irentcar__daily_availabilities');
    }
};
