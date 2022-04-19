<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('book_name');
            $table->string('book_description', 500)->nullable();
            $table->boolean('is_redirect')->default(false);
            $table->string('book_url')->nullable();
            $table->integer('book_pdf')->unsigned()->nullable();
            $table->foreign('book_pdf')->references('id')->on('attachments')->nullOnDelete();
            $table->integer('book_thumbnail')->unsigned()->nullable();
            $table->foreign('book_thumbnail')->references('id')->on('attachments')->nullOnDelete();
            $table->foreignId('category_id')->constrained('categories');
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
        Schema::dropIfExists('books');
    }
}
