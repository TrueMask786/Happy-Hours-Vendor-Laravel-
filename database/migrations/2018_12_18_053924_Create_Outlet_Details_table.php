<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutletDetailsTable extends Migration
{
 
 
    public function up()
    {
        Schema::connection('mysql1')->create('outletDetails', function (Blueprint $table) {
            $table->string('merchant_id',8);
            $table->primary('merchant_id');
            $table->foreign('merchant_id')->references('merchant_id')->on('users');
            $table->string('outletName',30);
            $table->text('description');
            $table->string('website',40)->nullable();
            $table->string('address');
            $table->string('city',25);
            $table->string('pincode',6);
            $table->decimal('latitude',10,6);
            $table->decimal('longitude',10,6);
            $table->string('email')->unique();
            $table->string('phone',10)->unique();
            $table->enum('outletType',['Restaurant','Bar','Restaurant and Bar','Takeaway']);
            $table->string('tags')->nullable();
            $table->string('cuisine');
            $table->enum('foodType',['Veg','Non-Veg','Both']);
            $table->string('openTimeWD',10);
            $table->string('closeTimeWD',10);
            $table->string('openTimeWE',10);
            $table->string('closeTimeWE',10);  
            $table->boolean('activated')->default(false);          
            $table->timestamps();

        });
    }

 
    public function down()
    {
        Schema::dropIfExists('outletDetails');
    }
}
