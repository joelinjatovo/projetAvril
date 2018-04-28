<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status', 150)->index();
            $table->bigInteger('totalQuantity')->nullable();
            $table->double('totalPrice', 10, 2)->nullable();
            $table->double('totalTma', 10, 2)->nullable();
            $table->string('currency', 20)->nullable();
            $table->bigInteger('author_id')->default(0)->index();
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
        Schema::dropIfExists('carts');
    }
}
