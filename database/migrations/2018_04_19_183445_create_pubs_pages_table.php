<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePubsPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pubs_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('author_id')->default("0");
            $table->bigInteger('page_id')->default("0");
            $table->bigInteger('pub_id')->default('0');
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
        Schema::dropIfExists('pubs_pages');
    }
}
