<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateSuperAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::query()->create([
            'name'=>'mehrab',
            'username'=>'mehrab',
            'mobile'=>'09119623123',
            'email'=>'mehrabt.pc@gmail.com',
            'password'=>bcrypt('12345678'),
        ]);

        $role = Role::create(['name' => 'super-admin']);

        $admin->assignRole($role);

        $permissions = Permission::query()->get();
        $admin->givePermissionTo($permissions);
    }
}
