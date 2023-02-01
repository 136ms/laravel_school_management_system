<?php

namespace App\Repositories;

use App\Models\Grade;
use App\Models\User;

class GradeRepository extends BaseRepository
{
    protected array $fieldSearchable = [
        'subject_id',
        'author_id',
        'user_id',
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

    public function calculateGradesAverage($gradeList) : string
    {
        $totalWeight = 0;
        $totalGradePoint = 0;
        foreach ($gradeList as $grade) {
            $weight = $grade['weight'];
            $gradePoint = $grade['grade'];
            $totalWeight += $weight;
            $totalGradePoint += $weight * $gradePoint;
        }
        return $totalGradePoint / $totalWeight;
    }
}
