<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'votes';

    protected $fillable = [
        'value',
        'artikel_id',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function artikels() {
        return $this->belongsTo('App\Artikel');
    }
}