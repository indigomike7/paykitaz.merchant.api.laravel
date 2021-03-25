<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant_user;
use App\Models\UserLogin;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Merchant_login;
use App\Models\Merchant_informasi_toko;
use App\Models\Personal_access_tokens;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class Merchant_informasi_tokoController extends Controller
{
    //
    public function index()
    {
        return Merchant_informasi_toko::all();
    }

    public function show(Merchant_informasi_toko $mu)
    {
        return $mu;
    }

    public function informasitoko1(Request $request)
    {
		$mit = new Merchant_informasi_toko; 
		
		$login_id = $request->post('login_id');
		$user_name = $request->post('user_name');
		$token = $request->post('token');
		$ml = Merchant_login::where('login_id' , $login_id)
					  ->where( 'user_name' , $user_name)->first();

			//$mu = $ul->user_login($request);
			//die(print_r($mu));
        if ($ml)
        {
			//$user = auth('sanctum')->Merchant_login();
			$personalAccessToken = PersonalAccessToken::findToken($token);
			if (
       $personalAccessToken) 
			{
				$inserted = $mit->informasitoko1($request, $ml->login_id,$ml->phone_number);
				if($inserted)
				{
					  $message = [
						  'status' => TRUE,
						  'active'=> TRUE,
						  'message' => "Sukses insert informasi toko 1"
					  ];
					  //die( print_r($mu));
				}
				else
				{
					  $message = [
						  'status' => TRUE,
						  'active'=> FALSE,
						  'message' => "Gagal insert informasi toko 1"
					  ];
					  //die( print_r($mu));
				}
			}
			else
			{
					  $message = [
						  'status' => FALSE,
						  'active'=> FALSE,
						  'message' => "Ambil Token Gagal"
					  ];
				
			}
          } 
		  else
          {
              // Login Error
              $message = [
                  'status' => FALSE,
                  'message' => "Gagal Check Login."
              ];
			  //die( print_r($mu));
          }


        return response()->json($message, 201);
    }
    public function Logout(Request $request)
    {
		$ul = new UserLogin; 
		
		$login_id = $request->post('login_id');
		$user_name = $request->post('user_name');
		$token = $request->post('token');
		$ml = Merchant_login::where('login_id' , $login_id)->first();

			//$mu = $ul->user_login($request);
			//die(print_r($mu));
        if ($ml)
        {
			//$user = auth('sanctum')->Merchant_login();
			$ml->tokens()->delete();;
					  $message = [
						  'status' => TRUE,
						  'message' => "Logout Berhasil"
					  ];
				
			
          } 
		  else
          {
              // Login Error
              $message = [
                  'status' => FALSE,
                  'message' => "Gagal Logout"
              ];
			  //die( print_r($mu));
          }

        return response()->json($message, 201);
    }
	
    public function update(Request $request, Merchant_user $mu)
    {
        $mu->update($request->all());

        return response()->json($mu, 200);
    }

    public function delete(Merchant_user $mu)
    {
        $mu->delete();

        return response()->json(null, 204);
    }
}
