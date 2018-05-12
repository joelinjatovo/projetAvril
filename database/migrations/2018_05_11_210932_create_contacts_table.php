<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('home_number', 100)->nullable();
            $table->string('work_number', 100)->nullable();
            $table->string('mobile_number', 100)->nullable();
            $table->string('contact_number', 100)->nullable();
            $table->bigInteger('author_id')->default(0)->index();
            $table->bigInteger('location_id')->default(0)->index();
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
        Schema::dropIfExists('contacts');
    }
}
