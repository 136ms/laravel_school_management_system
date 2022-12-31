<?php

namespace App\Repositories;

use App\Models\Subject;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class SubjectRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Subject::class;
    }

    public function getUserSubjectNames() : string
    {
        $subjects = Auth::getUser()->subjects;

        $subjectsCount = $subjects->count();

        if ($subjectsCount > 0)
        {
            $userSubjectsList = [];

            for ($i = 0; $i < $subjectsCount; $i++)
            {
                $userSubjectsList[$i] = $subjects[$i]['name'];
            }

            return implode(', ', $userSubjectsList);
        }
        else{
            return 'No subjects';
        }
    }
}
