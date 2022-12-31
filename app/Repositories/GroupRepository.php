<?php

namespace App\Repositories;

use App\Models\Group;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class GroupRepository extends BaseRepository
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
        return Group::class;
    }

    public function getUserGroupNames() : string{
        $groups = Auth::getUser()->groups;

        $groupCount = $groups->count();

        if ($groupCount > 0)
        {
            $userGroupList = [];

            for ($i = 0; $i < $groupCount; $i++)
            {
                $userGroupList[$i] = $groups[$i]['name'];
            }

            return implode(', ', $userGroupList);
        }
        else{
            return 'No groups';
        }
    }
}
