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
            $table->string('reference', 150)->index();
            $table->string('slug', 150)->unique();
            $table->string('title', 150)->nullable();
            $table->longText('content')->nullable();
            $table->bigInteger('quantity')->default(1);
            $table->float('price', 20, 2)->nullable();
            $table->string('currency', 10)->nullable();
            $table->float('tma', 8, 2)->nullable();
            $table->string('status', 20)->default('pinged')->index(); // pinged published blocked drafted trashed archived
            $table->bigInteger('category_id')->default('0')->index();
            $table->bigInteger('seller_id')->default('0')->index();
            $table->bigInteger('author_id')->default('0')->index();
            $table->bigInteger('location_id')->default('0')->index();
            $table->bigInteger('image_id')->default('0')->index();
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
