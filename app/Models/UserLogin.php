<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use App\Quotation;
use HasApiTokens;

class UserLogin extends Model
{
    use HasFactory;
	private $_db,
    $_data;
	    protected $table = 'merchant_login';
		protected $primaryKey = 'login_id';
		public $timestamps = false;
		
public function __construct($user = null) {
 //       $this->_db = DB::getInstance(); 
    }

    public function user_login(Request $request)
	{
		$phone_number=$request->post('phone_number');
		$login_password=$request->post('login_password');
			$login=DB::table('merchant_login')->where('phone_number',$phone_number)->where('login_password',md5($login_password))->get();
        if(count($login) > 0){
            return $login;
        }
        else {
            return false;
        }
    }

}
