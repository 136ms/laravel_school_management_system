<?php

namespace App\Repositories;

use App\Models\Group;
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

    public function getUserGroupNames(): string|RedirectResponse
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
}
