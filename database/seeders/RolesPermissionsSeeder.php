<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::create(['name' => 'admin']);
        $role_moderator = Role::create(['name' => 'moderator']);
        $role_member = Role::create(['name' => 'member']);
        $role_applicant = Role::create(['name' => 'applicant']);
        $role_gc = Role::create(['name' => 'gc']);

        //creating permissions to resources 
        $permission = Permission::create(['name' => 'edit member']);
        $permission = Permission::create(['name' => 'show all members']);
        $permission = Permission::create(['name' => 'verify member']);
        $permission = Permission::create(['name' => 'update role']);
        $permission = Permission::create(['name' => 'update designation']);
        $permission = Permission::create(['name' => 'promote member']);
        $permission = Permission::create(['name' => 'export excel']);
        $permission = Permission::create(['name' => 'create region']);
        $permission = Permission::create(['name' => 'edit region']);
        $permission = Permission::create(['name' => 'view region']);
        $permission = Permission::create(['name' => 'add questions']);
        $permission = Permission::create(['name' => 'view questions']);
        $permission = Permission::create(['name' => 'edit questions']);
        $permission = Permission::create(['name' => 'delete questions']);
        $permission = Permission::create(['name' => 'forma submit']);
        $permission = Permission::create(['name' => 'forma view']);
        $permission = Permission::create(['name' => 'formb view']);
        $permission = Permission::create(['name' => 'formb submit']);

        //assigning permissions to roles
        $role_admin->syncPermissions([
            'edit member',
            'show all members',
            'verify member',
            'update role',
            'update designation',
            'promote member',
            'export excel',
            'create region',
            'edit region',
            'view region',
            'add questions',
            'view questions',
            'edit questions',
            'delete questions',
            'forma view',
            'forma submit',
            'formb view',
            'formb submit',
        ]);

        $role_moderator->syncPermissions([
            'edit member',
            'show all members',
            'verify member',
            'export excel',
            'create region',
            'edit region',
            'view region',
            'add questions',
            'view questions',
            'forma view',
            'formb view',
        ]);

        $role_member->syncPermissions([
            'forma view',
            'forma submit',
        ]);
        
        $role_applicant->syncPermissions([
            'formb view',
            'formb submit',
        ]);
       

    }
}
