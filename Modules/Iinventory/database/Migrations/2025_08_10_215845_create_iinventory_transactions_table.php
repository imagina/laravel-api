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
    Schema::create('iinventory__transactions', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      // Your fields...
      $table->unsignedInteger('from_inventory_id')->nullable();
      $table->unsignedInteger('to_inventory_id')->nullable();
      $table->integer('quantity');
      $table->unsignedInteger('item_id');
      $table->text('comments')->nullable();
      // Foreign keys
      $table->foreign('from_inventory_id')->references('id')->on('iinventory__inventories')->onDelete('cascade');
      $table->foreign('to_inventory_id')->references('id')->on('iinventory__inventories')->onDelete('cascade');
      $table->foreign('item_id')->references('id')->on('iinventory__inventory_items')->onDelete('cascade');
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
    Schema::table('iinventory__transactions', function (Blueprint $table) {
      $table->dropForeign(['from_inventory_id']);
      $table->dropForeign(['to_inventory_id']);
      $table->dropForeign(['item_id']);
    });
    Schema::dropIfExists('iinventory__transactions');
  }
};
