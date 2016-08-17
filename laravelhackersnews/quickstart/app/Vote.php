<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'votes';

    protected $fillable = [ 'artikel_id', 'user_id', 'up', 'down', 'algeklikt'];

    
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function artikels() {
        return $this->belongsTo('App\Artikel');
    }
}