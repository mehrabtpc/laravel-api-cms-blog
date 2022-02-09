<?php

namespace Modules\Admin\Entities;
use Modules\Blog\Entities\Post;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\Model;
class Admin extends Model
{
    use HasRoles;

    protected $fillable = ['name','username','mobile','email','password'];
    protected $hidden = ['password'];

    public function post(){
        return $this->hasMany(Post::class);
    }
}
