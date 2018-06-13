<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMtgCardSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtg_card_sets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('block')->nullable();
            $table->string('border')->nullable();
            $table->string('code')->nullable();
            $table->string('gathererCode')->nullable();
            $table->string('infoCode')->nullable();
            $table->string('name')->nullable();
            $table->string('oldCode')->nullable();
            $table->boolean('onlineOnly')->default(0);
            $table->string('releaseDate')->nullable();
            $table->string('type')->nullable();
            $table->bigInteger('cardCount')->nullable();
            $table->bigInteger('CommonCount')->nullable();
            $table->bigInteger('UnCommonCount')->nullable();
            $table->bigInteger('RareCount')->nullable();
            $table->bigInteger('MythicCount')->nullable();
            $table->bigInteger('BasicLandCount')->nullable();
            $table->bigInteger('SpecialCount')->nullable();
            $table->bigInteger('TokenCount')->nullable();
            $table->float('cardSetPrice')->default(0);
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
        Schema::dropIfExists('mtg_card_sets');
    }
}
