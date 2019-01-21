<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\EnumOperationsTrait;
use App\OutletDetail;
use App\User;

class AddListingController extends Controller
{
	use EnumOperationsTrait;

/*Show the addListing form*/
    function showAddlistingForm()
    {
     $tableName='outletdetails';
     $columnName='outletType';
 
    $outletTypeArray=$this->getEnumValuesIntoArray($tableName,$columnName);
    $tagsArray=array("Air Conditioned","Private Dinning Area Available","Wifi","Serves Jain Food","Brunch","Desserts and Bakes","Sports TV","Street parking","Rooftop","Wine","Beer","Birthday Special","Party Room","Accepts E-Wallet","Accepts E-Wallet");

    $cuisinesArray=array("South-Indian","North-Indian","Italian","Afghani","Asian","Biryani","Burger","Continental","Gujarati","Hyderabadi","Mexican","Maharashtrian","Kerala","Japanese");
    
    $timeHoursArray=array("00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23");

    $timeMinutesArray=array("00","15","30","45");

    return view('addListing')->with('outletTypes',$outletTypeArray)->with('tags',$tagsArray)->with('cuisines',$cuisinesArray)->with('timeHours',$timeHoursArray)->with('timeMinutes',$timeMinutesArray);
    }

/*Handle the addlisting post request for the application*/
    function addListing(Request $data)
    {
    //$this->validateListingData($data->all())->validate();
    $merchantId=$this->createMerchantID();
    $this->storeUserDetails($data->all(),$merchantId);
    $this->storeOutletDetails($data->all(),$merchantId); 
    $this->storeFiles($data,$merchantId);
    }
    


    function validateListingData(array $data)
    {
        return Validator::make($data,[
            'outletName' => 'string|alpha_num|max:30',
            'logoImg' => 'dimensions:min_width=350,max_width=400,min_height=350,max_height=400,ratio=1/1|file|image|max:200',
            'description' => 'string|alpha_num|min:30|max:100',
            'website' => 'url|nullable|max:40',
            'city' => 'string|alpha|max:25',
            'pincode' => 'numeric|digits:6',

            'ownerName' => 'string|alpha|max:40',
            'ownerEmail' => 'email|max:30|unique:users,email', // maybe error
            'ownerPhone' => 'numeric|digits:10|unique:users,ownerPhone',
            'company' => 'string|alpha_num|max:25|unique:users,company',
            
            'outletEmail' => 'email|max:30|unique:outletdetails,outletEmail|different:ownerEmail',
            'outletPhone' => 'numeric|digits:10|unique:outletdetails,outletPhone|different:ownerPhone',
            'bannerImg' => 'dimensions:min_width=350,max_width=400,min_height=350,max_height=400|file|image|max:250',
            'menuImg' => 'file|image|min:480',
            'avgCost' => 'string|max:5',
            'galleryImages.*' => 'dimensions:min_width=350,max_width=720,min_height=600,max_height=1080|file|image|max:720'
        ]);
        
    }

    function createMerchantID()
    {
        $tableInstance = new OutletDetail;
        $row=$tableInstance->orderBy('created_at','desc')->first();
        if($row == null)
        {
            $id='12345678';
        }
        else
        {
            $id=(int)$row->merchant_id + 1;
            $id=(string)$id;
        }
        return $id;
    }

   function storeOutletDetails(array $data, $mer_id)
    {
        OutletDetail::create([
            'merchant_id' => $mer_id,
            'outletName' => $data['outletName'],
            'description' => $data['description'],
            'website' => (string)$data['website'],
            'address' => $data['address'],
            'city' => $data['city'],
            'pincode' => (string)$data['pincode'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'email' => (string)$data['outletEmail'],
            'phone' => (string)$data['outletPhone'],
            'outletType' => $data['outletType'],
            'tags' => ($this->getStringOfArray($data['tagsInputArray'])),
            'cuisine' => ($this->getStringOfArray($data['cuisinesInputArray'])),
            'foodType' => $data['foodType'],
            'openTimeWD' => $data['weekdayOpeningTime'],
            'closeTimeWD' => $data['weekdayClosingTime'],
            'openTimeWE' => $data['weekendOpeningTime'],
            'closeTimeWE' => $data['weekendClosingTime'],
            'activated' => false,

        ]);
    }

    function storeUserDetails(array $data, $mer_id)
    {       
        User::create([
            'merchant_id' => $mer_id,
            'ownerName' => $data['ownerName'],
            'ownerEmail' => (string)$data['ownerEmail'],
            'ownerPhone' => (string)$data['ownerPhone'],
            'company' => $data['company']
        ]);
    }

    function storeFiles(Request $data, $mer_id)
    {
        //error can occur over here. maybe to use file('name') instead.
        $ext=null;
        $logoFile=$data->file('logoImg');
        $bannerFile=$data->file('bannerImg');
        $menuFile=$data->file('menuImg');

        //here you can wite $galleryFilesArray = array();
        $galleryFilesArray[]=$data->file('galleryImages');

        if($logoFile != null)
        {
           $ext = $logoFile->extension(); 
           $logoFile->move(public_path().'/logos', $mer_id.'_logo.'.$ext); 
        }

        if($bannerFile != null)
        {
            $ext = $bannerFile->extension(); 
            $bannerFile->move(public_path().'/banners', $mer_id.'_banner.'.$ext);
        }

        if($menuFile != null)
        {
            $ext = $menuFile->extension(); 
            $menuFile->move(public_path().'/menus', $mer_id.'_menu.'.$ext);
        }

        if($galleryFilesArray != null)
        {
            $i=0;
            foreach ($galleryFilesArray as $galleryFile) //error maybe, can be index type array
             {
                $ext = $galleryFile->extension(); 
                $galleryFile->move(public_path().'/galleryImages',$mer_id.'_galleryImage_'.$i.'.'.$ext);
                $i++;

        }

    }

}

 function getStringOfArray($var)
    {
        return implode(",", $var);
    }

}