<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use App\Quotation;

class Merchant_user extends Model
{
    use HasFactory;
	private $_db,
    $_data;
	    protected $table = 'merchant_user';
		protected $primaryKey = 'merchant_id';
		public $timestamps = false;
		
public function __construct($user = null) 
{
	date_default_timezone_set("Asia/Jakarta");
}
		public function userdaftar1(Request $request,$namafiledidb){

        $store_name = $request->post('store_name');
        $business_type = $request->post('business_type');
        $store_open = $request->post('store_open');
        $store_close = $request->post('store_close');
        $merchant_type = $request->post('merchant_type');
		//$picture="";
		//$namafiledidb = $request->post('namafiledidb');
		
        //$featured_photo = $picture;
            $data = array(
                'store_name' => $store_name,
                'business_type' => $business_type,
                'store_open' => $store_open,
                'store_close'=>$store_close,
                'merchant_type' => $merchant_type,
                'featured_photo' => $namafiledidb,
				'session_id'=>session()->getId(),
				'registered_date'=>date("Y-m-d H:i:s"),
            );
			//$inserted = DB::getInstance();
					$inserted=DB::table('merchant_user')->insertOrIgnore($data);
//            $this->db->insert('merchant_user', $data);
			if(isset($error))
			{
				return false;
			}
			else
			{
	            return ($inserted != 1) ? false  : session()->getId();
			}


    }

    public function userdaftar2(Request $request){

        $merchant_address = $request->post('merchant_address');
        $merchant_kelurahan = $request->post('merchant_kelurahan');
        $session_id = $request->post('session_id');
        $zip_code = $request->post('zip_code');

        //$idpaket = $this->getIdPaket($paket);

        //echo $idpaket;

//        if(!empty($idpaket)){
            //untuk table pengguna
            $data = array(
                'merchant_address' => $merchant_address,
                'merchant_kelurahan' => $merchant_kelurahan,
                'zip_code' => $zip_code
            );
			//$this->db->where('session_id',$session_id);
            //$this->db->update('merchant_user', $data);
			
			$updated=DB::table('merchant_user')->where('session_id',$session_id)->update(
			$data
			);
			
            return ($updated != 1) ? false : true;
//        }else {
//            return false;
//        }

    }
    public function userdaftar3(Request $request){

        $phone_number = $request->post('phone_number');
        $user_name = $request->post('user_name');
        $session_id = $request->post('session_idx');
        $email = $request->post('email');
		$login_password = $request->post('login_password');
		$id=0;

		$checkphone = DB::table("merchant_login")->where('phone_number', $phone_number)->get();
		$checkusername = DB::table("merchant_login")->where('user_name', $user_name)->get();
		$checkemail = DB::table("merchant_login")->where('email', $email)->get();
		
		if(count($checkphone)>0 )
		{
			return "No Handphone Sudah Terdaftar";
		}
		if(count($checkusername)>0 )
		{
			return "Username Sudah Terdaftar";
		}
		if(count($checkemail)>0 )
		{
			return "Email Sudah Terdaftar";
		}
        $q = DB::table("merchant_user")->get()->where('session_id', $session_id);

        if( $q ) 
        {
			foreach ($q as $each) {
				//echo $user->name;
				$id =$each->merchant_id;
			}            //$data=$q->result_array();
			
        }else{
            $id=0;
        }


            $data = array(
                'phone_number' => $phone_number,
                'user_name' => $user_name,
                'email' => $email,
				'login_password' => md5($login_password),
				'merchant_user'=>$id,
				'registered_date'=> date("Y-m-d H:i:s"),
            );
					$inserted = DB::table('merchant_login')->insertorignore(
					$data
					);
            return ($inserted != 1) ? false : true;

    }
	public function insertlogin()
	{
		
	}


}
