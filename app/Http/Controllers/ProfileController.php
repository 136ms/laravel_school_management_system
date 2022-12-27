<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        return view('profiles.index' , $user)->with('user', $user);
    }

    public function show(Request $request , $id)
    {
        $user = $request->user()->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('profiles.show'));
        }

        return view('profiles.show')->with('user', $user);
    }
}




