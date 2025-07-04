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
        Schema::create('inotification__notifications', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your fields...
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('type')->nullable();
            $table->string('icon_class');
            $table->string('link')->nullable();
            $table->string('title');
            $table->text('message');
            $table->string('provider')->nullable();
            $table->string('recipient')->nullable();
            $table->boolean('is_read')->default(false);
            $table->boolean('is_action')->nullable();
            $table->string('source')->nullable();
            $table->json('options')->nullable();

            $table->foreign('user_id')->references('id')->on('iuser__users')->onDelete('cascade');

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
        Schema::dropIfExists('inotification__notifications');
    }
};
