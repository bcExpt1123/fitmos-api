<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['customer_id','content','activity_id','location','tag_follers'];
    protected $casts = [
        'tag_follers' => 'array',
    ];
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
}
