<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;


class Post extends Model implements SluggableInterface
{
    //

    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'title',
        'save_to' => 'slug',
        'on_update' => true,
    ];

    protected $fillable = [
        'category_id',
        'photo_id',
        'title',
        'body'

    ];

    public function user(){
        return $this->belongsTo('App\User');
    }


    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    public function comment(){
        return $this->hasMany('App\Post');
    }

    public function categories(){
        return $this->belongsTo('App\Category');
    }

    public function commentreply(){
        return $this->hasmany('App\CommentReply');
    }
  
}
