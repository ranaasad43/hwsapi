<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    public function addUser($values){
    	//dd($values);
    	$data = [
    		'name' => $values['name'],
    		'user_name' => $values['user_name'],
    		'email' => $values['email'],
    		'password' => $values['password'],
    		'gender' => $values['gender'],
    		'date_of_birth' => $values['date_of_birth'],
    		'country' => $values['country'],
    		'profile_image' => $values['profile_image']
    	];
    	//dd($data);
    	return DB::table($this->table)->insert($data);
    	//dd('success');
    }
}