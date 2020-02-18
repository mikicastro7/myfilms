<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{

    protected $table = 'ratings';

    public $fillable = ['rating', 'user_id'];

    /**
     * @return mixed
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
