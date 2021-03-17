<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use App\Quotation;

class Kelurahan extends Model
{
    use HasFactory;
	private $_db,
    $_data;
	    protected $table = 'villages';
		protected $primaryKey = 'id';
		public $timestamps = false;
		
public function __construct($user = null) {
 //       $this->_db = DB::getInstance(); 
    }

    public function getKelurahan(Request $request)
	{
		$district_id = $request->post('district_id');
		$kelurahans=DB::table('villages')->where('district_id',$district_id)->get();
			
		$data=array();
		foreach ($kelurahans as $each)
		{
			$data[]=$each;
		}
        if(count($kelurahans) > 0){
            return $data;
        }
        else {
            return false;
        }
    }

}

