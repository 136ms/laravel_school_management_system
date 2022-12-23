<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

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
            'admin_access',
            'user_access',
            'user_create',
            'user_show',
            'user_update',
            'user_delete',
            'group_access',
            'group_create',
            'group_show',
            'group_update',
            'group_delete',
            'subject_access',
            'subject_create',
            'subject_show',
            'subject_update',
            'subject_delete',
            'profiles_access'
        ];

        $studentPermissions = [
            'user_access',
            'user_update',
            'group_access',
            'group_show',
            'subject_access',
            'subject_show',
            'profiles_access',
        ];

        $parentPermissions = [
            'profiles_access',
            'user_access',
            'user_update',
            'group_access',
            'group_show',
            'subject_access',
            'subject_show',
        ];

        $teacherPermissions = [
            'profiles_access',
            'user_access',
            'user_show',
            'user_update',
            'group_access',
            'group_show',
            'group_update',
            'subject_access',
            'subject_show',
            'subject_update',
        ];

        foreach ($permissions as $permission){
            Permission::create(['name' => $permission]);
        }

        // Grant all permissions to admin role
        foreach ($permissions as $permission){
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
