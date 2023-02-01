<?php

namespace App\Http\Controllers;

use App\Repositories\GradeRepository;
use App\Repositories\GroupRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use App\Models\User;

class DashboardController extends Controller
{

    /** @var SubjectRepository */
    private SubjectRepository $subjectRepository;

    /** @var UserRepository */
    private UserRepository $userRepository;

    /** @var GroupRepository */
    private GroupRepository $groupRepository;

    /** @var GradeRepository */
    private GradeRepository $gradeRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        SubjectRepository $subjectRepository,
        UserRepository    $userRepository,
        GroupRepository   $groupRepository,
        GradeRepository   $gradeRepository
    )
    {
        $this->subjectRepository = $subjectRepository;
        $this->userRepository = $userRepository;
        $this->groupRepository = $groupRepository;
        $this->gradeRepository = $gradeRepository;
        $this->middleware('auth');
    }

    /**
     * Show User dashboard
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        /** @var User $user */
        $user = Auth::getUser();

        if (isset($user)) {
            return view('dashboard')->with([
                'user' => $user,
                'userGrades' => $this->gradeRepository->calculateGradesAverage($user->grades),
                'userCount' => $this->userRepository->count(),
                'subjects' => $this->subjectRepository->getSubjectNames(),
                'subjectCount' => $this->subjectRepository->count(),
                'groups' => $this->groupRepository->getGroupNames(),
                'groupCount' => $this->groupRepository->count(),
                'parents' => $this->userRepository->getParentNames(),
                'teachers' => $this->userRepository->getTeacherNames(),
                'children' => $this->userRepository->getChildrenNames(),
                'roles' => $this->userRepository->getRoleNames(),
                'permissions' => $this->userRepository->getPermissions(),
                'grades' =>  $this->gradeRepository->paginate(10),
            ]);
        } else {
            Flash::error('Please login to your account.');
            return view('auth.login');
        }
    }
}
