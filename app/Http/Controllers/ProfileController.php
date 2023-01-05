<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Laracasts\Flash\Flash;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    /** @var UserRepository $userRepository*/
    private UserRepository $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth');
    }

    /**
     * Show User profile
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        abort_if(Gate::denies('profiles_access'), 403);
        $user = $request->user();
        $roles = $this->userRepository->getUserRoleNames();
        return view('profiles.index', $user)->with('user', $user)->with('roles', $roles);
    }

    /**
     * Show User profile by ID
     *
     * @param Request $request
     * @param int $id ID of User
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function show(Request $request, int $id): View|Factory|Redirector|RedirectResponse|Application
    {
        abort_if(Gate::denies('profiles_show'), 403);
        $user = $request->user()->find($id);

        if (empty($user)) {
            Flash::error('Profile not found');

            return redirect(route('profiles.show'));
        }

        return view('profiles.show')->with('user', $user);
    }
    public function edit()
    {
        abort_if(Gate::denies('profiles_edit'), 403);
        $url = $_SERVER['REQUEST_URI'];
        $profileId = preg_replace('/\D/', '', $url);
        $profileId = intval($profileId);
        $user = User::find($profileId);
        if (Auth::user()->id != $profileId)
        {
            abort_if(Gate::denies('profiles_edit_users'), 403);
        }
        return view('profiles.edit')->with('user', $user)->with('id', $profileId)->with('roles', Role::pluck('name', 'id'));
    }

    /**
     * Update the specified User in storage.
     */
    public function update($id, UpdateUserRequest $request)
    {
        abort_if(Gate::denies('profiles_update'), 403);
        $user = Auth::user();
        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('profiles.index'));
        }

        $userRequest = $request->all();

        $role = Role::findById($userRequest['roles']);

        $user->assignRole($role);

        $this->userRepository->update($request->all(), $id);

        Flash::success('User updated successfully.');

        return redirect(route('profiles.index'));
    }

}




