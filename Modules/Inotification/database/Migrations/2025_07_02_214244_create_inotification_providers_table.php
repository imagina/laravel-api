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
        Schema::create('inotification__providers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your fields...
            $table->string('title');
            $table->string('system_name');
            $table->boolean('status')->default(false);
            $table->boolean('default')->default(false);
            $table->string('type')->default('');

            $table->json('options')->nullable();
            $table->json('fields')->nullable();

            // Audit fields
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inotification__providers');
    }
};
