<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moderator extends Model
{
    protected $fillable = ['user_id'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function posts() {
        return $this->belongsTo('App\Post');
    }
}
