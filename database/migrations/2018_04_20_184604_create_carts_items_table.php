<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('quantity')->default(0);
            $table->double('price', 10, 2)->default(0);
            $table->bigInteger('apl_id')->default(0)->index();
            $table->bigInteger('afa_id')->default(0)->index();
            $table->bigInteger('product_id')->default(0)->index();
            $table->bigInteger('author_id')->default(0)->index();
            $table->bigInteger('cart_id')->default(0)->index();
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
        Schema::dropIfExists('carts_items');
    }
}
