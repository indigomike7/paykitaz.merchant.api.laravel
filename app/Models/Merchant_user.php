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
		
public function __construct($user = null) {
 //       $this->_db = DB::getInstance(); 
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
				'session_id'=>session()->getId()
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

        $merchant_address = $request->post('merchant_address', true);
        $merchant_kelurahan = $request->post('merchant_kelurahan', true);
        $session_id = $request->post('session_id', true);
        $zip_code = $request->post('zip_code', true);

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
			
            return ($updated->count() != 1) ? false : true;
//        }else {
//            return false;
//        }

    }
    public function userdaftar3(Request $request){

        $phone_number = $request->post('phone_number', true);
        $user_name = $request->post('user_name', true);
        $session_id = $request->post('session_id', true);
        $email = $request->post('email', true);
		$login_password = $request->post('login_password',true);
		$id=0;

        $this->db->where('session_id', $session_id);
        $q = $this->db->get("merchant_user");

        if( $q->num_rows() ) 
        {
            $data=$q->result_array();
			$id =$data[0]['merchant_id'];
        }else{
            $id=0;
        }


            $data = array(
                'phone_number' => $phone_number,
                'user_name' => $user_name,
                'email' => $email,
				'login_password' => md5($login_password),
				'merchant_user'=>$id
            );
					$inserted = DB::table('merchant_user')->insert(
					$data
					);
            return ($inserted->count() != 1) ? false : true;

    }
    public function userdaftar4(){

        $phone_number = $request->post('phone_number', true);
        $user_name = $request->post('user_name', true);
        $login_password = $request->post('login_password', true);
        $email = $request->post('email', true);

$this->db->select('merchant_id');
$this->db->from('merchant_login');
$query = $this->db->get();  

echo print_r($query);

        //$idpaket = $this->getIdPaket($paket);

        //echo $idpaket;

//        if(!empty($idpaket)){
            //untuk table pengguna
            $data = array(
                'phone_number' => $phone_number,
                'user_name' => $user_name,
                'login_password' => md5($login_password),
                'email' => $email,
                'merchant_user'=>$merchant_id
            );
        
            $this->db->insert('merchant_login', $data);
            return true;
//        }else {
//            return false;
//        }

    }

}
