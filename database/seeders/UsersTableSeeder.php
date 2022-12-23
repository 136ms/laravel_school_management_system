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
        /*
        // seed groups
        $groups = Group::factory(10)
            ->has(Subject::factory(10))
            ->create();

        $subjects = Subject::all();

        // seed admin user
        User::factory(1)
            ->create([
                'email' => 'test@gmail.com',
                'password' => Hash::make('12345'),
            ]);

        // seed users
        $users = User::factory(10)
            // create parents
            ->has(User::factory(2), 'parents')
                ->create();

        // seed teachers
        $teachers = User::factory(1)
            // create teachers
            ->has(User::factory(1), 'teachers')
            // create subjects
            ->has(Subject::factory(1))
            ->create();

        // $users = User::all(); // all users with parents;

        // connect all generated students to groups and subjects (parents don`t)
        $users->each(function (User $user) use ($subjects, $groups, $teachers) {
           $user->groups()->sync($groups);
           $user->teachers()->sync($teachers);
           $user->subjects()->sync($groups[0]->subjects);
        });
        */

        // seed admin user
        $admin = User::factory(1)
            ->create([
                'email' => 'admin@role.com',
                'password' => Hash::make('admin'),
            ]);
        $adminRole = Role::findByName('Admin');
        $admin[0]->assignRole([$adminRole]);

        // seed student
        $student = User::factory(1)
            ->create([
                'email' => 'student@role.com',
                'password' => Hash::make('student'),
            ]);
        $studentRole = Role::findByName('Student');
        $student[0]->assignRole([$studentRole]);

        // seed teacher
        $teacher = User::factory(1)
            ->create([
                'email' => 'teacher@role.com',
                'password' => Hash::make('teacher'),
            ]);
        $teacherRole = Role::findByName('Teacher');
        $teacher[0]->assignRole([$teacherRole]);

        // seed parent
        $parent = User::factory(1)
            ->create([
                'email' => 'parent@role.com',
                'password' => Hash::make('parent'),
            ]);
        $parentRole = Role::findByName('Parent');
        $parent[0]->assignRole([$parentRole]);

    }
}
