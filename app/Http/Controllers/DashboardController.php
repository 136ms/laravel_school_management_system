<?php

namespace App\Http\Controllers;

use App\Repositories\GroupRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    /**
     * @var SubjectRepository
     */
    private SubjectRepository $subjectRepository;

    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @var GroupRepository
     */
    private GroupRepository $groupRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('dashboard')->with([
            "user" => Auth::user(),
            "userCount" => $this->userRepository->count(),
            "subjects" => $this->subjectRepository->getUserSubjectNames(),
            "subjectCount" => $this->subjectRepository->count(),
            "groups" => $this->groupRepository->getUserGroupNames(),
            "groupCount" => $this->groupRepository->count(),
            "parents" => $this->userRepository->getUserParentNames(),
            "teachers" => $this->userRepository->getUserTeacherNames(),
            "children" => $this->userRepository->getUserChildrenNames(),
            "roles" => $this->userRepository->getUserRoleNames(),
        ]);
    }
}
