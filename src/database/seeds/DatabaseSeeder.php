<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(RoleAndPermissionSeeder::class);
        foreach(config("permission.default_roles") as $role){
            \Spatie\Permission\Models\Role::create([
                'name' => $role
            ]);
        }

        foreach(config("permission.default_permissions") as $permission){
            \Spatie\Permission\Models\Permission::create([
                'name' => $permission
            ]);
        }
    }
}
