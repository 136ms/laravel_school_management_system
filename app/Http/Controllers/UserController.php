<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Group;
use App\Models\Subject;
use App\Models\User;
use App\Repositories\GroupRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;
use Spatie\Permission\Models\Role;

class UserController extends AppBaseController
{
    /** @var UserRepository $userRepository */
    private UserRepository $userRepository;

    /** @var SubjectRepository $subjectRepository */
    private SubjectRepository $subjectRepository;

    /** @var GroupRepository $groupRepository */
    private GroupRepository $groupRepository;

    public function __construct(UserRepository    $userRepository,
                                SubjectRepository $subjectRepository,
                                GroupRepository   $groupRepository)
    {
        $this->userRepository = $userRepository;
        $this->subjectRepository = $subjectRepository;
        $this->groupRepository = $groupRepository;
        $this->middleware('auth');
    }


    /**
     * Shows index Users view
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        abort_if(Gate::denies('users_access'), 403);

        $users = $this->userRepository->paginate(10);

        if (!isset($users)) {
            Flash::error('Users were not found.');

            return view('dashboard');
        } else {

            return view('users.index')
                ->with('users', $users);
        }
    }


    /**
     * Shows create User view
     *
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        abort_if(Gate::denies('users_create'), 403);

        return view('users.create');
    }


    /**
     * Creates new User
     *
     * @param CreateUserRequest $request
     * @return Redirector|Application|RedirectResponse
     */
    public function store(CreateUserRequest $request): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('users_store'), 403);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        if (!isset($input)) {
            Flash::error('User was not created successfully.');
        } else {
            $user = $this->userRepository->create($input);

            Flash::success($user->fullName . ' was created successfully.');
        }

        return redirect(route('users.index'));
    }


    /**
     * Shows show User view using specified id
     *
     * @param int $id
     * @return View|Factory|Redirector|Application|RedirectResponse
     */
    public function show(int $id): View|Factory|Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('users_show'), 403);

        /** @var User $user */
        $user = $this->userRepository->find($id);
        $groups = $this->groupRepository->getGroupNames();
        $subjects = $this->subjectRepository->getSubjectNames();
        $parents = $this->userRepository->getParentNames();
        $teachers = $this->userRepository->getTeacherNames();

        if (!isset($user)) {

            Flash::error($user->fullName . ' was not found');

            return redirect(route('users.index'));
        } else {
            return view('users.show')->with([
                'user' => $user,
                'groups' => $groups,
                'subjects' => $subjects,
                'parents' => $parents,
                'teachers' => $teachers,
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
        abort_if(Gate::denies('users_edit'), 403);

        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (!isset($user)) {
            Flash::error($user->fullName . ' was not found');

            return redirect(route('users.index'));
        } else {
            return view('users.edit')->with('user', $user);
        }
    }


    /**
     * Updates User using specified id.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     * @return Redirector|Application|RedirectResponse
     */
    public function update(int $id, UpdateUserRequest $request): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('users_update'), 403);

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

        return redirect(route('users.index'));
    }


    /**
     * Removes User using specified id.
     *
     * @param int $id
     * @return Redirector|Application|RedirectResponse
     * @throws Exception
     */
    public function destroy(int $id): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('users_destroy'), 403);

        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (!isset($user)) {

            Flash::error($user->fullName . ' was not found');

        } else {

            $this->userRepository->delete($id);

            Flash::success($user->fullName . ' was deleted successfully.');

        }
        return redirect(route('users.index'));
    }


    /**
     * Updates Role for requested User
     *
     * @param Request $request
     * @return Redirector|Application|RedirectResponse
     */
    public function userUpdateRole(Request $request): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('roles_update'), 403);

        /** @var User $user */
        $user = $this->userRepository->find($request->user_id);

        /** @var Request $roles */
        $roles = $request->roles;

        if (isset($user) && isset($roles)) {

            $user->syncRoles($request->roles);

            Flash::success($user->fullName . ' role updated successfully.');

            return redirect(route('users.index'));

        } else {

            Flash::error('User or Role does not exist!');

            return view('users.edit', $user);
        }
    }


    /**
     * Shows assign role view using specified id
     *
     * @param int $id
     * @return View|Factory|Application
     */
    public function userShowRole(int $id): View|Factory|Application
    {
        abort_if(Gate::denies('roles_update'), 403);

        /** @var User $user */
        $user = $this->userRepository->find($id);

        /** @var Role $roles */
        $roles = Role::all();

        if (isset($user) && isset($roles)) {
            return view('roles.manage-roles')->with('user', $user)->with('roles', $roles);
        } else {
            Flash::error('User or Role does not exist!');
            return view('users.edit', $user);
        }
    }

    /**
     * Updates Group for requested User
     *
     * @param Request $request
     * @return Redirector|Application|RedirectResponse
     */
    public function userUpdateGroup(Request $request): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('users_groups_update'), 403);

        /** @var User $user */
        $user = $this->userRepository->find($request->user_id);

        /** @var Request $groups */
        $groups = $request->groups;

        if (isset($user)) {

            $user->groups()->sync([]);
            $user->groups()->attach($groups);
            $user->groups()->sync($groups);

            Flash::success('User Groups updated successfully.');

            return redirect(route('users.index'));

        } else {

            Flash::error('User or Groups do not not exist!');

            return redirect(route('users.edit', $user));
        }
    }


    /**
     * Shows assign group view using specified id
     *
     * @param int $id
     * @return View|Factory|Application
     */
    public function userShowGroup(int $id): View|Factory|Application
    {
        abort_if(Gate::denies('users_groups_edit'), 403);

        /** @var User $user */
        $user = $this->userRepository->find($id);

        /** @var Group $groups */
        $groups = Group::all();

        if (isset($user)) {
            return view('users.manage-user-groups')->with('user', $user)->with('groups', $groups);
        } else {
            Flash::error('User or Role does not exist!');
            return redirect(route('users.edit', $user));
        }
    }

    /**
     * Updates Subject for requested User
     *
     * @param Request $request
     * @return Redirector|Application|RedirectResponse
     */
    public function userUpdateSubject(Request $request): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('users_subjects_update'), 403);

        /** @var User $user */
        $user = $this->userRepository->find($request->user_id);

        /** @var Request $subjects */
        $subjects = $request->subjects;

        if (isset($user)) {

            $user->subjects()->sync([]);
            $user->subjects()->attach($subjects);
            $user->subjects()->sync($subjects);

            Flash::success('User Subjects updated successfully.');

            return redirect(route('users.index'));

        } else {

            Flash::error('User or Subjects do not not exist!');

            return redirect(route('users.edit', $user));
        }
    }


    /**
     * Shows assign subject view using specified id
     *
     * @param int $id
     * @return View|Factory|Application
     */
    public function userShowSubject(int $id): View|Factory|Application
    {
        abort_if(Gate::denies('users_subjects_edit'), 403);

        /** @var User $user */
        $user = $this->userRepository->find($id);

        /** @var Subject $subjects */
        $subjects = Subject::all();

        if (isset($user)) {
            return view('users.manage-user-subjects')->with('user', $user)->with('subjects', $subjects);
        } else {
            Flash::error('User or Subjects do not not exist!');
            return redirect(route('users.edit', $user));
        }
    }

    /**
     * Updates Parent for requested User
     *
     * @param Request $request
     * @return Redirector|Application|RedirectResponse
     */
    public function userUpdateParent(Request $request): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('users_parents_update'), 403);

        /** @var User $user */
        $user = $this->userRepository->find($request->user_id);

        /** @var Request $parents */
        $parents = $request->parents;

        if (isset($user)) {

            $user->parents()->sync([]);
            $user->parents()->attach($parents);
            $user->parents()->sync($parents);

            Flash::success('User Parents updated successfully.');

            return redirect(route('users.index'));

        } else {

            Flash::error('User or Parents do not not exist!');

            return redirect(route('users.edit', $user));
        }
    }


    /**
     * Shows assign parent view using specified id
     *
     * @param int $id
     * @return View|Factory|Application
     */
    public function userShowParent(int $id): View|Factory|Application
    {
        abort_if(Gate::denies('users_parents_edit'), 403);

        /** @var User $user */
        $user = $this->userRepository->find($id);

        $parents = User::role('Parent')->get();

        if (isset($user)) {
            return view('users.manage-user-parents')->with('user', $user)->with('parents', $parents);
        } else {
            Flash::error('User or Teachers do not not exist!');
            return redirect(route('users.edit', $user));
        }
    }

    /**
     * Updates Teacher for requested User
     *
     * @param Request $request
     * @return Redirector|Application|RedirectResponse
     */
    public function userUpdateTeacher(Request $request): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('users_teachers_update'), 403);

        /** @var User $user */
        $user = $this->userRepository->find($request->user_id);

        /** @var Request $teachers */
        $teachers = $request->teachers;

        if (isset($user)) {

            $user->teachers()->sync([]);
            $user->teachers()->attach($teachers);
            $user->teachers()->sync($teachers);

            Flash::success('User Teachers updated successfully.');

            return redirect(route('users.index'));

        } else {

            Flash::error('User or Teachers do not not exist!');

            return redirect(route('users.edit', $user));
        }
    }


    /**
     * Shows assign teacher view using specified id
     *
     * @param int $id
     * @return View|Factory|Application
     */
    public function userShowTeacher(int $id): View|Factory|Application
    {
        abort_if(Gate::denies('users_teachers_edit'), 403);

        /** @var User $user */
        $user = $this->userRepository->find($id);

        $teachers = User::role('Teacher')->get();

        if (isset($user)) {
            return view('users.manage-user-teachers')->with('user', $user)->with('teachers', $teachers);
        } else {
            Flash::error('User or Teachers do not not exist!');
            return redirect(route('users.edit', $user));
        }
    }
}
