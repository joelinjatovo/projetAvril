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
           $table->longText('content')->nullable();
           $table->string('status', 20)->default('pinged')->index();
           $table->integer('votes')->default(0);
           $table->integer('spam')->default(0);
           $table->bigInteger('reply_id')->default(0)->index();
           $table->bigInteger('blog_id')->default(0)->index();
           $table->bigInteger('user_id')->default(0)->index();
           $table->timestamps();
       });
        
        Schema::create('comment_user_vote', function (Blueprint $table) {
           $table->bigInteger('comment_id')->default(0)->index();
           $table->bigInteger('user_id')->default(0)->index();
           $table->string('vote',11);
       });
        Schema::create('comment_spam', function (Blueprint $table) {
           $table->bigInteger('comment_id')->default(0)->index();
           $table->bigInteger('user_id')->default(0)->index();
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
        Schema::dropIfExists('comment_user_vote');
        Schema::dropIfExists('comment_spam');
    }
}
