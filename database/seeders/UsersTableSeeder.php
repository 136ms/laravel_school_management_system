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
        User::factory(1)
            ->has(Group::factory(1)
                ->has(Subject::factory(1)
                    ->has(User::factory(1))))
            ->create([
                'email' => 'test@gmail.com',
                'password' => Hash::make('12345'),
            ]);

        User::factory(10)
            ->has(Group::factory(1)
                ->has(Subject::factory(1)
                    ->has(User::factory(1))))
            ->create();
    }
}
