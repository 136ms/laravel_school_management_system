<?php

namespace App\Repositories;

use App\Models\Grade;
use App\Models\User;
use Laracasts\Flash\Flash;

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

    public function calculateGradesAverage($gradeList): string
    {
        $total = 0;
        $weight_sum = 0;
        foreach ($gradeList as $grade) {
            if (!isset($grade['grade_point']) || !isset($grade['weight'])) {

                return false;
            }
            $total += $grade['grade_point'] * $grade['weight'];
            $weight_sum += $grade['weight'];
        }
        if ($weight_sum === 0) {
            Flash::error('You have no grades');
            return false;
        }
        return $total / $weight_sum;
    }
}
