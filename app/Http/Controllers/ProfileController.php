<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //TODO: Fixnout Admina
    }

    /**
     * Show User profile
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $user = $request->user();
        return view('profiles.index', $user)->with('user', $user);
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
        $user = $request->user()->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('profiles.show'));
        }

        return view('profiles.show')->with('user', $user);
    }

    /**
     * @param Request $request
     * @return View|Factory|Redirector|Application|RedirectResponse
     */
    public function edit(Request $request): View|Factory|Redirector|Application|RedirectResponse
    {
        return view('users.edit')->with('user', $request->user());
    }
}




