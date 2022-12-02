<?php

namespace App\Repositories;

use App\Models\Classes;
use App\Repositories\BaseRepository;

class ClassesRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'class_name'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Classes::class;
    }
}
