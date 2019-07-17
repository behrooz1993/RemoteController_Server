<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttributesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attribute_group_id')->unsigned()->default(0);
            $table->string('name', 200);
            $table->integer('permisson');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('attribute_group_id')->references('id')->on('attribute_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attributes');
    }
}
