<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 150)->index();
            $table->longText('content')->nullable();
            $table->string('path')->nullable();
            $table->integer('page_order')->nullable();
            $table->integer('is_pub')->default(0);
            $table->string('language', 2)->default('fr');
            $table->bigInteger('parent_id')->default(0);
            $table->bigInteger('author_id')->default(0);
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
        Schema::dropIfExists('pages');
    }
}
