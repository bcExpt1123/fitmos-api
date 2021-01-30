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
}
