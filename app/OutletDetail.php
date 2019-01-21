<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutletDetail extends Model
{


	protected $table = 'outletdetails';

    protected $guard = ['created_at','updated_at',];

    protected $primaryKey='merchant_id';

    protected $keyType = 'string';

    protected $fillable= ['merchant_id','outletName','description','website','address','city','pincode','latitude','longitude','email','phone','outletType','tags','cuisine','foodType','openTimeWD','closeTimeWD','openTimeWE','closeTimeWE'];

    public $incrementing = false;


}
