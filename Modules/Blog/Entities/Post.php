<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Admin;
use phpDocumentor\Reflection\DocBlock\Tag;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;


class Post extends Model implements HasMedia
{
    use HasTags, InteractsWithMedia,HasTags;

    protected $fillable = [
        'title', 'description', 'content',
        'published_at', 'user_id',
    ];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function category(){
        return $this->blongsToMany(Category::class);
    }

    public function comment(){
        return $this->hasMany(Comment::class);
    }

    public function tag(){
        return $this->hasMany(Tag::class);
    }
}
