<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;

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
            $table->increments('id');
            $table->string('name');
            $table->integer('phone');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('verification_token')->nullable();
            $table->string('api_token', 60)->unique();
            $table->integer('verified')->default(User::UNVERIFIED);
            $table->integer('block')->default(User::UNBLOCKED_USER);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes(); // Deleted at
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
