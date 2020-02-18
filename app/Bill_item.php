<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill_item extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'movie_id', 'bill_headers_id',
    ];
    public function bill_header()
    {
        return $this->belongsTo('App\Bill_header');
    }
    public function movie(){
        return $this->hasOne('App\Movie', 'id', 'movie_id');
    }
}
