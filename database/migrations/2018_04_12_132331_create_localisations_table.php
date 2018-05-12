<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('formatted')->nullable();
            $table->string('country')->nullable();
            $table->string('area_level_1')->nullable();
            $table->string('area_level_2')->nullable();
            $table->string('locality')->nullable();
            $table->string('route')->nullable();
            $table->string('postalCode')->nullable();
            
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('altitude')->nullable();
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
        Schema::dropIfExists('localizations');
    }
}
