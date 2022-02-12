<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $adminPermissions=[
            'manage users',
            'manage roles',
            'manage posts',
            'manage categories',
            'manage comments',

        ];

        $writerPermissions=[
            'manage posts',
            'manage categories',
            'manage comments',

        ];

        $userPermissions=[
            'manage comments',
        ];

        $admin=Role::create([
            'name' => 'admin',
            'guard_name'=> 'admin-api'
        ]);
        $admin->givePermissionTo($adminPermissions);

        $writer=Role::create([
            'name' => 'writer',
            'guard_name'=> 'admin-api'
        ]);
        $writer->givePermissionTo($writerPermissions);

        $user=Role::create([
            'name' => 'user',
            'guard_name'=> 'admin-api'
        ]);
        $user->givePermissionTo($userPermissions);


    }
}
