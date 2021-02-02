<?php

namespace App\Models;

use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;


class Evento extends Model
{
    protected $table = 'eventos';
    protected $fillable = ['title','description','done_date','latitude','longitude','address'];
    private $pageSize;
    private $pageNumber;
    private static $searchableColumns = ['search'];
    protected $casts = [
        'medias' => 'array',
    ];
    public static function validateRules(){
        return array(
            'title'=>'required|max:191',
            'description'=>'required',
            'latitude'=>'required|max:191',
            'longitude'=>'required|max:191',
            'done_date'=>'date_format:Y-m-d H:i:s',
            'address'=>'required|max:191',
            'images'=>'array|max:20',
            'images.*'=>'image|max:209715200',
        );
    }
    public function customers(){
        return $this->belongsToMany('App\Customer','eventos_customers','customer_id','evento_id');
    }    
    public function uploadMedias($files){
        foreach($files as $file){
            $media = new Media;
            $media->attachment="event";
            $media->uploadSingle($file);
            array_push($this->medias,$media->id);
        }
    }
    public function search(){
        $where = Evento::where(function($query){
            $query->where('title','like','%'.$this->search.'%');
            $query->orWhere('description','like','%'.$this->search.'%');
        });
        if($this->status)$where->where('status',$this->status);
        if($this->done_date)$where->where('done_date','<',$this->done_date);
        $currentPage = $this->pageNumber+1;
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });      
        $response = $where->orderBy('done_date', 'DESC')->paginate($this->pageSize);
        $items = $response->items();
        foreach($items as $index=> $evento){
            $items[$index]['created_date'] = date('M d, Y',strtotime($evento->done_date));
            $evento->category;
            $items[$index]['excerpt'] = $this->extractExcerpt($evento->description);
            if($evento->image)  $evento->image = url('storage/'.$evento->image);        
            if($evento->done_date){
                $dates = explode(' ',$evento->done_date);
                $items[$index]['date'] = $dates[0];
                $items[$index]['datetime'] = substr($dates[1],0,5);
                $items[$index]['participants'] = $evento->customers->count();
            }      
        }
        return $response;
    }
    public function extractExcerpt($html){
        $text_to_strip = strip_tags(html_entity_decode($html));
        $length = mb_strlen($text_to_strip);
        $max = 280;
        if($length>$max){
            $stripped = mb_substr($text_to_strip,0,$max).'...';
        }else{
            $stripped = $text_to_strip;
        }
        return $stripped;
    }
    public function assignSearch($request){
        foreach(self::$searchableColumns as $property){
            if($request->exists($property)){
                $this->{$property} = $request->input($property);
            }
        }
        if($request->exists('status')){
            $this->status = $request->input('status');
        }
        $this->pageSize = $request->input('pageSize');
        $this->pageNumber = $request->input('pageNumber');
    }
    public function assignFrontSearch($request){
        $this->search = null;
        $this->status = 'Publish';
        $this->done_date = date("Y-m-d H:i:s");
        $this->pageSize = $request->input('pageSize');
        $this->pageNumber = $request->input('pageNumber');
    }
    // public function resizeImage($photoPath,$fileNameUpdate)
    // {   
    //     $resizeImg = Image::make('storage/' . $photoPath.'/'.$fileNameUpdate);
    //     $height = $resizeImg->height();
    //     $width = $resizeImg->width();
    //     if($width>720){
    //         $cropWidth = 720;
    //         $cropHeight = 720/$width*$height;
    //         $resizeImg->crop($width, $height, 0, 0)
    //         ->resize($cropWidth, $cropHeight, function($constraint) {
    //             $constraint->aspectRatio();
    //         });
    //     }
    //     $resizeImg->save('storage/' . $photoPath .'/m/'.$fileNameUpdate);
    // }
}
