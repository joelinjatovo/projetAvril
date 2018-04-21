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
            $table->integer('location_ray')->nullable(); // rayon de localisation 15km 20km 150km
            $table->string('location_unity', 20)->nullable(); // m km cm etc
            $table->integer('quantity')->nullable();
            $table->string('unity', 20)->nullable();
            $table->string('price', 100)->nullable();
            $table->float('tma', 8, 2)->nullable();
            $table->integer('bed')->nullable();
            $table->integer('parking')->nullable();
            $table->integer('toilet')->nullable();
            $table->integer('is_taxable')->nullable();
            $table->string('status', 20)->default('pinged'); // pinged published blocked drafted trashed archived
            $table->bigInteger('category_id')->default('0');
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
        Schema::dropIfExists('products');
    }
}
