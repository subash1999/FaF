<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->nullable()
                ->constrained();
            $table->foreignId("product_id")
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->nullable()
                ->constrained();
            $table->double("price");
            $table->integer("quantity");
            $table->double("discount")->nullable()->default(0.0);
            $table->double("discount_description")->nullable();
            $table->string("order_status")->nullable();
            $table->foreignId('bill_id')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->nullable()
                ->constrained();
            $table->foreignId('shipping_id')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->nullable()
                ->constrained();
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
        Schema::dropIfExists('orders');
    }
}
