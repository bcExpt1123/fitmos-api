<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = ['customer_id','type','content'];
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
}
