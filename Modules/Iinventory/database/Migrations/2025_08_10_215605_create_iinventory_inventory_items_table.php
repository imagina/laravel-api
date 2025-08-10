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
    Schema::create('iinventory__inventory_items', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      // Your fields...
      $table->unsignedInteger('inventory_id');
      $table->integer('entity_id');
      $table->string('entity_type');
      $table->integer('quantity');
      // Foreign keys
      $table->foreign('inventory_id')->references('id')->on('iinventory__inventories')->onDelete('cascade');
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
    Schema::table('iinventory__inventory_items', function (Blueprint $table) {
      $table->dropForeign(['inventory_id']);
    });
    Schema::dropIfExists('iinventory__inventory_items');
  }
};
