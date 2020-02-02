<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    public function addUser($values){
    	//dd('usermodel');
    	DB::table($this->table)->insert($values);
    	dd('success');
    }
}