<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant_user;
use App\Models\UserLogin;

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
	
    public function store4(Request $request)
    {
		$mu = new UserLogin; 
        $mu = $mu->user_login($request);

          if ($mu)
          {
                // Generate Token
                $token_data['login_id'] = $mu->login_id;
                $token_data['user_name'] = $mu->user_name;
                $token_data['time'] = time();

                $user_token = $this->authorization_token->generateToken($token_data);

                $return_data = [
                    'login_id' => $output->login_id,
                    'user_name' => $output->user_name,
                    'token' => $user_token,
                ];

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
                  'message' => "Gagal Mendaftar."
              ];
              //$this->response()->json($message, RestController::HTTP_NOT_FOUND);
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
