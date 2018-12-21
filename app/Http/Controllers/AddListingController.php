<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\OutletDetailTrait;
use App\OutletDetail;
use App\User;

class AddListingController extends Controller
{
	use OutletDetailTrait;

    function showAddlistingForm()
    {

    $outletTypeArray=$this->getEnumValues('outletdetails','outletType');
    return view('addListing')->with('outletTypes',$outletTypeArray);
    }

    function store(Request $data)
    {
    	//convert json data to php array
    	//validate data fun1
    	//split data for both the tables fun2
    	//store in array and pass to its responsible function to store in database through equivalent model fun3 fun4 

    }

}
