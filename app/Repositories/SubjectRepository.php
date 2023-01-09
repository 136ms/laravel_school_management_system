<?php

namespace App\Repositories;

use App\Models\Subject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class SubjectRepository extends BaseRepository
{
    protected array $fieldSearchable = [
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

    /**
     * Get a list of the user's groups as a string.
     *
     * @return string|RedirectResponse
     */
    public function getUserSubjectNames(): string|RedirectResponse
    {
        $user = Auth::user();
        if (!$user) {
            return 'No user authenticated';
        }

        $subjects = $user->subjects;
        if ($subjects->isEmpty()) {
            return 'No subjects';
        }

        $subjectNames = $subjects->map(function ($subject) {
            return $subject['name'];
        });

        return implode(', ', $subjectNames->all());
    }

}
