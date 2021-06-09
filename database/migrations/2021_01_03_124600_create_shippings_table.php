<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->nullable()
                ->constrained();
            $table->string("name");
            $table->string("street_address1");
            $table->string("street_address2")->nullable();
            $table->string("city");
            $table->string("state");
            $table->string('country');
            $table->string('shipping_status')->nullable();
            $table->string("postal_code")->nullable();
            $table->text("description")->nullable();
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
        Schema::dropIfExists('shippings');
    }
}
