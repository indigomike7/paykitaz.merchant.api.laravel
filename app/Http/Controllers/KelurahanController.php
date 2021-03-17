<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelurahan;

class KelurahanController extends Controller
{
    //
    public function index()
    {
        return Kelurahan::all();
    }

    public function show(Kelurahan $mu)
    {
        return $mu;
    }

    public function store(Request $request)
    {
		$mu = new Kelurahan ;
        $mu = $mu->getKelurahan($request);

          if ($mu)
          {
              // Daftar Success
              $message = [
                  'status' => true,
                  'message' => "Berhasil ambil province",
				  'datax'=> $mu
              ];
          } else
          {
              // Login Error
              $message = [
                  'status' => FALSE,
                  'message' => "Gagal Mendaftar."
              ];
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
