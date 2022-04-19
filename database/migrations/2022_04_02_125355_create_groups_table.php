<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('group_name');
            $table->string('group_url')->nullable();
            $table->string('district', 120);
            $table->string('address', 500)->nullable();
            $table->foreignId('state_id')->constrained()->nullable();
            $table->boolean('is_main')->default(false);
            $table->integer('group_thumbnail')->unsigned()->nullable();
            $table->foreign('group_thumbnail')->references('id')->on('attachments')->nullOnDelete();
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
        Schema::dropIfExists('groups');
    }
}
