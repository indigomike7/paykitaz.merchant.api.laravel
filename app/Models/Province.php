<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use App\Quotation;

class Province extends Model
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

    public function getProvince(Request $request)
	{

			$provinces=DB::table('provinces')->get();
			
		$data=array();
		foreach ($provinces as $each)
		{
			$data[]=$each;
		}
        if(count($provinces) > 0){
            return $data;
        }
        else {
            return false;
        }
    }

}
