<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique(); //name used to identify plan in the URL
            $table->string('name');
            $table->float('cost');
            $table->text('description')->nullable();
            $table->string('type', 20)->default('monthly')->index();
            $table->string('role', 20)->default('member')->index(); // admin afa apl member seller
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
        Schema::dropIfExists('plans');
    }
}
