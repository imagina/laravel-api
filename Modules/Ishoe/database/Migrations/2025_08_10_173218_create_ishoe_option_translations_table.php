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
    Schema::create('ishoe__option_translations', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      // Your translatable fields
      $table->string('title');

      $table->integer('option_id')->unsigned();
      $table->string('locale')->index();
      $table->unique(['option_id', 'locale']);
      $table->foreign('option_id')->references('id')->on('ishoe__options')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('ishoe__option_translations', function (Blueprint $table) {
      $table->dropForeign(['option_id']);
    });
    Schema::dropIfExists('ishoe__option_translations');
  }
};
