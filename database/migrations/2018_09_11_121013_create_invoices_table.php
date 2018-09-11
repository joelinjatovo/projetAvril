<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title')->nullable();
            $table->longText('content')->nullable();
            $table->float('amount', 20, 2)->nullable();
            $table->string('currency', 10)->nullable();
            $table->string('type', 128)->nullable();
            $table->text('payment_id')->nullable();
            $table->string('payment_type', 128)->nullable();
            $table->bigInteger('order_id')->default(0)->index();
            $table->bigInteger('from_id')->default(0)->index();
            $table->bigInteger('to_id')->default(0)->index();
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
        Schema::dropIfExists('invoices');
    }
}
