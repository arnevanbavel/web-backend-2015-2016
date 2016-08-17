<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $fillable = [
        'title',
        'link'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function votes() {
        return $this->hasMany('App\Vote');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }
    
    public function moderators() {
        return $this->hasMany('App\Moderator');
    }
}
