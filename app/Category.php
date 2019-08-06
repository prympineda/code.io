<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['name'];

    public function categories(){
        return $this->hasmany('App\Post');
    }
}
