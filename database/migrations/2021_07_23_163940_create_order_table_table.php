<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_table', function (Blueprint $table) {
            $table->integer('order_table_id', true);
            $table->integer('total');
            $table->integer('total_taxin');
            $table->text('last_name');
            $table->text('first_name');
            $table->text('mail');
            $table->text('tel');
            $table->text('zip');
            $table->text('address1');
            $table->timestamp('ins_date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_table');
    }
}
