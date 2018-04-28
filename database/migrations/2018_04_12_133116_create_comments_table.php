<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug', 150)->unique();
            $table->string('title', 150)->nullable();
            $table->longText('content')->nullable();
            $table->bigInteger('blog_id')->default(0)->index();
            $table->bigInteger('author_id')->default(0)->index();
            $table->string('status', 20)->default('pinged')->index(); // pinged published blocked drafted trashed archived
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
        Schema::dropIfExists('comments');
    }
}
