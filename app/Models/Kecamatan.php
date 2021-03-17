<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use App\Quotation;

class Kecamatan extends Model
{
    use HasFactory;
	private $_db,
    $_data;
	    protected $table = 'districts';
		protected $primaryKey = 'id';
		public $timestamps = false;
		
public function __construct($user = null) {
 //       $this->_db = DB::getInstance(); 
    }

    public function getKecamatan(Request $request)
	{
		$regency_id = $request->post('regency_id');
		$kecamatans=DB::table('districts')->where('regency_id',$regency_id)->get();
			
		$data=array();
		foreach ($kecamatans as $each)
		{
			$data[]=$each;
		}
        if(count($kecamatans) > 0){
            return $data;
        }
        else {
            return false;
        }
    }

}
