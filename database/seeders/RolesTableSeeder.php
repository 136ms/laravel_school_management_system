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
            'dashboard_access',
            'admin_access',
            'student_access',
            'teacher_access',
            'parent_access',
            'users_access',
            'users_create',
            'users_store',
            'users_show',
            'users_edit',
            'users_update',
            'users_destroy',
            'subjects_access',
            'subjects_create',
            'subjects_store',
            'subjects_show',
            'subjects_edit',
            'subjects_update',
            'subjects_destroy',
            'groups_access',
            'groups_create',
            'groups_store',
            'groups_show',
            'groups_edit',
            'groups_update',
            'groups_destroy',
            'profiles_access',
            'profiles_show',
            'profiles_edit',
            'profiles_update',
            'profiles_edit_users',
        ];

        $adminPermissions = [
            'admin_access'
        ];

        $studentPermissions = [
            'dashboard_access',
            'student_access',
            'profiles_access',
            'profiles_edit',
            'profiles_update',
            'profiles_edit',
        ];

        $parentPermissions = [
            'dashboard_access',
            'parent_access',
            'profiles_access',
            'profiles_edit',
            'profiles_update',
        ];

        $teacherPermissions = [
            'users_access',
            'subjects_access',
            'groups_access',
            'users_show',
            'dashboard_access',
            'teacher_access',
            'profiles_access',
            'profiles_show',
            'profiles_edit',
            'profiles_update',
            'profiles_edit_users',
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
