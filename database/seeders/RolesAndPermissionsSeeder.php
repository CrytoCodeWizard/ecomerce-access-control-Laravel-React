<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => "edit product"]);
        Permission::create(["name" => "delete product"]);

        // Create Roles and Sssign existing permissions
        $role1 = Role::create(["name" => "editor"]);
        $role1->givePermissionTo("edit product");

        $role2 = Role::create(["name" => "admin"]);
        $role2->givePermissionTo(Permission::all());

    }
}
