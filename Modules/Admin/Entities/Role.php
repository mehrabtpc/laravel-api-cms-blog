<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Role extends Model
{
    use HasRoles;
    protected $fillable = ['name','guard_name'];
}
