<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
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
use Laracasts\Flash\Flash;

class SubjectController extends AppBaseController
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
     * Shows index Subjects view
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        abort_if(Gate::denies('subjects_access'), 403);

        $subjects = $this->subjectRepository->paginate(10);

        if (!isset($subjects)) {
            Flash::error('Subjects were not found.');

            return view('dashboard');
        } else {

            return view('subjects.index')
                ->with(['subjects' => $subjects]);
        }
    }


    /**
     * Shows create Subject view
     *
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        abort_if(Gate::denies('subjects_create'), 403);

        return view('subjects.create');
    }


    /**
     * Creates new Subject
     *
     * @param CreateSubjectRequest $request
     * @return Redirector|Application|RedirectResponse
     */
    public function store(CreateSubjectRequest $request): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('subjects_store'), 403);

        $input = $request->all();

        if (!isset($input)) {
            Flash::error('Subject was not created successfully.');
        } else {
            $subject = $this->subjectRepository->create($input);

            Flash::success($subject->name . ' was created successfully.');
        }

        return redirect(route('subjects.index'));
    }


    /**
     * Shows show Subject view using specified id
     *
     * @param int $id
     * @return View|Factory|Redirector|Application|RedirectResponse
     */
    public function show(int $id): View|Factory|Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('subjects_show'), 403);

        /** @var Subject $subject */
        $subject = $this->subjectRepository->find($id);
        $groups = $this->groupRepository->getSubjectGroupNames($id);
        $users = $this->subjectRepository->getSubjectUserNames($id);

        if (!isset($subject)) {
            Flash::error($subject->name . ' was not found');

            return redirect(route('subjects.index'));
        } else {
            return view('subjects.show')->with([
                'subject' => $subject,
                'groups' => $groups,
                'users' => $users,
            ]);
        }
    }


    /**
     * Shows edit Subject view using specified id
     *
     * @param int $id
     * @return View|Factory|Redirector|Application|RedirectResponse
     */
    public function edit(int $id): View|Factory|Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('subjects_edit'), 403);

        /** @var Subject $subject */
        $subject = $this->subjectRepository->find($id);

        if (!isset($subject)) {
            Flash::error($subject->name . ' was not found');

            return redirect(route('subjects.index'));
        } else {
            return view('subjects.edit')->with(['subject' => $subject]);
        }
    }


    /**
     * Updates User Subject using specified id
     *
     * @param int $id
     * @param UpdateSubjectRequest $request
     * @return Redirector|Application|RedirectResponse
     */
    public function update(int $id, UpdateSubjectRequest $request): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('subjects_update'), 403);

        /** @var Subject $subject */
        $subject = $this->subjectRepository->find($id);

        $input = $request->all();

        if (!isset($subject)) {
            Flash::error($subject->name . ' was not found');
        } else {
            $this->subjectRepository->update($input, $id);

            Flash::success($subject->name . ' was updated successfully.');
        }

        return redirect(route('subjects.index'));
    }


    /**
     * Removes Subject using specified id.
     *
     * @param $id
     * @return Redirector|Application|RedirectResponse
     * @throws Exception
     */
    public function destroy($id): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('subjects_destroy'), 403);

        /** @var Subject $subject */
        $subject = $this->subjectRepository->find($id);

        if (!isset($subject)) {

            Flash::error($subject->name . ' was not found');

        } else {

            $this->subjectRepository->delete($id);

            Flash::success($subject->name . ' was deleted successfully.');

        }
        return redirect(route('subjects.index'));
    }

    /**
     * Updates Users for requested Subject
     *
     * @param Request $request
     * @return Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
     */
    public function subjectUpdateUsers(Request $request): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('subjects_users_update'), 403);

        /** @var Subject $subject */
        $subject = $this->subjectRepository->find($request->subject_id);

        /** @var Request $users */
        $users = $request->users;

        if (isset($subject)) {

            $subject->users()->sync([]);
            $subject->users()->attach($users);
            $subject->users()->sync($users);

            Flash::success('Subject users updated successfully.');

            return redirect(route('subjects.index'));

        } else {

            Flash::error('Subject or Users do not not exist!');

            return redirect(route('subjects.edit' , $subject));
        }
    }


    /**
     * Shows assign users view using specified id
     *
     * @param int $id
     * @return View|Factory|Application
     */
    public function subjectShowUsers(int $id): View|Factory|Application
    {
        abort_if(Gate::denies('subjects_users_edit'), 403);

        /** @var Subject $subject */
        $subject = $this->subjectRepository->find($id);

        /** @var User $users */
        $users = User::all();

        if (isset($subject) && isset($users)) {
            return view('subjects.manage-subject-users')->with([
                'subject' => $subject,
                'users' => $users
            ]);
        } else {
            Flash::error('User or Subject does not exist!');
            return view('subjects.edit')->with(['subject' => $subject]);
        }
    }

    /**
     * Updates Group for requested Subject
     *
     * @param Request $request
     * @return Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
     */
    public function subjectUpdateGroups(Request $request): Redirector|\Illuminate\Console\Application|RedirectResponse
    {
        abort_if(Gate::denies('subjects_groups_update'), 403);

        /** @var Subject $subject */
        $subject = $this->subjectRepository->find($request->subject_id);

        /** @var Request $groups */
        $groups = $request->groups;

        if (isset($subject)) {

            $subject->groups()->sync([]);
            $subject->groups()->attach($groups);
            $subject->groups()->sync($groups);

            Flash::success('Subject groups updated successfully.');

            return redirect(route('subjects.index'));

        } else {

            Flash::error('Group or Subjects do not not exist!');

            return redirect(route('subjects.edit' , $subject));
        }
    }


    /**
     * Shows assign group view using specified id
     *
     * @param int $id
     * @return View|Factory|Application
     */
    public function subjectShowGroups(int $id): View|Factory|Application
    {
        abort_if(Gate::denies('subjects_groups_edit'), 403);

        /** @var Group $group */
        $subject = $this->subjectRepository->find($id);

        /** @var Group $groups */
        $groups = Group::all();

        if (isset($subject)) {
            return view('subjects.manage-subject-groups')->with([
                'subject' => $subject,
                'groups' => $groups
            ]);
        } else {
            Flash::error('User or Group does not exist!');
            return view('subjects.edit')->with(['subject' => $subject]);
        }
    }
}
