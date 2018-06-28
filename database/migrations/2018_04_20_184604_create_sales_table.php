<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status', 150)->default('pinged')->index();
            $table->double('price', 10, 2)->default(0);
            $table->double('tma', 10, 2)->default(0);
            $table->string('currency', 20)->nullable();
            
            $table->bigInteger('apl_id')->default(0)->index();
            $table->datetime('apl_paid_at')->nullable();
            $table->double('apl_amount', 10, 2)->default(0);
            $table->string('apl_transaction_id')->nullable();
            $table->string('apl_payment_type')->nullable();
            
            $table->bigInteger('afa_id')->default(0)->index();
            $table->datetime('afa_paid_at')->nullable();
            $table->double('afa_amount', 10, 2)->default(0);
            $table->string('afa_transaction_id')->nullable();
            $table->string('afa_payment_type')->nullable();
            
            $table->bigInteger('cancelled_by')->default(0)->index();
            $table->datetime('cancelled_at')->nullable();
            $table->string('cancelled_by_role', 150)->nullable();
            $table->string('cancelled_desc')->nullable();
            
            $table->bigInteger('product_id')->default(0)->index();
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
        Schema::dropIfExists('sales');
    }
}
