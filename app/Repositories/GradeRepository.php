<?php

namespace App\Repositories;

use App\Models\Grade;

class GradeRepository extends BaseRepository
{
    protected array $fieldSearchable = [
        'name',
        'grade',
        'weight'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Grade::class;
    }
}
