<?php

use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
