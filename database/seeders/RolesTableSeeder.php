<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');
        app()['cache']->forget('spatie.role.cache');

        // Create roles
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Student']);
        Role::create(['name' => 'Parent']);
        Role::create(['name' => 'Teacher']);

        $adminRole = Role::findByName('Admin');
        $studentRole = Role::findByName('Student');
        $parentRole = Role::findByName('Parent');
        $teacherRole = Role::findByName('Teacher');

        // Create permissions
        $permissions = [
            'menu_access',
            'dashboard_access',
            'admin_access',
            'student_access',
            'teacher_access',
            'parent_access',
            'users_access',
            'subjects_access',
            'groups_access',
        ];

        $adminPermissions = [
            'menu_access',
            'dashboard_access',
            'admin_access',
            'users_access',
            'subjects_access',
            'groups_access',
        ];

        $studentPermissions = [
            'menu_access',
            'dashboard_access',
            'student_access',
        ];

        $parentPermissions = [
            'menu_access',
            'dashboard_access',
            'parent_access',
        ];

        $teacherPermissions = [
            'menu_access',
            'dashboard_access',
            'teacher_access',
        ];

        foreach ($permissions as $permission){
            Permission::create(['name' => $permission]);
        }

        // Grant all permissions to admin role
        foreach ($adminPermissions as $permission){
            $adminRole->givePermissionTo($permission);
        }

        // Grant studentPermissions to student role
        foreach ($studentPermissions as $permission){
            $studentRole->givePermissionTo($permission);
        }

        // Grant parentPermissions to parent role
        foreach ($parentPermissions as $permission){
            $parentRole->givePermissionTo($permission);
        }

        // Grant teacherPermissions to teacher role
        foreach ($teacherPermissions as $permission){
            $teacherRole->givePermissionTo($permission);
        }















    }
}
