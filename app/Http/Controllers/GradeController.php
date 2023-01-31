<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\User;
use App\Repositories\GradeRepository;
use App\Repositories\GroupRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Laracasts\Flash\Flash;
use Spatie\Permission\Models\Role;

class GradeController extends Controller
{
    /** @var UserRepository $userRepository */
    private UserRepository $userRepository;

    /** @var SubjectRepository $subjectRepository */
    private SubjectRepository $subjectRepository;

    /** @var GroupRepository $groupRepository */
    private GroupRepository $groupRepository;

    /** @var GradeRepository $gradeRepository */
    private GradeRepository $gradeRepository;

    public function __construct(UserRepository    $userRepository,
                                SubjectRepository $subjectRepository,
                                GroupRepository   $groupRepository,
                                GradeRepository   $gradeRepository)
    {
        $this->userRepository = $userRepository;
        $this->subjectRepository = $subjectRepository;
        $this->groupRepository = $groupRepository;
        $this->gradeRepository = $gradeRepository;
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

        $grades = $this->gradeRepository->paginate(10);
        $users = $this->userRepository->paginate(10);
        $subjects = $this->subjectRepository->paginate(10);
        $userGrades = Auth::user()->studentGrades;

        if (!isset($grades)) {
            Flash::error('Grades were not found.');

            return redirect(back());
        } else {

            return view('grades.index')
                ->with([
                    'grades' => $grades,
                    'users' => $users,
                    'subjects' => $subjects,
                    'userGrades' => $userGrades
                ]);
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

        $grades = $this->gradeRepository->all();
        $users = $this->userRepository->all();
        $subjects = $this->subjectRepository->all();

        return view('grades.create')->with([
            'grades' => $grades,
            'users' => $users,
            'subjects' => $subjects,
        ]);
    }

    /**
     * Creates new Grade
     *
     * @param Request $request
     * @return View|Factory|Redirector|RedirectResponse|Application
     */
    public function store(Request $request): View|Factory|Redirector|RedirectResponse|Application
    {
        abort_if(Gate::denies('grades_store'), 403);

        $input = $request->all();

        if (!isset($input)) {
            Flash::error('Grade was not created successfully.');
            return view('grades.create');
        } else {
            $grade = new Grade();
            $grade['name'] = $input['name'];
            $grade['grade'] = intval($input['grade']);
            $grade['weight'] = floatval($input['weight']);
            $grade['author_id'] = Auth::id();
            $grade['user_id'] = $input['user_id'];
            $grade['subject_id'] = $input['subject_id'];
            $grade->save();

            Flash::success('Grade was created successfully.');
            return redirect(route('grades.index'));
        }
    }

    /**
     * Shows show Grade view using specified id
     *
     * @param int $id
     * @return View|Factory|Redirector|Application|RedirectResponse
     */
    public function show(int $id): View|Factory|Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('grades_show'), 403);

        /** @var Grade $grade */
        $grade = $this->gradeRepository->find($id);

        if (!isset($grade)) {

            Flash::error($grade->name . ' was not found');

            return redirect(route('grades.index'));
        } else {
            return view('grades.show')->with(['grade' => $grade]);
        }
    }

    /**
     * Shows edit Grade view using specified id
     *
     * @param int $id
     * @return View|Factory|Redirector|Application|RedirectResponse
     */
    public function edit(int $id): View|Factory|Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('grades_edit'), 403);

        /** @var Grade $grade */
        $grade = $this->gradeRepository->find($id);
        $studentRole = Role::findByName('Student');
        $users = User::whereHas('roles', function ($query) use ($studentRole) {
            $query->where('role_id', '=', $studentRole->id);
        })->get();
        $subjects = $this->subjectRepository->all();

        if (!isset($grade)) {
            Flash::error($grade->name . ' was not found');

            return redirect(route('grades.index'));
        } else {
            return view('grades.edit')->with([
                'grade' => $grade,
                'users' => $users,
                'subjects' => $subjects,
            ]);
        }
    }

    /**
     * Updates Grade using specified id.
     *
     * @param int $id
     * @param Request $request
     * @return Redirector|Application|RedirectResponse
     */
    public function update(int $id, Request $request): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('grades_update'), 403);

        /** @var Grade $grade */
        $grade = $this->gradeRepository->find($id);

        $input = $request->all();

        if (!isset($grade)) {

            Flash::error($grade->name . ' was not found');
        } else {

            $this->gradeRepository->update($input, $id);

            Flash::success($grade->name . ' was updated successfully.');
        }

        return redirect(route('grades.index'));
    }

    /**
     * Removes Grade using specified id.
     *
     * @param int $id
     * @return Redirector|Application|RedirectResponse
     * @throws Exception
     */
    public function destroy(int $id): Redirector|Application|RedirectResponse
    {
        abort_if(Gate::denies('grades_destroy'), 403);

        /** @var Grade $grade */
        $grade = $this->gradeRepository->find($id);

        if (!isset($grade)) {

            Flash::error($grade->name . ' was not found');

        } else {

            $this->gradeRepository->delete($id);

            Flash::success($grade->name . ' was deleted successfully.');

        }
        return redirect(route('grades.index'));
    }
}

