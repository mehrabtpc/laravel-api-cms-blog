<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name','description'];
    //use:spatie media
    //'many to many' relationship post
    //
    //

    public function post(){
        return $this->belongsToMany(Post::class);
    }
}
