<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository
{
    protected array $fieldSearchable = [
        'fname',
        'lname',
        'birthdate',
        'address',
        'email',
        'gender',
        'phonenum',
        'password'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return User::class;
    }

    public function checkAdminRole(){
        $user = Auth::user();

        if (!$user->hasRole('Admin')) {
            abort(403);
        }
    }

    public function checkStudentRole(){
        $user = Auth::user();

        if (!$user->hasRole('Student')) {
            abort(403);
        }
    }

    public function checkTeacherRole()
    {
        $user = Auth::user();

        if (!$user->hasRole('Teacher')) {
            abort(403);
        }
    }

    public function checkParentRole(){
        $user = Auth::user();

        if (!$user->hasRole('Teacher')) {
            abort(403);
        }
    }
}
