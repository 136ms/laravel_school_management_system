<?php

namespace App\Repositories;

use App\Models\User;

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
}
