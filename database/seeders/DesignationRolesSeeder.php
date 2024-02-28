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
        $designation_sg = Role::create(['name' => 'sg']); //sg for scretery general
        $designation_pd = Role::create(['name' => 'pd']); //pd for president
        $designation_dpd = Role::create(['name' => 'dpd']); //dpd for district president

        //creating permissions to resources 
        $permission = Permission::create(['name' => 'first approval forma']);
        $permission = Permission::create(['name' => 'second approval forma']);
        $permission = Permission::create(['name' => 'first approval formb']);
        $permission = Permission::create(['name' => 'second approval formb']);
        $permission = Permission::create(['name' => 'third approval formb']);

        //assigning permissions to roles
        $designation_dpd->syncPermissions([
            'first approval forma',
            'first approval formb',
        ]);

        $designation_sg->syncPermissions([
            'second approval forma',
            'second approval formb',
        ]);

        $designation_pd->syncPermissions([
            'third approval formb',
        ]);
    }
}
