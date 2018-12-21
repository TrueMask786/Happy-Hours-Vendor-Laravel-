<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{


    public function up()
    {
        Schema::connection('mysql1')->create('users', function (Blueprint $table) {
            $table->string('merchant_id',8)->unique();
            $table->primary('merchant_id');            
            $table->string('owner_key')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
