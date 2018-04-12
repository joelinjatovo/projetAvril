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
            $table->string('reference', 100)->unique();
            $table->string('slug');
            $table->string('title');
            $table->longText('content');
            $table->integer('surface');
            $table->string('unity', 20);
            $table->integer('price');
            $table->string('currency', 20);
            $table->float('tma', 8, 2); // Taux mise en vente : FLOAT equivalent for the database, 8 digits in total and 2 after the decimal point.
            $table->bigInteger('localisation_id');
            $table->bigInteger('user_id');
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
