<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['comment', 'artikel_id', 'user_id', 'updated_at', 'created_at'];

 
   
    public function parent(){
        $result = null;
        if($this->parent_id > 0)
            $result = self::find($this->parent_id);
        return $result;
    }

    public function artikels() {
        return $this->belongsTo('App\Artikel', 'artikel_id');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

}
