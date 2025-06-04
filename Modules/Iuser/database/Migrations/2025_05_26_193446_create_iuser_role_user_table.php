<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('iuser__role_user', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('iuser__users')->onDelete('cascade');
            $table->unsignedInteger('role_id');
            $table->foreign('role_id')->references('id')->on('iuser__roles')->onDelete('cascade');

            $table->primary(['user_id', 'role_id']);

            $table->nullableTimestamps();

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iuser__role_user');
    }

};
