<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug', 150)->unique();
            $table->string('title', 150)->nullable();
            $table->longText('content')->nullable();
            $table->string('meta_tag')->nullable();
            $table->string('meta_description')->nullable();
            $table->bigInteger('view_count')->default(0);
            $table->string('status', 20)->default('pinged')->index(); // pinged published drafted trashed blocked archived
            $table->integer('starred')->default(0)->index();
            $table->string('post_type', 150)->default('blog')->index(); // page pub post
            $table->bigInteger('image_id')->default(0)->index();
            $table->bigInteger('author_id')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
