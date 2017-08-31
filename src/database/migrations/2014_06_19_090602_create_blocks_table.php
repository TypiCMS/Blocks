<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return null
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->json('status');
            $table->json('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return null
     */
    public function down()
    {
        Schema::drop('blocks');
    }
}
