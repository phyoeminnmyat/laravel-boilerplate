<?php

namespace Modules\AppSetting\Database\Seeders;

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AppSettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();

        // $this->call("OthersTableSeeder");

        // Create Roles
        $admin = Role::where('name',config('access.users.admin_role'))->first();

        $lower_module = strtolower('AppSetting');
        // Create Permissions
        Permission::create(['name' => 'manage '.$lower_module]);
        // ALWAYS GIVE ADMIN ROLE ALL PERMISSIONS
        $admin->givePermissionTo('manage '.$lower_module);
        // Create Permissions
        Permission::create(['name' => 'view '.$lower_module]);
        // ALWAYS GIVE ADMIN ROLE ALL PERMISSIONS
        $admin->givePermissionTo('view '.$lower_module);
        // Create Permissions
        Permission::create(['name' => 'edit '.$lower_module]);
        // ALWAYS GIVE ADMIN ROLE ALL PERMISSIONS
        $admin->givePermissionTo('edit '.$lower_module);
    }
}