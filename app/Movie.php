<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function bill_item(){
        return $this->belongsToMany(Bill_item::class);
    }
    public function rating(){
        return $this->hasMany(Rating::class);
    }

    public function comment(){
        return $this->hasMany(Comment::class);
    }

}
