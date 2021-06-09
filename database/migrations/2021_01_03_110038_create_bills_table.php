<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->nullable()
                ->constrained();
            $table->string("name");
            $table->string("street_address1")->nullable();
            $table->string("street_address2")->nullable();
            $table->string("city")->nullable();
            $table->string("state")->nullable();
            $table->string('country')->nullable();
            $table->string('email')->nullable();
            $table->string('phone1')->nullable();
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
        Schema::dropIfExists('bills');
    }
}
