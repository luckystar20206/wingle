<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id("order_no")->autoIncrement();
            $table->integer("order_id");
            $table->string("payment_id");
            $table->integer("uid");
            $table->string("pname");
            $table->string("category");
            $table->string("qty");
            $table->string("rent_period");
            $table->string("address");
            $table->integer("cart_total");
            $table->timestamp("ordered_at");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
