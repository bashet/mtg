<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMtgCondiionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtg_condiions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('grade');
            $table->string('name');
            $table->longText('description');
            $table->string('frontimage');
            $table->string('backimage');
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
        Schema::dropIfExists('mtg_condiions');
    }
}
