<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->unique();
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('role', 20)->default('member')->index(); // admin afa apl member seller
            $table->string('type', 20)->default('person')->index(); // person organization
            $table->string('language')->default('fr'); // fr en
            $table->string('status', 20); // active disabled blocked pinged
            $table->double('percent', 8, 2)->nullable();
            $table->dateTime('enabled_at')->nullable();
            $table->dateTime('disabled_at')->nullable();
            $table->integer('is_seller')->default(0)->index(); // if afa check if seller
            $table->bigInteger('apl_id')->default(0)->index(); // User must check his APL
            $table->bigInteger('image_id')->default(0)->index(); // User must check his APL
            $table->bigInteger('author_id')->default(0)->index();
            $table->bigInteger('location_id')->default(0)->index();
            $table->rememberToken();
            $table->timestamps();
            
            // Cashier fields
            $table->string('stripe_id')->nullable();
            
            // Baintree
            $table->string('braintree_id')->nullable();
            $table->string('paypal_email')->nullable();
            
            // Common fields Cashier & Baintree
            $table->string('card_brand')->nullable();
            $table->string('card_last_four')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
