<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\GroupRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;

class ProfileController extends Controller
{
    /** @var SubjectRepository */
    private SubjectRepository $subjectRepository;

    /** @var UserRepository */
    private UserRepository $userRepository;

    /** @var GroupRepository */
    private GroupRepository $groupRepository;

    public function __construct(
        SubjectRepository $subjectRepository,
        UserRepository    $userRepository,
        GroupRepository   $groupRepository
    )
    {
        $this->subjectRepository = $subjectRepository;
        $this->userRepository = $userRepository;
        $this->groupRepository = $groupRepository;
        $this->middleware('auth');
    }

    /**
     * Shows index User profile view
     *
     * @return View|Factory|Application
     */
    public function index(): View|Factory|Application
    {
        abort_if(Gate::denies('profiles_access'), 403);

        /** @var User $user */
        $user = Auth::user();
        $roles = $this->userRepository->getRoleNames();
        $permissions = $this->userRepository->getPermissions();
        $groups = $this->groupRepository->getGroupNames();
        $subjects = $this->subjectRepository->getSubjectNames();
        $teachers = $this->userRepository->getTeacherNames();
        $parents = $this->userRepository->getParentNames();
        $children = $this->userRepository->getChildrenNames();

        if (!isset($roles)) {
            Flash::error($user->fullName . ' profile was not found.');
            return view('dashboard')->with([
                'user' => $user,
                'roles' => $roles,
                'permissions' => $permissions,
                'groups' => $groups,
                'subjects' => $subjects,
                'teachers' => $teachers,
                'parents' => $parents,
                'children' => $children,
            ]);
        } else {
            return view('profiles.index')->with([
                'user' => $user,
                'roles' => $roles,
                'permissions' => $permissions,
                'groups' => $groups,
                'subjects' => $subjects,
                'teachers' => $teachers,
                'parents' => $parents,
                'children' => $children,
            ]);
        }
    }

    /**
     * Shows show User profile view using specified id.
     *
     * @param int $id
     * @return View|Factory|Redirector|RedirectResponse|Application
     */
    public function show(int $id): View|Factory|Redirector|RedirectResponse|Application
    {
        abort_if(Gate::denies('profiles_show'), 403);

        /** @var User $user */
        $user = $this->userRepository->find($id);
        $roles = $this->userRepository->getUserRoleNames($user->id);
        $permissions = $this->userRepository->getUserPermissions($user->id);
        $groups = $this->groupRepository->getUserGroupNames($user->id);
        $subjects = $this->subjectRepository->getUserSubjectNames($user->id);
        $teachers = $this->userRepository->getUserTeacherNames($user->id);
        $parents = $this->userRepository->getUserParentNames($user->id);
        $children = $this->userRepository->getUserChildrenNames($user->id);

        if (!isset($user)) {

            Flash::error($user->fullName . ' profile was not found.');

            return view('profiles.index')->with([
                'user' => $user,
                'roles' => $roles,
                'permissions' => $permissions,
                'groups' => $groups,
                'subjects' => $subjects,
                'teachers' => $teachers,
                'parents' => $parents,
                'children' => $children,
            ]);
        } else {
            return view('profiles.show')->with([
                'user' => $user,
                'roles' => $roles,
                'permissions' => $permissions,
                'groups' => $groups,
                'subjects' => $subjects,
                'teachers' => $teachers,
                'parents' => $parents,
                'children' => $children,
            ]);
        }
    }

    /**
     * Shows edit User view using specified id
     *
     * @param int $id
     * @return View|Factory|Redirector|Application|RedirectResponse
     */
    public function edit(int $id): View|Factory|Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('profiles_edit'), 403);

        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (!isset($user)) {
            Flash::error($user->fullName . ' profile was not found.');

            return redirect(route('profiles.index'));
        } else {
            return view('profiles.edit')->with(['user' => $user]);
        }
    }

    /**
     * Shows edit User profile view
     *
     * @return View|Factory|Redirector|Application|RedirectResponse
     */
    public function editUserProfile(): View|Factory|Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('profile_edit'), 403);

        /** @var User $user */
        $user = $this->userRepository->find(Auth::id());

        if (!isset($user)) {
            Flash::error($user->fullName . ' profile was not found.');

            return redirect(route('profiles.index'));
        } else {
            return view('profiles.edit-profile')->with(['user' => $user]);
        }
    }

    /**
     * Update User profiles using specified id.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     * @return Redirector|Application|RedirectResponse
     */
    public function update(int $id, UpdateUserRequest $request): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('profiles_update'), 403);

        /** @var User $user */
        $user = $this->userRepository->find($id);

        $input = $request->all();

        $input['password'] = Hash::make($input['password']);

        if (!isset($user)) {

            Flash::error($user->fullName . ' was not found');
        } else {

            $this->userRepository->update($input, $id);

            Flash::success($user->fullName . ' was updated successfully.');
        }

        return redirect(route('profile.index'));
    }

    /**
     * Updates User profile.
     *
     * @param UpdateUserRequest $request
     * @return Redirector|Application|RedirectResponse
     */
    public function updateUserProfile(UpdateUserRequest $request): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('profile_update'), 403);

        /** @var User $user */
        $user = $this->userRepository->find(Auth::id());

        $input = $request->all();

        $input['password'] = Hash::make($input['password']);

        if (!isset($user)) {

            Flash::error($user->fullName . ' was not found');
        } else {

            $this->userRepository->update($input, Auth::id());

            Flash::success($user->fullName . ' was updated successfully.');
        }

        return redirect(route('profile.index'));
    }
}




