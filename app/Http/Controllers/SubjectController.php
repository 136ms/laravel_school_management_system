<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Subject;
use App\Repositories\SubjectRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Gate;
use Laracasts\Flash\Flash;

class SubjectController extends AppBaseController
{
    /** @var SubjectRepository $subjectRepository*/
    private SubjectRepository $subjectRepository;

    public function __construct(SubjectRepository $subjectRepo)
    {
        $this->subjectRepository = $subjectRepo;
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
                ->with('subjects', $subjects);
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

        return redirect(route('groups.index'));
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

        if (!isset($subject)) {
            Flash::error($subject->name . ' was not found');

            return redirect(route('subjects.index'));
        } else {
            return view('subjects.show')->with('subject', $subject);
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
            return view('subjects.edit')->with('subject', $subject);
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
}
