<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use App\Repositories\GroupRepository;
use Exception;
use Illuminate\Console\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Gate;
use Laracasts\Flash\Flash;

class GroupController extends AppBaseController
{
    /** @var GroupRepository $groupRepository */
    private GroupRepository $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
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
     * Creates new group
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


    public function show(int $id): View|Factory|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        abort_if(Gate::denies('groups_show'), 403);

        /** @var Group $group */
        $group = $this->groupRepository->find($id);

        if (!isset($group)) {
            Flash::error($group->name . ' was not found');

            return redirect(route('groups.index'));
        } else {
            return view('groups.show')->with('group', $group);
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
            return view('groups.edit')->with('group', $group);
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
}
