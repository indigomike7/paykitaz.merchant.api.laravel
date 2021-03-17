<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use App\Quotation;

class Kabupaten extends Model
{
    use HasFactory;
	private $_db,
    $_data;
	    protected $table = 'regencies';
		protected $primaryKey = 'id';
		public $timestamps = false;
		
public function __construct($user = null) {
 //       $this->_db = DB::getInstance(); 
    }

    public function getKabupaten(Request $request)
	{
		$province_id = $request->post('province_id');
		$kabupatens=DB::table('regencies')->where('province_id',$province_id)->get();
			
		$data=array();
		foreach ($kabupatens as $each)
		{
			$data[]=$each;
		}
        if(count($kabupatens) > 0){
            return $data;
        }
        else {
            return false;
        }
    }

}
