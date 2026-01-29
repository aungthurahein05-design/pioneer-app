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

            'event.view',
            'event.create',
            'event.edit',
            'event.delete',

           'promotion.view',
            'promotion.create',
            'promotion.edit',
            'promotion.delete',

            'exam-result.view',
            'exam-result.create',
            'exam-result.edit',
            'exam-result.delete',

            'classroom.view',
            'classroom.create',
            'classroom.edit',
            'classroom.delete',

            'section.view',
            'section.create',
            'section.edit',
            'section.delete',

            'student.view',
            'student.create',
            'student.edit',
            'student.delete',
            
            'enroll.view',
            'enroll.create',
            'enroll.edit',
            'enroll.delete',

            

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

            'event.view',
            'event.create',
            'event.edit',

             'promotion.view',
            'promotion.create',
            'promotion.edit',

            'exam-result.view',
            
            'classroom.view',
            'classroom.create',
            'classroom.edit',

            'section.view',
            'section.create',
            'section.edit',

            
            'student.view',
            'student.create',
            'student.edit',
           
            
            'enroll.view',
            'enroll.create',
            'enroll.edit',
            'enroll.delete',

        ]);

        $teacher->givePermissionTo([

           'dashboard',

            'subject.view',
            'subject.create',
            'subject.edit',


            'event.view',

            'exam-result.view',
            'exam-result.create',
            'exam-result.edit',
            'exam-result.delete',
           
            
            'classroom.view',

            'section.view',
            
            'student.view',
           

        ]);

        $student->givePermissionTo([

           'dashboard',
           'teacher.view',
            'subject.view',
            'exam-result.view',
            'event.view',
            'promotion.view',
            
            'classroom.view',
            'section.view',
            
           
        ]);
    }
}
