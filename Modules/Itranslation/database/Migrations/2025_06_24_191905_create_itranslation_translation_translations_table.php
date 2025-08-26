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
        Schema::create('itranslation__translation_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->text('value');

            $table->integer('translation_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['translation_id', 'locale'], 'itrans_transl_transls_trans_id_locale_unique');
            $table->foreign('translation_id')->references('id')->on('itranslation__translations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('itranslation__translation_translations', function (Blueprint $table) {
            $table->dropForeign(['translation_id']);
        });
        Schema::dropIfExists('itranslation__translation_translations');
    }
};
