<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\User;
use App\Repositories\GradeRepository;
use App\Repositories\GroupRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\UserRepository;
use Dflydev\DotAccessData\Data;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Laracasts\Flash\Flash;

class ChildController extends AppBaseController
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
     * Shows index Children view
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        abort_if(Gate::denies('children_access'), 403);

        $children = Auth::user()->children()->paginate(10);

        if (!isset($children)) {
            Flash::error('Children were not found.');

            return view('dashboard');
        } else {
            return view('children.index')
                ->with(['children' => $children]);
        }
    }

    /**
     * Shows show Child view using specified id
     *
     * @param int $id
     * @return View|Factory|Redirector|Application|RedirectResponse
     */
    public function show(int $id): View|Factory|Redirector|Application|RedirectResponse
    {
        //abort_if(Gate::denies('children_show'), 403);
        $children = Auth::user()->children;
        $children = $children->find($id);
        $subject = $children->subjects[0];
        $teachers = $this->userRepository->getUserTeacherNames($id);
        $subjects = $this->subjectRepository->getUserSubjectNames($id);
        $groups = $this->groupRepository->getUserGroupNames($id);
        $grades = $this->gradeRepository->all(['user_id'=> $children->id, 'subject_id' => $subject->id]);

        if(!isset($children)){
        Flash::error('Children was not found');

        return view('children.index');
    } else {
        return view('children.show')->with([
            'children' => $children,
            'teachers' => $teachers,
            'subjects' => $subjects,
            'groups' => $groups,
            'grades' => $grades,
        ]);
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
        abort_if(Gate::denies('children_update'), 403);

        $children = Auth::user()->children()->find($id);

        $input = $request->all();

        if (!isset($children)) {
            Flash::error($children->fullName . ' was not found');
        } else {
            $children->update($input, $id);

            Flash::success($children->fullName . ' was updated successfully.');
        }

        return redirect(route('children.index'));
    }

    /**
     * Children searchbar function
     *
     * @param Request $request
     * @return View
     */
    public function search(Request $request) : View
    {
        $query = $request->input('query');

        $children = User::with('children')
            ->where('fname', 'LIKE', '%' . $query . '%')
            ->orWhere('lname', 'LIKE', '%' . $query . '%')
            ->paginate(10);

        return view('children.index', compact('children'));
    }
}
