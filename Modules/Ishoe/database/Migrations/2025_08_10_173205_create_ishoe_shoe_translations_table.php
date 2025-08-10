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
    Schema::create('ishoe__shoe_translations', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      // Your translatable fields
      $table->string('title');

      $table->integer('shoe_id')->unsigned();
      $table->string('locale')->index();
      $table->unique(['shoe_id', 'locale']);
      $table->foreign('shoe_id')->references('id')->on('ishoe__shoes')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('ishoe__shoe_translations', function (Blueprint $table) {
      $table->dropForeign(['shoe_id']);
    });
    Schema::dropIfExists('ishoe__shoe_translations');
  }
};
