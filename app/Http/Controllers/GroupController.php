<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Repositories\GroupRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Laracasts\Flash\Flash;

class GroupController extends AppBaseController
{
    /** @var GroupRepository $groupRepository*/
    private GroupRepository $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Group.
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('groups_access'), 403);
        $groups = $this->groupRepository->paginate(10);

        return view('groups.index')
            ->with('groups', $groups);
    }

    /**
     * Show the form for creating a new Group.
     */
    public function create()
    {
        abort_if(Gate::denies('groups_create'), 403);
        return view('groups.create');
    }

    /**
     * Store a newly created Group in storage.
     */
    public function store(CreateGroupRequest $request)
    {
        abort_if(Gate::denies('groups_store'), 403);
        $input = $request->all();

        $group = $this->groupRepository->create($input);

        Flash::success('Group saved successfully.');

        return redirect(route('groups.index'));
    }

    /**
     * Display the specified Group.
     */
    public function show($id)
    {
        abort_if(Gate::denies('groups_show'), 403);
        $group = $this->groupRepository->find($id);

        if (empty($group)) {
            Flash::error('Group not found');

            return redirect(route('groups.index'));
        }

        return view('groups.show')->with('group', $group);
    }

    /**
     * Show the form for editing the specified Group.
     */
    public function edit($id)
    {
        abort_if(Gate::denies('groups_edit'), 403);
        $group = $this->groupRepository->find($id);

        if (empty($group)) {
            Flash::error('Group not found');

            return redirect(route('groups.index'));
        }

        return view('groups.edit')->with('group', $group);
    }

    /**
     * Update the specified Group in storage.
     */
    public function update($id, UpdateGroupRequest $request)
    {
        abort_if(Gate::denies('groups_update'), 403);
        $group = $this->groupRepository->find($id);

        if (empty($group)) {
            Flash::error('Group not found');

            return redirect(route('groups.index'));
        }

        $group = $this->groupRepository->update($request->all(), $id);

        Flash::success('Group updated successfully.');

        return redirect(route('groups.index'));
    }

    /**
     * Remove the specified Group from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('groups_destroy'), 403);
        $group = $this->groupRepository->find($id);

        if (empty($group)) {
            Flash::error('Group not found');

            return redirect(route('groups.index'));
        }

        $this->groupRepository->delete($id);

        Flash::success('Group deleted successfully.');

        return redirect(route('groups.index'));
    }
}
