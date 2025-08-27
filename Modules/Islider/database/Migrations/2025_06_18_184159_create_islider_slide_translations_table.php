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
        Schema::create('islider__slide_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('caption')->nullable();
            $table->string('url')->nullable();
            $table->string('uri')->nullable();
            $table->text('code_ads')->nullable();
            $table->boolean('active')->default(false);
            $table->text('summary')->nullable();
            $table->text('custom_html')->nullable();

            $table->integer('slide_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['slide_id', 'locale']);
            $table->foreign('slide_id')->references('id')->on('islider__slides')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('islider__slide_translations', function (Blueprint $table) {
            $table->dropForeign(['slide_id']);
        });
        Schema::dropIfExists('islider__slide_translations');
    }
};
