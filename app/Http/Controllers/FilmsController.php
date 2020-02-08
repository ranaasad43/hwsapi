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
		//dd('addfilm');

		$response = array();

		 $rules = [
			 //'name' => 'min:3|alpha',
		//     'user_name' => 'min:3|alpha_num|unique:users',
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
			dd($response);
			return json_encode($response);
		}

		$film = new Film;

		$addfilm = $film->addfilm($req->all());

		if(!empty($addfilm)){
			$response['status'] = 200;
			$response['message'] = 'Film added successfully!';
			$response['data'] = [];
			//dd($response);
			return json_encode($response);
		}
	}

	public function getFilms(Request $req){
		//dd($req->all());
		$response = array();
		$data = '';
		$data = Film::when(!empty($req->get('genre_id')),function($q)use($req){
			return $q->where('genre_id','=',$req->get('genre_id') );
		})->when(!empty($req->get('studio_id')),function($q)use($req){
			return $q->where('studio_id','=',$req->get('studio_id') );
		})->when(!empty($req->get('featured')),function($q)use($req){
			return $q->where('featured','=',1);
		})->get();
		//dd($data);
		$response['status'] = !empty($data) ? 200 : 204;
		$response['data'] = $data;
		//dd($response);
		return json_encode($response); 
	}

	public function getFilm($id){
		//dd("api");
		$response = array();
		$data = Film::find($id);
		$response['status'] = !empty($data) ? 200 : 204;
		$response['data'] = $data;
		//dd($response);
		return json_encode($response); 
	}

	// public function login(Request $req){
	// 	 //dd($req->all());
	// 	$email = $req->get('email');
	// 	$pass = $req->get('password');
	// 	//$pass = 123456;

	// 	$response = array();
	// 	$params = array();

	// 	$params['email'] = !empty($email) ? $email : '';
	// 	$params['password'] = !empty($pass) ? $pass : '';

	// 	$data = User::where($params)->first();
		
	// 	$response['status'] = !empty($data) ? 200 : 204;
	// 	$response['data'] = $data;

	// 	//dd($response);
	// 	return json_encode($response);
		
	// }
}
