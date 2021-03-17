<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use App\Quotation;

class BusinessType extends Model
{
    use HasFactory;
	private $_db,
    $_data;
	    protected $table = 'business_type';
		protected $primaryKey = 'bt_id';
		public $timestamps = false;
		
public function __construct($user = null) {
 //       $this->_db = DB::getInstance(); 
    }

    public function getBusinessType(Request $request)
	{

			$business_types=DB::table('business_type')->get();
			
		$data=array();
		foreach ($business_types as $each)
		{
			$data[]=$each;
		}
        if(count($data) > 0){
            return $data;
        }
        else {
            return false;
        }
    }

}
