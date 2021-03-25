<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use DB;
use App\Quotation;
class Personal_access_tokens extends Authenticatable
{
    use  HasApiTokens, HasFactory, Notifiable;
	    protected $table = 'personal_access_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'token',
        'name',
        'tokenable',
        'abilities',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'login_password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	/*
	public function __construct()
	{
		return DB::table('merchant_login');
	}
	*/
}
