<?php

namespace App\Repositories;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

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

    /**
     * Get a list of the user's subjects as a string.
     *
     * @return string|RedirectResponse
     */
    public function getSubjectNames(): string|RedirectResponse
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

    /**
     * Get a list of the subject's users as a string by specified id.
     *
     * @param int $id
     * @return string|RedirectResponse
     */
    public function getSubjectUserNames(int $id): string|RedirectResponse
    {
        $subject = Subject::find($id);

        if (!$subject) {
            Flash::error('User not found');
            return redirect()->back();
        }

        $users = $subject->users;
        if ($users->isEmpty()) {
            return 'No users';
        }

        $userNames = $users->map(function ($user) {
            return $user['fname'] . ' ' . $user['lname'];
        });

        return implode(', ', $userNames->all());
    }

    /**
     * Get a list of the user's subjects as a string by specified id.
     *
     * @param int $id
     * @return string|RedirectResponse
     */
    public function getUserSubjectNames(int $id): string|RedirectResponse
    {
        $user = User::find($id);

        if (!$user) {
            Flash::error('User not found');
            return redirect()->back();
        }

        $subjects = $user->subjects;
        if ($subjects->isEmpty()) {
            return 'No users';
        }

        $subjectNames = $subjects->map(function ($subject) {
            return $subject['name'];
        });

        return implode(', ', $subjectNames->all());
    }

}
