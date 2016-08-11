<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
     protected $table = 'users';


    public function artikels() {
        return $this->hasMany('App\Artikel');
    }

    public function votes() {
        return $this->hasManyThrough('App\Vote','App\Artikel');
    }
    
    public function moderators() {
        return $this->hasMany('App\Moderator');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
