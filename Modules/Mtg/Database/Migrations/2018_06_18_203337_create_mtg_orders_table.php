<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMtgOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtg_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone_number');
            $table->string('email');
            $table->string('add_line_1');
            $table->string('add_line_2')->nullable();
            $table->string('add_line_3')->nullable();
            $table->string('city');
            $table->string('county')->nullable();
            $table->string('postcode');
            $table->string('country')->default('GB');
            $table->text('note')->nullable();
            $table->float('shipping_cost')->default(0);
            $table->float('handling_cost')->default(0);
            $table->float('discount')->default(0);
            $table->float('vat_percentage')->default(0);
            $table->boolean('paid')->default(0);
            $table->string('stripe_ref')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('mtg_orders');
    }
}
