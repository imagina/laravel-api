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

        /**
         * BASIC TABLE
         */
        Schema::create('iuser__users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->json('permissions')->nullable();
            $table->timestamp('last_login')->nullable();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->boolean('is_guest')->default(false);

            $table->timestamps();
        });

        /**
         * BASIC TABLE
         */
        Schema::create('iuser__password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        /**
         * BASIC TABLE
         */
        Schema::create('iuser__sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('iuser__users');
        Schema::dropIfExists('iuser__password_reset_tokens');
        Schema::dropIfExists('iuser__sessions');
    }
};
