<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'fname',
        'lname',
        'birthdate',
        'address',
        'email',
        'gender',
        'phonenum',
        'password'
    ];

    public function update(array $input, int $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $model->fill($input);

        $model['password'] = Hash::make($model['password']);

        $model->save();

        return $model;
    }

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return User::class;
    }
}
