<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\Database\Seeders\CreateSuperAdminTableSeeder;
use Modules\Admin\Database\Seeders\PermissionsTableSeeder;
use Modules\Admin\Database\Seeders\RoleTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CreateSuperAdminTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RoleTableSeeder::class);
    }
}
