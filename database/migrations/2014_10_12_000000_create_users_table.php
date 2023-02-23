<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('socialite_id')->nullable();
            $table->text('image')->nullable();
            $table->string('first_name',30);
            $table->string('last_name',30)->nullable();
            $table->string('user_name')->nullable();
            $table->string('email',100)->unique();
            $table->string('phone',12)->nullable();
            $table->string('city',50)->nullable();
            $table->string('pin_code')->nullable();
            $table->enum('status',[0,1,2])->nullable();
            $table->enum('gender',[0,1,2])->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->enum('terms_conditions',[1])->nullable();
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
