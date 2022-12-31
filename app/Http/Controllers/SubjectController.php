<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Repositories\SubjectRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Gate;
use Laracasts\Flash\Flash;

class SubjectController extends AppBaseController
{
    /** @var SubjectRepository $subjectRepository*/
    private SubjectRepository $subjectRepository;

    /** @var UserRepository $userRepository*/
    private UserRepository $userRepository;

    public function __construct(SubjectRepository $subjectRepo, UserRepository $userRepository)
    {
        $this->subjectRepository = $subjectRepo;
        $this->userRepository = $userRepository;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Subject.
     */
    public function index()
    {
        abort_if(Gate::denies('subjects_access'), 403);
        $subjects = $this->subjectRepository->paginate(10);

        return view('subjects.index')
            ->with('subjects', $subjects);
    }

    /**
     * Show the form for creating a new Subject.
     */
    public function create()
    {
        abort_if(Gate::denies('subjects_create'), 403);
        return view('subjects.create');
    }

    /**
     * Store a newly created Subject in storage.
     */
    public function store(CreateSubjectRequest $request)
    {
        abort_if(Gate::denies('subjects_store'), 403);
        $input = $request->all();

        $subject = $this->subjectRepository->create($input);

        Flash::success('Subject saved successfully.');

        return redirect(route('subjects.index'));
    }

    /**
     * Display the specified Subject.
     */
    public function show($id)
    {
        abort_if(Gate::denies('subjects_show'), 403);
        $subject = $this->subjectRepository->find($id);

        if (empty($subject)) {
            Flash::error('Subject not found');

            return redirect(route('subjects.index'));
        }

        return view('subjects.show')->with('subject', $subject);
    }

    /**
     * Show the form for editing the specified Subject.
     */
    public function edit($id)
    {
        abort_if(Gate::denies('subjects_edit'), 403);
        $subject = $this->subjectRepository->find($id);

        if (empty($subject)) {
            Flash::error('Subject not found');

            return redirect(route('subjects.index'));
        }

        return view('subjects.edit')->with('subject', $subject);
    }

    /**
     * Update the specified Subject in storage.
     */
    public function update($id, UpdateSubjectRequest $request)
    {
        abort_if(Gate::denies('subjects_update'), 403);
        $subject = $this->subjectRepository->find($id);

        if (empty($subject)) {
            Flash::error('Subject not found');

            return redirect(route('subjects.index'));
        }

        $subject = $this->subjectRepository->update($request->all(), $id);

        Flash::success('Subject updated successfully.');

        return redirect(route('subjects.index'));
    }

    /**
     * Remove the specified Subject from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('subjects_destroy'), 403);
        $subject = $this->subjectRepository->find($id);

        if (empty($subject)) {
            Flash::error('Subject not found');

            return redirect(route('subjects.index'));
        }

        $this->subjectRepository->delete($id);

        Flash::success('Subject deleted successfully.');

        return redirect(route('subjects.index'));
    }
}
