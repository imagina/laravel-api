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
    Schema::create('ishoe__shoe_options', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      // Your translatable fields
      $table->integer('shoe_id')->unsigned();
      $table->integer('option_id')->unsigned();
      $table->unique(['shoe_id', 'option_id']);

      $table->foreign('shoe_id')->references('id')->on('ishoe__shoes')->onDelete('restrict');
      $table->foreign('option_id')->references('id')->on('ishoe__options')->onDelete('restrict');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('ishoe__shoe_options', function (Blueprint $table) {
      $table->dropForeign(['shoe_id']);
      $table->dropForeign(['option_id']);
    });
    Schema::dropIfExists('ishoe__shoe_options');
  }
};
