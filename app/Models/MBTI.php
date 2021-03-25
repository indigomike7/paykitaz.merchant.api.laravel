<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use App\Quotation;

class MBTI extends Model
{
    use HasFactory;
	private $_db,
    $_data;
	    protected $table = 'merchant_business_type_info';
		protected $primaryKey = 'mbti_id';
		public $timestamps = false;
		
	public function __construct($user = null) {
	 //       $this->_db = DB::getInstance(); 
		}

    public function getMBTI(Request $request)
	{

			$mbti=DB::table('merchant_business_type_info')->get();
			
		$data=array();
		foreach ($mbti as $each)
		{
			$data[]=$each;
		}
        if(count($mbti) > 0){
            return $data;
        }
        else {
            return false;
        }
    }

}
