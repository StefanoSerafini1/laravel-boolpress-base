<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //mass assign
    protected $fillable=[
        'title',
        'content',
        'path_image',
        'slug',
    ];
}
