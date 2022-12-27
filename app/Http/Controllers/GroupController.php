<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Repositories\GroupRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class GroupController extends AppBaseController
{
    /** @var GroupRepository $groupRepository*/
    private $groupRepository;

    /** @var UserRepository $userRepository*/
    private $userRepository;

    public function __construct(GroupRepository $groupRepo, UserRepository $userRepo)
    {
        $this->groupRepository = $groupRepo;
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the Group.
     */
    public function index(Request $request)
    {
        $this->userRepository->checkAdminRole();
        $groups = $this->groupRepository->paginate(10);

        return view('groups.index')
            ->with('groups', $groups);
    }

    /**
     * Show the form for creating a new Group.
     */
    public function create()
    {
        $this->userRepository->checkAdminRole();
        return view('groups.create');
    }

    /**
     * Store a newly created Group in storage.
     */
    public function store(CreateGroupRequest $request)
    {
        $this->userRepository->checkAdminRole();
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
        $this->userRepository->checkAdminRole();
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
        $this->userRepository->checkAdminRole();
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
        $this->userRepository->checkAdminRole();
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
        $this->userRepository->checkAdminRole();
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
