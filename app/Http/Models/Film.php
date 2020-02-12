<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Film extends Model
{
    protected $table = 'films';
    protected $primaryKey = 'id';

    public function addfilm($values){
    	//dd('model');
    	//dd($values);
    	$data = [
    		'title' => $values['title'],
    		'year' => $values['year'],
    		'genre_id' => $values['genre'],
    		'studio_id' => $values['studio'],
    		'plot' => $values['plot'],
            'featured' => $values['featured'],
            'poster' => $values['poster']    		
    	];
    	//dd($data);
    	return DB::table($this->table)->insert($data);
    	//dd('success');
    }

    public function updatefilm($values,$id){
        //dd($id);
        //dd($values);
        $data = [
            'title' => $values['title'],
            'year' => $values['year'],
            'genre_id' => $values['genre'],
            'studio_id' => $values['studio'],
            'plot' => $values['plot'],
            'featured' => $values['featured'],
            'poster' => $values['poster']           
        ];
        //dd($data);
        return DB::table($this->table)
                ->where('id', $id)
                ->update($data);
        // return DB::table($this->table)->insert($data);
        // //dd('success');
    }
    
    
} 