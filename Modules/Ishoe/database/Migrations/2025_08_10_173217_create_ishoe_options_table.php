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
    Schema::create('ishoe__options', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      // Your fields...
      $table->float('price')->default(0)->unsigned();
      $table->integer('parent_id')->default(0)->unsigned();
      $table->integer('pieces')->default(0)->unsigned();
      $table->boolean('need_cutting')->default(0)->unsigned();
      $table->boolean('is_editable')->default(0)->unsigned();
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
    Schema::dropIfExists('ishoe__options');
  }
};
