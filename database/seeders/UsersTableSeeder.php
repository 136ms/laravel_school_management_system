<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
        User::factory(10)
            // create teachers
            ->has(User::factory(1), 'teachers')
            ->create();

        // $users = User::all(); // all users with parents;

        // connect all generated students to groups and subjects (parents don`t)
        $users->each(function (User $user) use ($subjects, $groups) {
           $user->groups()->sync($groups);
           $user->subjects()->sync($groups[0]->subjects);
        });

    }
}
