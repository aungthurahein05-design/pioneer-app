<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Permissions
        $permissions = [

            'dashboard',

            'teacher.view',
            'teacher.create',
            'teacher.edit',
            'teacher.delete',

            'subject.view',
            'subject.create',
            'subject.edit',
            'subject.delete',


        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Roles
        $admin      = Role::firstOrCreate(['name' => 'Admin']);
        $staff      = Role::firstOrCreate(['name' => 'Staff']);
        $teacher    = Role::firstOrCreate(['name' => 'Teacher']);
        $student    = Role::firstOrCreate(['name' => 'Student']);

        // Assign permissions
        $admin->givePermissionTo(Permission::all());

        $staff->givePermissionTo([

           'dashboard',

            'teacher.view',
            'teacher.create',
            'teacher.edit',
           

            'subject.view',
            'subject.create',
            'subject.edit',
           
        ]);

        $teacher->givePermissionTo([

           'dashboard',

            'subject.view',
            'subject.create',
            'subject.edit',
           
        ]);

        $student->givePermissionTo([

           'dashboard',

            'subject.view',
           
           
        ]);
    }
}
