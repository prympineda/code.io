<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'post_id',
        'user_id',
        'author',
        'email',
        'body',
        'is_active'
    ];

    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function user(){
        return $this->belongsto('App\User');
    }

    public function commentreply(){
        return $this->hasmany('App\CommentReply');
    }

}
