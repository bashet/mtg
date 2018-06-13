<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMtgCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtg_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('front')->nullable();
            $table->string('back')->nullable();
            $table->string('rarity')->nullable();
            $table->string('artist')->nullable();
            $table->string('cardBorder')->nullable();
            $table->string('cardColourIdentity')->nullable();
            $table->string('cardColours')->nullable();
            $table->longText('cardFlavour')->nullable();
            $table->string('cardId')->nullable();
            $table->string('cardLayout')->nullable();
            $table->string('cardLoyalty')->nullable();
            $table->string('cardManaCost')->nullable();
            $table->string('cardMultiverseId')->nullable();
            $table->string('cardName')->nullable();
            $table->string('cardNames')->nullable();
            $table->string('cardNumber')->nullable();
            $table->longText('cardOriginalText')->nullable();
            $table->string('cardPower')->nullable();
            $table->longText('cardPrintings')->nullable();
            $table->string('cardReleaseDate')->nullable();
            $table->string('cardSet')->nullable();
            $table->string('cardSetName')->nullable();
            $table->string('cardSubTypes')->nullable();
            $table->string('cardSuperTypes')->nullable();
            $table->longText('cardText')->nullable();
            $table->string('cardToughness')->nullable();
            $table->string('cardType')->nullable();
            $table->string('cardTypes')->nullable();
            $table->string('cardVariations')->nullable();
            $table->string('cardWatermark')->nullable();
            $table->boolean('cardIsReserved')->default(0);
            $table->boolean('cardIsStarter')->default(0);
            $table->boolean('cardIsTimeshifted')->default(0);
            $table->boolean('isToken')->default(0);
            $table->float('cardPrice')->default(0);
            $table->bigInteger('qty')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mtg_cards');
    }
}
