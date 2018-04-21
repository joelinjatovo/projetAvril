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
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('role')->default('member'); // admin afa apl member seller
            $table->string('type')->default('person'); // person organization
            $table->string('status', 20); // active disabled blocked pinged
            $table->dateTime('enabled_at')->nullable();
            $table->dateTime('disabled_at')->nullable();
            $table->bigInteger('author_id')->nullable();
            $table->bigInteger('location_id')->nullable();
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
