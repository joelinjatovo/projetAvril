<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRowsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rows_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reference', 100)->nullable();
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->integer('location_ray')->nullable(); // rayon de localisation 15km 20km 150km
            $table->string('location_unity', 20)->nullable(); // m km cm etc
            $table->integer('quantity')->nullable();
            $table->string('unity', 20)->nullable();
            $table->string('price_per_unity', 100)->nullable();
            $table->string('currency', 20)->nullable();
            $table->float('tma', 8, 2)->nullable();
            $table->string('status', 20)->default('pinged'); // pinged published blocked drafted trashed archived
            $table->bigInteger('product_id')->default('0');
            $table->bigInteger('seller_id')->default('0');
            $table->bigInteger('author_id')->default('0');
            $table->bigInteger('location_id')->default('0');
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
        Schema::dropIfExists('rows_products');
    }
}
