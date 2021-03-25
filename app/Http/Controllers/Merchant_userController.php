<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant_user;
use App\Models\UserLogin;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Merchant_login;
use App\Models\Personal_access_tokens;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class Merchant_userController extends Controller
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

    public function store(Request $request)
    {
		$mu = new Merchant_user; 
		$config['upload_path'] = './upload/'.session()->getId()."/"; 
			if (!mkdir($config['upload_path'] , 0777, true)) {
				die('Failed to create folders...');
			}


 
		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('filez');
 
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['max_size']    = '5024'; // max_size in kb
		// $config['file_name'] = $_FILES['file']['name'];

			$name_file = $file->getClientOriginalName();

			$namafiledidb = 'primary_'.$name_file;
				
				//$request->post("namafiledidb")=$namafiledidb;
		//Load upload library
		$file->move($config['upload_path'],$namafiledidb);
        $mu = $mu->userdaftar1($request,$namafiledidb);

          if ($mu)
          {
              // Daftar Success
              $message = [
                  'status' => true,
                  'message' => "Anda Telah Berhasil Daftar Toko",
				  'session_id_reg'=> $mu
              ];
              //$this->response()->json($message, RestController::HTTP_OK);
          } else
          {
              // Login Error
              $message = [
                  'status' => FALSE,
                  'message' => "Gagal Mendaftar."
              ];
              //$this->response()->json($message, RestController::HTTP_NOT_FOUND);
          }


        return response()->json($message, 201);
    }

    public function store2(Request $request)
    {
		$mu = new Merchant_user; 
        $mu = $mu->userdaftar2($request);

          if ($mu)
          {
              // Daftar Success
              $message = [
                  'status' => true,
                  'message' => "Anda Telah Berhasil Daftar Alamat"
              ];
              //$this->response()->json($message, RestController::HTTP_OK);
          } else
          {
              // Login Error
              $message = [
                  'status' => FALSE,
                  'message' => "Gagal Mendaftar."
              ];
              //$this->response()->json($message, RestController::HTTP_NOT_FOUND);
          }


        return response()->json($message, 201);
    }
	
    public function store3(Request $request)
    {
		$mu = new Merchant_user; 
        $mu = $mu->userdaftar3($request);

          if (strlen($mu)>1)
          {
              // Login Error
              $message = [
                  'status' => FALSE,
                  'message' => "Gagal Mendaftar Data Login. ",
				  'error' => $mu
				  
              ];
          } else
          {
              // Daftar Success
              $message = [
                  'status' => true,
                  'message' => "Anda Telah Berhasil Daftar Login Data",
				  'session_id_reg'=> $mu,
				  'error' => "no error"
              ];
              //$this->response()->json($message, RestController::HTTP_OK);
          }


        return response()->json($message, 201);
    }
	
    public function login(Request $request)
    {
		$ul = new UserLogin; 
		
        //$mu = $ul->user_login($request);
		$phone_number = $request->post('phone_number');
		$login_password = $request->post('login_password');
		$mu = Merchant_login::where('phone_number' , $phone_number)
					  ->where( 'login_password' , md5($login_password))->first();

			//$mu = $ul->user_login($request);
			//die(print_r($mu));
          if ($mu)
          {
                // Generate Token
				//$data=array();
					$token_data['login_id'] = $mu->login_id;
					$token_data['user_name'] = $mu->user_name;
					$token_data['time'] = time();
/*                $token_data['login_id'] = $mu->login_id;
                $token_data['user_name'] = $mu->user_name;
                $token_data['time'] = time();
*/
			$user_token =  $mu->createToken($mu->login_id, ['server:update'])->plainTextToken;

				if($mu->active==1)
				{
                $return_data = [
                    'login_id' => $mu->login_id,
                    'user_name' => $mu->user_name,
                    'token' => $user_token,
					'active'=>true
					];
				}
				else
				{
					$return_data = [
                    'login_id' => $mu->login_id,
                    'user_name' => $mu->user_name,
                    'token' => $user_token,
					'active'=>false
					];

				}
                // Login Success
                $message = [
                    'status' => true,
                    'data' => $return_data,
                    'message' => "User login successful"
                ];
          } else
          {
              // Login Error
              $message = [
                  'status' => FALSE,
                  'message' => "Gagal Login."
              ];
			  //die( print_r($mu));
          }


        return response()->json($message, 201);
    }
    public function checkLoginRedirect(Request $request)
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
			if (
       $personalAccessToken) 
			{
				if($ml->active!= null || $ml->active!= 0)
				{
					  $message = [
						  'status' => TRUE,
						  'active'=> TRUE,
						  'message' => "Sudah Login. Sudah diActivate"
					  ];
					  //die( print_r($mu));
				}
				else
				{
					  $message = [
						  'status' => TRUE,
						  'active'=> FALSE,
						  'message' => "Sudah Login. Belum diActivate"
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
