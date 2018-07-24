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
            $table->string('type', 20)->default('organization')->index(); // person organization
            $table->string('language')->default('fr'); // fr en
            $table->string('status', 20); // active disabled blocked pinged
            
            $table->dateTime('enabled_at')->nullable();
            $table->dateTime('disabled_at')->nullable();
            
            $table->integer('use_default_password')->default(0);
            $table->integer('is_seller')->default(0)->index(); // if afa check if seller
            
            $table->bigInteger('apl_id')->default(0)->index();
            $table->dateTime('apl_ends_at')->nullable()->index();
            
            $table->bigInteger('image_id')->default(0)->index();
            
            $table->bigInteger('author_id')->default(0)->index();
            $table->bigInteger('location_id')->default(0)->index();
            $table->bigInteger('country_id')->default(0)->index();
            
            // AFA Detail
            $table->bigInteger('operation_range')->default(0)->index();
            $table->bigInteger('state_id')->default(0)->index();
            
            // Baintree
            $table->string('braintree_id')->nullable();
            $table->string('paypal_email')->nullable();
            
            // Stripe
            $table->string('stripe_id')->nullable();
            
            // Common fields Cashier & Baintree
            $table->string('card_brand')->nullable();
            $table->string('card_last_four')->nullable();
            
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('subscription_ends_at')->nullable();
            
            $table->string('activation_code')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
