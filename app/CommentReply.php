<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    //
    protected $fillable = [
        'comment_id',
        'user_id',
        'is_active',
        'body'
    ];

    public function comment(){
        return $this->belongsto('App\Comment');
    }

    public function user(){
        return $this->belongsto('App\User');
    }

    public function post(){
        return $this->belongsTo('App\Post');
    }


}
