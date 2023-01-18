<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Repositories\GroupRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Laracasts\Flash\Flash;

class GradeController extends Controller
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
     * Shows index Grades view
     *
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function index()
    {
        abort_if(Gate::denies('grades_access'), 403);

        $grades = DB::table('grades')->paginate(10);

        if (!isset($grades)) {
            Flash::error('Grades were not found.');

            return redirect(back());
        } else {

            return view('grades.index')
                ->with(['grades' => $grades]);
        }
    }

    /**
     * Shows create User view
     *
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        abort_if(Gate::denies('grades_create'), 403);

        $grades = Grade::all();
        $users = $this->userRepository->all();

        return view('grades.create')->with([
            'grades' => $grades,
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('grades_store'), 403);

        $input = $request->all();
        dd($input);


        return redirect()->route('grades.index')->with('success', 'Grade created successfully.');
    }
}
