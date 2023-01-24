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
            'users_groups_update',
            'users_groups_edit',
            'users_subjects_update',
            'users_subjects_edit',
            'users_parents_update',
            'users_parents_edit',
            'users_teachers_update',
            'users_teachers_edit',
            'subjects_access',
            'subjects_create',
            'subjects_store',
            'subjects_show',
            'subjects_edit',
            'subjects_update',
            'subjects_destroy',
            'subjects_users_update',
            'subjects_users_edit',
            'subjects_groups_update',
            'subjects_groups_edit',
            'groups_access',
            'groups_create',
            'groups_store',
            'groups_show',
            'groups_edit',
            'groups_update',
            'groups_destroy',
            'group_users_update',
            'groups_users_edit',
            'groups_subjects_update',
            'groups_subjects_edit',
            'profiles_access',
            'profiles_show',
            'profiles_edit',
            'profiles_update',
            'profile_edit',
            'profile_update',
            'roles_update',
            'permission_widget',
            'user_picture_edit',
            'user_picture_update',
            'users_picture_edit',
            'users_picture_update',
            'grades_access',
            'grades_create',
            'grades_store',
            'grades_show',
            'grades_edit',
            'grades_update',
            'grades_destroy',
            'grades_teacher_table',
            'grades_student_table',
            'print_grades',
            'print_groups',
            'print_profiles',
            'print_subjects',
            'print_users',
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
            'user_picture_edit',
            'user_picture_update',
            'grades_student_table',
            'grades_access',
            'grades_show',
        ];

        $parentPermissions = [
            'dashboard_access',
            'parent_widget',
            'profiles_access',
            'profile_edit',
            'profile_update',
            'user_picture_edit',
            'user_picture_update'
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
            'user_picture_edit',
            'user_picture_update',
            'users_picture_edit',
            'users_picture_update',
            'grades_access',
            'grades_create',
            'grades_store',
            'grades_show',
            'grades_edit',
            'grades_update',
            'grades_destroy',
            'grades_teacher_table',
            'print_grades',
            'print_groups',
            'print_profiles',
            'print_subjects',
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
