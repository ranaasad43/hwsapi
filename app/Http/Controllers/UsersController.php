<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\User;
use Validator;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function addUser(Request $req){
        //dd($req->all());
        //dd('hwsapi');
         $rules = [
            // 'name' => 'min:3|alpha',
            // 'user_name' => 'min:3|alpha_num|unique:users',
            // 'email' => 'email|unique:users',
            // 'password' => 'required',
            // 'dob' => 'date',
            // 'country' => 'required',
        ];

        $messages = [
//            'name.alpha' => 'Your First name is Only Char'
        ];
        //dd(User::where('user_id',1)->toSql());
        $validator = Validator::make($req->all(), $rules, $messages);

        if(!empty($validator->messages()->all())){
            dd($validator->messages()->all());
        }

        $user = new User;

        return $user->addUser($req->all());
    }

    public function getUsers(){
        $response = array();
        $data = User::get();
        $response['status'] = !empty($data) ? 200 : 204;
        $response['data'] = $data;
        dd($response);
        return json_encode($response); 
    }

    public function getUser($id){
        $response = array();
        $data = User::find($id);
        $response['status'] = !empty($data) ? 200 : 204;
        $response['data'] = $data;
        dd($response);
        return json_encode($response); 
    }
}
