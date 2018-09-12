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
            $table->string('title_en', 150)->index();
            $table->longText('content_en')->nullable();
            $table->string('path')->nullable();
            $table->integer('is_main')->default(0);
            $table->integer('page_order')->nullable();
            $table->string('type', 128)->default('page')->nullable();
            
            // type = pub
            $table->longText('pub_url')->nullable();
            $table->bigInteger('pub_image_id')->default(0);
            $table->longText('pub_url_en')->nullable();
            $table->bigInteger('pub_image_en_id')->default(0);
            
            $table->bigInteger('parent_id')->default(0);
            $table->bigInteger('author_id')->default(0);
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
        Schema::dropIfExists('pages');
    }
}
