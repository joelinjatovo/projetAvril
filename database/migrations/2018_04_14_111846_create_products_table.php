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
            
            $table->integer('is_new')->default(0);
            
            $table->bigInteger('view_count')->default(0);
            
            $table->float('area', 20, 2)->nullable();
            $table->integer('carport_spaces')->default(0);
            $table->integer('garage_spaces')->default(0);
            $table->integer('off_street_spaces')->default(0);
            $table->integer('bathrooms')->default(0);
            $table->integer('bedrooms')->default(0);
            $table->integer('ensuite')->default(0);
            $table->integer('land_area')->default(0);
            $table->integer('floor_area')->default(0);
            $table->integer('number_of_floors')->default(0);
            $table->boolean('new_construction')->default(false);
            $table->string('year_built', 10)->nullable();
            
            $table->string('display_address')->nullable();
            
            $table->float('price', 20, 2)->nullable();
            $table->string('currency', 10)->nullable();
            
            $table->float('tma', 8, 2)->nullable();
            $table->float('commision', 8, 2)->nullable();
            $table->integer('commision_edited')->default(0);
            
            $table->string('status', 20)->default('published')->index(); // pinged published blocked drafted trashed archived
            
            $table->bigInteger('type_id')->default('0')->index(); // apartment, individual house, town house, ground
            $table->bigInteger('location_type_id')->default('0')->index();  // in urban area, extra-urban, in campaign
            
            $table->bigInteger('category_id')->default('0')->index();
            $table->bigInteger('buyer_id')->default('0')->index();
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
