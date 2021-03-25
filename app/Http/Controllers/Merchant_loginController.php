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

class Merchant_loginController extends Controller
{
    //
    public function index()
    {
        return Merchant_user::all();
    }

    public function show(Merchant_user $mu)
    {
        return $mu;
    }

    public function gettoko(Request $request)
    {
		$ul = new UserLogin; 
		
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
			if ($personalAccessToken) 
			{
				$mit = new Merchant_informasi_toko;
				$data = $mit->gettoko($request);
				if($data)
				{
					  $message = [
						  'status' => TRUE,
						  'data'=> $data,
						  'message' => "Berhasil ambil detail toko"
					  ];
				}
				else
				{
					  $message = [
						  'status' => FALSE,
						  'data'=> FALSE,
						  'message' => "Ambil Toko Gagal"
					  ];
					
				}
			}
			else
			{
					  $message = [
						  'status' => FALSE,
						  'data'=> FALSE,
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
