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
        Schema::create('inotification__devices', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your fields...
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('iuser__users')->onDelete('restrict');

            $table->string("device")->nullable();
            $table->string("token");

            $table->integer('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on("inotification__providers")->onDelete('restrict');

            // Audit fields
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('inotification__devices');
    }
};
