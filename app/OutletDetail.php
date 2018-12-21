<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutletDetail extends Model
{
    protected $guard = ['created_at','updated_at',];

    protected $primaryKey='merchant_id';

    protected $keyType = 'string';

    public $incrementing = false;

}
