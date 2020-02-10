<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Genre;
use Validator;

class GenresController extends Controller
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

    public function getGenres(Request $req){
        $response = array();
        $data = Genre::get();
        $response['status'] = !empty($data) ? 200 : 204;
        $response['data'] = $data;
        //dd($response);
        return json_encode($response); 
    }

    // public function getGenre($id,Request $req){
    //     //dd($id);
    //     $response = array();
    //     $data = Genre::where('genre_id','=',$id);
    //     $response['status'] = !empty($data) ? 200 : 204;
    //     $response['data'] = $data;
    //     dd($response);
    //     return json_encode($response);    
    // }


}
