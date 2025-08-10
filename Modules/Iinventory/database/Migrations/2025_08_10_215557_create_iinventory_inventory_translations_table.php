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
    Schema::create('iinventory__inventory_translations', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      // Your translatable fields
      $table->string('title')->nullable();
      $table->integer('inventory_id')->unsigned();
      $table->string('locale')->index();
      $table->unique(['inventory_id', 'locale']);
      $table->foreign('inventory_id')->references('id')->on('iinventory__inventories')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('iinventory__inventory_translations', function (Blueprint $table) {
      $table->dropForeign(['inventory_id']);
    });
    Schema::dropIfExists('iinventory__inventory_translations');
  }
};
