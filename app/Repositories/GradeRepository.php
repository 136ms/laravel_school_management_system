<?php

namespace App\Repositories;

use App\Models\Grade;

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

    public function calculateGradesAverage($gradeList): float
    {
        $grades = collect($gradeList);

        $gradePoints = $grades->pluck('grade')->filter()->toArray();
        $weights = $grades->pluck('weight')->filter()->toArray();

        if (empty($gradePoints) || empty($weights)) {
            return 0.0;
        }
        $weightedGrades = array_map(function ($grade, $weight) {
            return $grade * $weight;
        }, $gradePoints, $weights);

        $average = array_sum($weightedGrades) / array_sum($weights);

        return round($average, 2);
    }
}
