<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DesignationRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $designation_sg = Role::create(['name' => 'sg']);
        $designation_president = Role::create(['name' => 'president']);

        //creating permissions to resources 
        $permission = Permission::create(['name' => 'initial approval forma']);
        $permission = Permission::create(['name' => 'final approval forma']);
        $permission = Permission::create(['name' => 'initial approval formb']);
        $permission = Permission::create(['name' => 'final approval formb']);
        
        //assigning permissions to roles
        $designation_sg->syncPermissions([
            'initial approval forma',
            'initial approval formb',
        ]);

        $designation_president->syncPermissions([
            'final approval forma',
            'final approval formb',
        ]);

    }
}
