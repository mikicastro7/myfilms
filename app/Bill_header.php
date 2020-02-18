<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill_header extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bill_items(){
        return $this->hasMany('App\Bill_item');
    }
}
