<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    protected array $fieldSearchable = [
        'fname',
        'lname',
        'birthdate',
        'address',
        'email',
        'gender',
        'phonenum',
        'password'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return User::class;
    }

    public function getUserTeacherNames(): string
    {
        $teachers = Auth::getUser()->teachers;

        $teachersCount = $teachers->count();

        if ($teachersCount > 0) {
            $userTeacherFnameList = [];
            $userTeacherLnameList = [];
            $userTeacherList = [];

            for ($i = 0; $i < $teachersCount; $i++) {
                $userTeacherFnameList[$i] = $teachers[$i]['fname'];
            }

            for ($i = 0; $i < $teachersCount; $i++) {
                $userTeacherLnameList[$i] = $teachers[$i]['lname'];
            }

            for ($i = 0; $i < $teachersCount; $i++) {
                $userTeacherList[$i] = $userTeacherFnameList[$i] . ' ' . $userTeacherLnameList[$i];
            }

            return implode(', ', $userTeacherList);
        } else {
            return 'No teachers';
        }
    }

    public function getUserChildrenNames(): string
    {
        $children = Auth::getUser()->children;

        $childrenCount = $children->count();

        if ($childrenCount > 0) {
            $userChildrenFnameList = [];
            $userChildrenLnameList = [];
            $userChildrenList = [];

            for ($i = 0; $i < $childrenCount; $i++) {
                $userChildrenFnameList[$i] = $children[$i]['fname'];
            }

            for ($i = 0; $i < $childrenCount; $i++) {
                $userChildrenLnameList[$i] = $children[$i]['lname'];
            }

            for ($i = 0; $i < $childrenCount; $i++) {
                $userChildrenList[$i] = $userChildrenFnameList[$i] . ' ' . $userChildrenLnameList[$i];
            }

            return implode(', ', $userChildrenList);
        } else {
            return 'No children';
        }
    }

    public function getUserParentNames(): string
    {
        $parents = Auth::getUser()->parents;

        $parentsCount = $parents->count();

        if ($parentsCount > 0) {
            $userParentsFnameList = [];
            $userParentsLnameList = [];
            $userParentsList = [];

            for ($i = 0; $i < $parentsCount; $i++) {
                $userParentsFnameList[$i] = $parents[$i]['fname'];
            }

            for ($i = 0; $i < $parentsCount; $i++) {
                $userParentsLnameList[$i] = $parents[$i]['lname'];
            }

            for ($i = 0; $i < $parentsCount; $i++) {
                $userParentsList[$i] = $userParentsFnameList[$i] . ' ' . $userParentsLnameList[$i];
            }

            return implode(', ', $userParentsList);
        } else {
            return 'No parents';
        }
    }

    public function getUserRoleNames(): string
    {
        $roles = Auth::getUser()->roles;

        $rolesCount = $roles->count();

        if ($rolesCount > 0) {
            $userRolesList = [];

            for ($i = 0; $i < $rolesCount; $i++) {
                $userRolesList[$i] = $roles[$i]['name'];
            }

            return implode(', ', $userRolesList);
        } else {
            return 'No parents';
        }
    }

    public function getUserPermissions()
    {
        $permissions = Auth::user()->getAllPermissions();

        $permissionsCount = $permissions->count();

        if ($permissionsCount > 0) {
            $userPermissionsList = [];

            for ($i = 0; $i < $permissionsCount; $i++) {
                $userPermissionsList[$i] = $permissions[$i]['name'];
            }
            return implode(', ', $userPermissionsList);
        } else {
            return 'No permissions';
        }

    }

}
