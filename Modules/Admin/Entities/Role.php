<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name','guard_name'];

    public function role(){
        return $this->hasMany(Permission::class);
    }
}
