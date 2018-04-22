<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('reference', 100)->nullable();
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->bigInteger('quantity')->default(1);
            $table->string('price', 100)->nullable();
            $table->float('tma', 8, 2)->nullable();
            $table->string('status', 20)->default('pinged'); // pinged published blocked drafted trashed archived
            $table->bigInteger('category_id')->default('0');
            $table->bigInteger('seller_id')->default('0');
            $table->bigInteger('author_id')->default('0');
            $table->bigInteger('location_id')->default('0');
            $table->bigInteger('image_id')->default('0');
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
