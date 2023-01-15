<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use App\Models\Subject;
use App\Models\User;
use App\Repositories\GroupRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Console\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Gate;
use Laracasts\Flash\Flash;
use Spatie\Permission\Models\Role;

class GroupController extends AppBaseController
{
    /** @var UserRepository $userRepository */
    private UserRepository $userRepository;

    /** @var SubjectRepository $subjectRepository */
    private SubjectRepository $subjectRepository;

    /** @var GroupRepository $groupRepository */
    private GroupRepository $groupRepository;

    public function __construct(UserRepository $userRepository, SubjectRepository $subjectRepository, GroupRepository $groupRepository)
    {
        $this->userRepository = $userRepository;
        $this->subjectRepository = $subjectRepository;
        $this->groupRepository = $groupRepository;
        $this->middleware('auth');
    }


    /**
     * Shows index Groups view
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function index(): View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        abort_if(Gate::denies('groups_access'), 403);

        $groups = $this->groupRepository->paginate(10);

        if (!isset($groups)) {
            Flash::error('Groups were not found.');

            return view('dashboard');
        } else {

            return view('groups.index')
                ->with('groups', $groups);
        }
    }


    /**
     * Shows create Group view
     *
     * @return Factory|View|\Illuminate\Contracts\Foundation\Application
     */
    public function create(): Factory|View|\Illuminate\Contracts\Foundation\Application
    {
        abort_if(Gate::denies('groups_create'), 403);

        return view('groups.create');
    }


    /**
     * Creates new Group
     *
     * @param CreateGroupRequest $request
     * @return Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
     */
    public function store(CreateGroupRequest $request): Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        abort_if(Gate::denies('groups_store'), 403);

        $input = $request->all();

        if (!isset($input)) {
            Flash::error('Group was not created successfully.');
        } else {
            $group = $this->groupRepository->create($input);

            Flash::success($group->name . ' was created successfully.');
        }

        return redirect(route('groups.index'));
    }


    /**
     * Shows show Group view using specified id
     *
     * @param int $id
     * @return View|Factory|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
     */
    public function show(int $id): View|Factory|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        abort_if(Gate::denies('groups_show'), 403);

        /** @var Group $group */
        $group = $this->groupRepository->find($id);
        $users = $this->groupRepository->getGroupUserNames($id);
        $subjects = $this->groupRepository->getGroupSubjectNames($id);

        if (!isset($group)) {
            Flash::error($group->name . ' was not found');

            return redirect(route('groups.index'));
        } else {
            return view('groups.show')->with([
                'group' => $group,
                'users' => $users,
                'subjects' => $subjects,
            ]);
        }
    }


    /**
     * Shows edit Group view using specified id
     *
     * @param int $id
     * @return View|Factory|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
     */
    public function edit(int $id): View|Factory|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        abort_if(Gate::denies('groups_edit'), 403);

        /** @var Group $group */
        $group = $this->groupRepository->find($id);

        if (!isset($group)) {
            Flash::error($group->name . ' was not found');

            return redirect(route('groups.index'));
        } else {
            return view('groups.edit')->with([
                'group' => $group
            ]);
        }
    }


    /**
     * Updates User Group using specified id
     *
     * @param int $id
     * @param UpdateGroupRequest $request
     * @return Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
     */
    public function update(int $id, UpdateGroupRequest $request): Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        abort_if(Gate::denies('groups_update'), 403);

        /** @var Group $group */
        $group = $this->groupRepository->find($id);

        $input = $request->all();

        if (!isset($group)) {
            Flash::error($group->name . ' was not found');
        } else {
            $this->groupRepository->update($input, $id);

            Flash::success($group->name . ' was updated successfully.');
        }

        return redirect(route('groups.index'));
    }


    /**
     * Removes Group using specified id.
     *
     * @param int $id
     * @return Redirector|Application|RedirectResponse
     * @throws Exception
     */
    public function destroy(int $id): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('groups_destroy'), 403);

        /** @var Group $group */
        $group = $this->groupRepository->find($id);

        if (!isset($group)) {

            Flash::error($group->name . ' was not found');

        } else {

            $this->groupRepository->delete($id);

            Flash::success($group->name . ' was deleted successfully.');

        }
        return redirect(route('groups.index'));
    }

    /**
     * Updates Users for requested Group
     *
     * @param Request $request
     * @return Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
     */
    public function groupUpdateUsers(Request $request): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('group_users_update'), 403);

        /** @var Group $group */
        $group = $this->groupRepository->find($request->group_id);

        /** @var Request $users */
        $users = $request->users;

        if (isset($group)) {

            $group->users()->sync([]);
            $group->users()->attach($users);
            $group->users()->sync($users);

            Flash::success('Group users updated successfully.');

            return redirect(route('groups.index'));

        } else {

            Flash::error('Group or Users do not not exist!');

            return redirect(route('groups.edit' , $group));
        }
    }


    /**
     * Shows assign users view using specified id
     *
     * @param int $id
     * @return View|Factory|Application
     */
    public function groupShowUsers(int $id): View|Factory|Application
    {
        abort_if(Gate::denies('groups_users_edit'), 403);

        /** @var Group $group */
        $group = $this->groupRepository->find($id);

        /** @var Role $users */
        $users = User::all();

        if (isset($group) && isset($users)) {
            return view('groups.manage-group-users')->with([
                'group' => $group,
                'users'=> $users
            ]);
        } else {
            Flash::error('User or Role does not exist!');
            return view('groups.edit')->with([
                'group' => $group
            ]);
        }
    }

    /**
     * Updates Subject for requested Group
     *
     * @param Request $request
     * @return Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
     */
    public function groupUpdateSubjects(Request $request): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('groups_subjects_update'), 403);

        /** @var Group $group */
        $group = $this->groupRepository->find($request->group_id);

        /** @var Request $subjects */
        $subjects = $request->subjects;

        if (isset($group)) {

            $group->subjects()->sync([]);
            $group->subjects()->attach($subjects);
            $group->subjects()->sync($subjects);

            Flash::success('Group subjects updated successfully.');

            return redirect(route('groups.index'));

        } else {

            Flash::error('Group or Users do not not exist!');

            return redirect(route('groups.edit' , $group));
        }
    }


    /**
     * Shows assign subject view using specified id
     *
     * @param int $id
     * @return View|Factory|Application
     */
    public function groupShowSubjects(int $id): View|Factory|Application
    {
        abort_if(Gate::denies('groups_subjects_edit'), 403);

        /** @var Group $group */
        $group = $this->groupRepository->find($id);

        /** @var Subject $subjects */
        $subjects = Subject::all();

        if (isset($group)) {
            return view('groups.manage-group-subjects')->with([
                'group' => $group,
                'subjects'=> $subjects
                ]);
        } else {
            Flash::error('User or Subject does not exist!');
            return view('groups.edit')->with(['group' => $group]);
        }
    }
}
