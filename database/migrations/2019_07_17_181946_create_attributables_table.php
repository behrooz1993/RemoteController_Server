<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttributablesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributables', function (Blueprint $table) {
            $table->integer('attribute_id')->unsigned()->default(0);
            $table->integer('attributable_id')->unsigned()->default(0);
            $table->string('attributable_type', 255);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('attribute_id')->references('id')->on('attributes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attributables');
    }
}
