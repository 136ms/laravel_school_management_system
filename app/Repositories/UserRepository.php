<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

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

    /**
     * Get a list of the user's teacher names as a string.
     *
     * @return string
     */
    public function getUserTeacherNames(): string
    {
        $user = Auth::user();
        if (!$user) {
            Flash::error('No user authenticated');
            return redirect()->back();
        }

        $teachers = $user->teachers;
        if ($teachers->isEmpty()) {
            return 'No teachers';
        }

        $teacherNames = $teachers->map(function ($teacher) {
            return $teacher['fname'] . ' ' . $teacher['lname'];
        });

        return implode(', ', $teacherNames->all());
    }

    /**
     * Get a list of the user's child names as a string.
     *
     * @return string
     */
    public function getUserChildrenNames(): string
    {
        $user = Auth::user();
        if (!$user) {
            Flash::error('No user authenticated');
            return redirect()->back();
        }

        $children = $user->children;
        if ($children->isEmpty()) {
            return 'No children';
        }

        $childNames = $children->map(function ($child) {
            return $child['fname'] . ' ' . $child['lname'];
        });

        return implode(', ', $childNames->all());
    }

    /**
     * Get a list of the user's parent names as a string.
     *
     * @return RedirectResponse|string
     */
    public function getUserParentNames(): string|RedirectResponse
    {
        $user = Auth::user();
        if (!$user) {
            Flash::error('No user authenticated');
            return redirect()->back();
        }

        $parents = $user->parents;
        if ($parents->isEmpty()) {
            return 'No parents';
        }

        $parentNames = $parents->map(function ($parent) {
            return $parent['fname'] . ' ' . $parent['lname'];
        });

        return implode(', ', $parentNames->all());
    }

    /**
     * Get a list of the user's role names as a string.
     *
     * @return string|RedirectResponse
     */
    public function getUserRoleNames(): string|RedirectResponse
    {
        $user = Auth::user();
        if (!$user) {
            Flash::error('No user authenticated');
            return redirect()->back();
        }

        $roles = $user->roles;
        if ($roles->isEmpty()) {
            return 'No roles';
        }

        $roleNames = $roles->map(function ($role) {
            return $role['name'];
        });

        return implode(', ', $roleNames->all());
    }

    /**
     * Get a list of the user's permissions as a string.
     *
     * @return string|RedirectResponse
     */
    public function getUserPermissions(): string|RedirectResponse
    {
        $user = Auth::user();
        if (!$user) {
            Flash::error('No user authenticated');
            return redirect()->back();
        }

        $permissions = $user->getAllPermissions();
        if ($permissions->isEmpty()) {
            return 'No permissions';
        }

        $permissionNames = $permissions->map(function ($permission) {
            return $permission['name'];
        });

        return implode(', ', $permissionNames->all());
    }
}
