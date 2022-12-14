<?php

namespace App\Http\Controllers;

use App\Repositories\GroupRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class ProfileController extends AppBaseController
{
    /** @var GroupRepository $groupRepository */
    private GroupRepository $groupRepository;

    /** @var SubjectRepository $subjectRepository */
    private SubjectRepository $subjectRepository;

    public function __construct(GroupRepository $groupRepository, SubjectRepository $subjectRepository)
    {
        $this->groupRepository = $groupRepository;
        $this->subjectRepository = $subjectRepository;
    }

    public function showProfile()
    {
        $user = Auth::user();
        $group = $this->groupRepository->all();
        $subject = $this->subjectRepository->all();

        return view('profile')->with([
            'user' => $user,
            'group' => $group,
            'subject' => $subject,
        ]);
    }
}
