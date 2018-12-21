<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutletDetailsTable extends Migration
{
 
 
    public function up()
    {
        Schema::connection('mysql1')->create('outletDetails', function (Blueprint $table) {
            $table->string('merchant_id',8)->unique();
            $table->primary('merchant_id');
            $table->string('outletName',40);
            $table->text('description')->nullable();
            $table->string('website',100)->nullable();
            $table->json('address')->nullable();
            $table->string('city',20);
            $table->string('pincode',6);
            $table->decimal('latitude',10,6);
            $table->decimal('longitude',10,6);
            $table->string('email')->unique();
            $table->char('extension',4);
            $table->string('phone',10)->unique();
           // $table->string('outletType',30);
            $table->enum('outletType',['Restaurant','Bar','Restaurant and Bar','Takeaway']);
            $table->json('cuisine')->nullable();
            $table->enum('foodType',['Veg','Non-Veg','Both']);
            $table->char('openTimeWD',2);
            $table->char('closeTimeWD',2);
            $table->char('openTimeWE',2);
            $table->char('closeTimeWE',2);            
            $table->timestamps();

        });
    }

 
    public function down()
    {
        Schema::dropIfExists('outletDetails');
    }
}
