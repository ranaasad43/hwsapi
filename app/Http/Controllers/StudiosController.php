<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Studio;
use Validator;

class StudiosController extends Controller
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

    public function getStudios(Request $req){
        $response = array();
        $data = Studio::get();
        $response['status'] = !empty($data) ? 200 : 204;
        $response['data'] = $data;
        dd($response);
        return json_encode($response); 
    }


}
