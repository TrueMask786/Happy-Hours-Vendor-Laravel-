<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
  
    use RegistersUsers;

    protected $redirectTo = '/home';



    public function __construct()
    {
        $this->middleware('guest');
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'merchant_id' => 'required|min:10|max:10|unique:users',
            'owner_key' => 'required|min:6|max:6|unique:users',
            'email' => 'required|email|max:30|unique:users',
            'password' => 'required|min:6|max:25|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return User::create(['password' => bcrypt($data['password']),]);
    }


     protected function getCredentials(Request $request)
    {
        return $request->only('merchant_id', 'owner_key');
    }


    protected function verifyDetails(Request $request)
    {
        $credentials=getCredentials($request);

        #$user=this->provider->retrieveByCredentials($credentials)

       # $mer_id=$user-

    }
}
