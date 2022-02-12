<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions=[
           'manage users',
            'manage posts',
            'manage categories',
            'manage comments',
            'manage roles',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission,'guard_name'=>'admin-api']);
        }
    }
}
