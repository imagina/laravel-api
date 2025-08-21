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
        Schema::create('irentcar__reservations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your fields...
            $table->timestamp('pickup_date');
            $table->timestamp('dropoff_date');

            $table->integer('pickup_office_id')->unsigned();
            $table->foreign('pickup_office_id')->references('id')->on('irentcar__offices')->onDelete('restrict');

            $table->integer('dropoff_office_id')->unsigned();
            $table->foreign('dropoff_office_id')->references('id')->on('irentcar__offices')->onDelete('restrict');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on(config('auth.table', 'users'))->onDelete('restrict');

            $table->integer('gamma_id')->unsigned();
            $table->foreign('gamma_id')->references('id')->on('irentcar__gammas')->onDelete('restrict');

            $table->integer('gamma_office_id')->unsigned();
            $table->foreign('gamma_office_id')->references('id')->on('irentcar__gamma_office')->onDelete('restrict');

            $table->json('gamma_office_extra_ids')->nullable();

            $table->json('gamma_data');
            $table->json('extras_data')->nullable();

            $table->decimal('gamma_office_price', 15, 2)->default(0);
            $table->decimal('gamma_office_extra_total_price', 15, 2)->default(0);
            $table->decimal('total_price', 15, 2)->default(0);

            $table->tinyInteger('status')->default(1)->unsigned();

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
        Schema::dropIfExists('irentcar__reservations');
    }
};
