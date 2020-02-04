<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Film;
use Validator;

class FilmsController extends Controller
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

    public function addFilm(Request $req){
        //dd($req->all());
        dd('addfilm');

        $response = array();

         $rules = [
             //'name' => 'min:3|alpha',
             'user_name' => 'min:3|alpha_num|unique:users',
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
            $response['status'] = 400;
            $response['message'] = 'Errors! in the form';            
            $response['errors'] = $validator->messages()->all();
            //dd($response);
            return json_encode($response);
        }

        $user = new User;

        $adduser = $user->addUser($req->all());

        if(!empty($adduser)){
            $response['status'] = 200;
            $response['message'] = 'User added successfully!';
            $response['data'] = [];

            return json_encode($response);
        }
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

    public function login(Request $req){
         //dd($req->all());
        $email = $req->get('email');
        $pass = $req->get('password');
        //$pass = 123456;

        $response = array();
        $params = array();

        $params['email'] = !empty($email) ? $email : '';
        $params['password'] = !empty($pass) ? $pass : '';

        $data = User::where($params)->first();
        
        $response['status'] = !empty($data) ? 200 : 204;
        $response['data'] = $data;

        //dd($response);
        return json_encode($response);
        
    }
}
