<?php

namespace Modules\Admin\Entities;

use Modules\Blog\Entities\Post;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Model;
class Admin extends Authenticatable
{
    use HasRoles,HasApiTokens,Notifiable,HasPermissions;

    protected $fillable = ['name','username','mobile','email','password'];
    protected $hidden = ['password'];

    public function post(){
        return $this->hasMany(Post::class);
    }


}
