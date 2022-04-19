<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtamaLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utama_layouts', function (Blueprint $table) {
            $table->id();
            $table->string('Utama Page');
            $table->string('utama')->unique();
            $table->integer('imsak_pdf')->unsigned()->nullable();
            $table->foreign('imsak_pdf')->references('id')->on('attachments')->nullOnDelete();
            $table->bigInteger('ebook_outsource')->nullable();
            $table->bigInteger('ebook_abim')->nullable();
            $table->bigInteger('infaq_main')->nullable();
            $table->bigInteger('kssb_main')->nullable();
            $table->bigInteger('kssb_exception')->nullable();
            $table->string('tanwir_gallery')->nullable();
            $table->string('hadis_hijau_gallery')->nullable();
            $table->string('projek_ramadan_gallery')->nullable();
            $table->string('kssb_gallery')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('utama_layouts');
    }
}
