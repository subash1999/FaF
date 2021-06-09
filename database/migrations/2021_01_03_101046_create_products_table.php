<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->double("price");
            $table->double("discount")->nullable()->default(0.0);
            $table->string("discount_description")->nullable();
            $table->integer("quantity_available");
            $table->integer("quantity_sold")->nullable();
            $table->text("description")->nullable();
            $table->foreignId("product_category_id")
                ->onDelete('set null')
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
        Schema::dropIfExists('products');
    }
}
