<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['customer_id','post_id','activity_id','parent_activity_id','level0','level1'];
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }
}
