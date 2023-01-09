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
            'student_widget',
            'teacher_widget',
            'parent_widget',
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
            'profile_edit',
            'profile_update',
            'roles_update',
            'permission_widget',
        ];

        $adminPermissions = [
            'admin_access'
        ];

        $studentPermissions = [
            'dashboard_access',
            'student_widget',
            'profiles_access',
            'profile_edit',
            'profile_update',
            'permission_widget',
        ];

        $parentPermissions = [
            'dashboard_access',
            'parent_widget',
            'profiles_access',
            'profile_edit',
            'profile_update',
            'permission_widget',
        ];

        $teacherPermissions = [
            'users_access',
            'subjects_access',
            'groups_access',
            'users_show',
            'dashboard_access',
            'teacher_widget',
            'profiles_access',
            'profiles_show',
            'profiles_edit',
            'profiles_update',
            'profile_edit',
            'profile_update',
            'users_update',
            'users_edit',
            'permission_widget',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Grant all permissions to admin role
        foreach ($adminPermissions as $permission) {
            $adminRole->givePermissionTo($permission);
        }

        // Grant studentPermissions to student role
        foreach ($studentPermissions as $permission) {
            $studentRole->givePermissionTo($permission);
        }

        // Grant parentPermissions to parent role
        foreach ($parentPermissions as $permission) {
            $parentRole->givePermissionTo($permission);
        }

        // Grant teacherPermissions to teacher role
        foreach ($teacherPermissions as $permission) {
            $teacherRole->givePermissionTo($permission);
        }
    }
}
