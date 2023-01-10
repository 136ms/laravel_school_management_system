<?php

namespace App\Repositories;

use App\Models\Group;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class GroupRepository extends BaseRepository
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
        return Group::class;
    }

    /**
     * Get a list of the user's groups as a string.
     *
     * @return string|RedirectResponse
     */

    public function getGroupNames(): string|RedirectResponse
    {
        $user = Auth::getUser();

        if (!$user) {
            Flash::error('No user authenticated');
            return redirect()->back();
        }

        $groups = $user->groups;
        if ($groups->isEmpty()) {
            return 'No groups';
        }

        $groupNames = $groups->map(function ($group) {
            return $group['name'];
        });

        return implode(', ', $groupNames->all());
    }

    /**
     * Get a list of the user's groups as a string by specified id.
     *
     * @param int $id
     * @return string|RedirectResponse
     */

    public function getUserGroupNames(int $id): string|RedirectResponse
    {
        $user = User::find($id);

        if (!$user) {
            Flash::error('No user authenticated');
            return redirect()->back();
        }

        $groups = $user->groups;
        if ($groups->isEmpty()) {
            return 'No groups';
        }

        $groupNames = $groups->map(function ($group) {
            return $group['name'];
        });

        return implode(', ', $groupNames->all());
    }

    /**
     * Get a list of the subject's groups as a string by specified id.
     *
     * @param int $id
     * @return string|RedirectResponse
     */
    public function getSubjectGroupNames(int $id): string|RedirectResponse
    {
        $subject = Subject::find($id);

        if (!$subject) {
            Flash::error('User not found');
            return redirect()->back();
        }

        $groups = $subject->groups;
        if ($groups->isEmpty()) {
            return 'No groups';
        }

        $groupNames = $groups->map(function ($group) {
            return $group['name'];
        });

        return implode(', ', $groupNames->all());
    }

    public function getGroupUserNames(int $id): string|RedirectResponse
    {
        $group = Group::find($id);

        if (!$group) {
            Flash::error('No user authenticated');
            return redirect()->back();
        }

        $users = $group->users;
        if ($users->isEmpty()) {
            return 'No groups';
        }

        $userNames = $users->map(function ($user) {
            return $user['fname'] . ' ' . $user['lname'];
        });

        return implode(', ', $userNames->all());
    }

    /**
     * Get a list of the group's subjects as a string by specified id.
     *
     * @param int $id
     * @return string|RedirectResponse
     */
    public function getGroupSubjectNames(int $id): string|RedirectResponse
    {
        $group = Group::find($id);

        if (!$group) {
            Flash::error('User not found');
            return redirect()->back();
        }

        $subjects = $group->subjects;
        if ($subjects->isEmpty()) {
            return 'No groups';
        }

        $subjectNames = $subjects->map(function ($subject) {
            return $subject['name'];
        });

        return implode(', ', $subjectNames->all());
    }
}
