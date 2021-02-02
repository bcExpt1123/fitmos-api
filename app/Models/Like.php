<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    protected $fillable = ['customer_id','activity_id'];
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
    public function activity()
    {
        return $this->belongsTo('App\Models\Activity', 'activity_id');
    }
    public static function validateRules(){
        return array(
            'activity_id'=>'numerical',
        );
    }
}
