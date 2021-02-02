<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class Medal extends Model
{
    protected $table = 'medals';
    protected $fillable = ['name','count','type'];
    public static function validateRules($id=null){
        if($id)    return array(
            'name'=>'required|max:255',
            'count'=>'required',
            'type'=>'required',
        );
        return array(
            'name'=>'required|max:255',
            'count'=>'required',
            'image'=>'required',
            'type'=>'required',
        );
    }
    public function assign($request){
        foreach($this->fillable as $property){
            $this->{$property} = $request->input($property);
        }
    }
}
