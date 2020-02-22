<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Film;
use Validator;
use DB;

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
		//dd($req->file('file'));
		//dd($req->file('file')->getClientOriginalExtension());
		//dd(storage_path());
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

		// if(!is_dir(resource_path('posters'))){
  //   		mkdir(resource_path('/posters'));
  //   	}

  //   	if(!is_dir(resource_path('/posters/'.$req->get('title')))){
  //   		mkdir(resource_path('/posters/'.$req->get('title')));
  //   	}   	

    	//$image = $req->file('file');
    	// $wm = Image::make(public_path('/images/film.png'))->resize(50,50);

    	// $image->insert($wm, 'bottom-left');

    	//$directory = resource_path('/posters/'.$req->get('title'));

    	// $image_name = $req->get('title').'.'.$req->file('file')->getClientOriginalExtension();

    	//$image_name = $req->get('filename');
    	//dd($image_name);

    	//$image->move($directory,$image_name);

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
		})->when(!empty($req->get('search')),function($q)use($req){
			$search_str = $req->get('search');
			return $q->where('title','like',"%$search_str%");
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

	public function getGenre($id,Request $req){
        //dd($id);
        $response = array();
        $data = Film::when(!empty($id),function($q)use($id){
			return $q->where('genre_id','=',$id);
		})->get();
        $response['status'] = !empty($data) ? 200 : 204;
        $response['data'] = $data;
        //dd($response);
        return json_encode($response);    
    }

    public function getStudios($id,Request $req){
        //dd($id);
        $response = array();
        $data = Film::when(!empty($id),function($q)use($id){
			return $q->where('studio_id','=',$id);
		})->get();
        $response['status'] = !empty($data) ? 200 : 204;
        $response['data'] = $data;
        //dd($response);
        return json_encode($response);    
    }

    public function showFilms(){
		//dd('api');
		$response = array();
		$data = '';
		$data = Film::all();
		//dd($data);
		$response['status'] = !empty($data) ? 200 : 204;
		$response['data'] = $data;
		//dd($response);
		return json_encode($response); 
	}

	public function destroy($id){
		//dd('api destroy'.$id);
		$response = array();
    $data = Film::find($id);
    if($data->delete()){
    	$response['status'] = 200 ;
    	$response['message'] ='film deleted';    		
    }else{
    	$response['status'] = 204 ;
    	$response['message'] ='error while deleting';
    };    
    //dd($response);
    return json_encode($response);
	}
	// public function update(Request $req){
	// 	dd($req->all());
	// }
	public function update(Request $req,$id){		
		//dd($req->all());
		$rules = [
         'title' =>'required',
         'year' => 'required',
         'genre' => 'required',
         'studio' => 'required',
         'plot' => 'required',
         'poster' => 'required',
    ];

    $msgs = [
      'name.min' => 'title should be minum 3 letters'
    ];

    $validator = Validator::make($req->all(),$rules,$msgs);
    //dd($validator->messages()->all());
    if(!empty($validator->messages()->all())){
      $response['status'] = 400;
      $response['message'] = 'Errors! in the form';            
      $response['errors'] = $validator->messages()->all();
      //dd($response);
      return json_encode($response);
    }
    //dd($req->all());
    //dd($id);
		$film = new Film;
		$data = [
	      'title' => $req->title,
	      'year' => $req->year,
	      'genre_id' => $req->genre,
	      'studio_id' => $req->studio,
	      'plot' => $req->plot,
	      'featured' => $req->featured,
	      'poster' => $req->poster           
	  ];

	  //dd($data);
	  //$update = DB::table('films')->where('id', $id)->update($data);
	  
	  $updatefilm = $film->updatefilm($req->all(),$id);

		if(!empty($updatefilm)){
			$response['status'] = 200;
			$response['message'] = 'Film updated successfully!';
			$response['data'] = [];
			return json_encode($response);
		}else{
			$response['status'] = 400;
			$response['message'] = 'error while updating';
			$response['data'] = [];
			return json_encode($response);
		}
	}

}





