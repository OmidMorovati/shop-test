<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();


        /** @var Role $admin */
        /** @var Role $seller */
        /** @var Role $customer */
        $admin                 = Role::create(['name' => Role::ADMIN]);
        $seller                = Role::create(['name' => Role::SELLER]);
        $customer              = Role::create(['name' => Role::CUSTOMER]);
        // create permissions
        Permission::create(['name' => Permission::ADD_SELLER]);
        Permission::create(['name' => Permission::CREATE_PANEL]);
        Permission::create(['name' => Permission::ADD_PRODUCTS]);

        $seller->givePermissionTo(Permission::ADD_PRODUCTS);

        $admin->givePermissionTo([Permission::ADD_SELLER, Permission::CREATE_PANEL]);
    }
}
