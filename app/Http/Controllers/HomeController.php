<?php

namespace App\Http\Controllers;

use App\Repositories\SubjectRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        SubjectRepository $subjectRepository,
        UserRepository $userRepository
    )
    {
        $this->subjectRepository = $subjectRepository;
        $this->userRepository = $userRepository;

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('home')->with([
            "users" => $this->userRepository->count(),
            "subjects" => $this->subjectRepository->count()
            // "subjects" => Subject::count()
        ]);
    }
}
