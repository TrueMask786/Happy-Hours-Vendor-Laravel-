<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{


    public function up()
    {
        Schema::connection('mysql1')->create('users', function (Blueprint $table) {
            $table->string('merchant_id',8);
            $table->primary('merchant_id');  
            $table->string('ownerName');
            $table->string('email')->unique();
            $table->string('ownerPhone',10)->unique();
            $table->string('company')->unique();          
            $table->string('owner_key')->unique()->nullable();
            $table->string('password')->nullable();
            $table->rememberToken()->nullable();
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
