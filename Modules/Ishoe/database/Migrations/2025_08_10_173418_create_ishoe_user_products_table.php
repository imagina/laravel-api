<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('ishoe__user_products', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      // Your translatable fields
      $table->integer('shoe_id')->unsigned();
      $table->integer('user_id')->unsigned();
      $table->float('price')->unsigned()->default(0);
      $table->unique(['shoe_id', 'user_id']);

      $table->foreign('shoe_id')->references('id')->on('ishoe__shoes')->onDelete('restrict');
      $table->foreign('user_id')->references('id')->on('iuser__users')->onDelete('restrict');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('ishoe__user_products', function (Blueprint $table) {
      $table->dropForeign(['shoe_id']);
      $table->dropForeign(['user_id']);
    });
    Schema::dropIfExists('ishoe__user_products');
  }
};
