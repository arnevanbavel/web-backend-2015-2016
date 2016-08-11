<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['post_id', 'comment', 'user_id'];

    /**
     * Get comments that have no parents
     * 
     * @return Collection
     
    //First, you need to create scopes on the model
    public function scopeByParent($query, $parentId, $order = 'asc') {
        return $query->where('parent_id', $parentId)->orderBy('created_at', $order);
    }

    public function scopeForPost($query, $postId) {
        return $query->where('post_id', $postId);
    }

//Then, change your existing methods...
    public static function root_comments($postId) {
        return self::byParent(0, 'desc')->forPost($postId)->get();
    }

    public static function child_comments($parent_id, $order = 'asc') {
        return self::byParent($parent_id, $order)->get();
    }
    */
    /**
     * Gets Parent Comment object
     * 
     * @return null/Comment
     */
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
