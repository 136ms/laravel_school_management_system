<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class UsersTableSeeder extends Seeder
{
    use HasRoles;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seed admin user
        /** @var User $admin */
        $admin = User::factory()
            ->create([
                'email' => 'admin@role.com',
                'password' => Hash::make('admin'),
            ]);
        $adminRole = Role::findByName('Admin');
        $admin->assignRole($adminRole);

        // seed parent1 user
        /** @var User $parent1 */
        $parent1 = User::factory()
            ->create([
                'email' => 'parent@role.com',
                'password' => Hash::make('parent1'),
            ]);
        $parentRole = Role::findByName('Parent');
        $parent1->assignRole($parentRole);

        // seed parent2 user
        /** @var User $parent2 */
        $parent2 = User::factory()
            ->create([
                'email' => 'parent2@role.com',
                'password' => Hash::make('parent2'),
            ]);
        $parentRole = Role::findByName('Parent');
        $parent2->assignRole($parentRole);

        // seed student user
        /** @var User $student */
        $student = User::factory()
            ->create([
                'email' => 'student@role.com',
                'password' => Hash::make('student'),
            ]);
        $studentRole = Role::findByName('Student');
        $student->assignRole($studentRole);

        // seed teacher user
        /** @var User $teacher */
        $teacher = User::factory()
            ->create([
                'email' => 'teacher@role.com',
                'password' => Hash::make('teacher'),
            ]);
        $teacherRole = Role::findByName('Teacher');
        $teacher->assignRole($teacherRole);
    }
}
