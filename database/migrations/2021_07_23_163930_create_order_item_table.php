<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item', function (Blueprint $table) {
            $table->integer('order_table_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->integer('tax_rate');
            $table->integer('price');
            $table->integer('price_total');
            $table->integer('price_taxin');
            $table->integer('price_total_taxin');
            $table->primary(['order_table_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_item');
    }
}
