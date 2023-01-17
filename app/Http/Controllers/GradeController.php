<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    public function index()
    {
        return view('grades.index')->with(['grades' => DB::table('grades')->paginate(10)]);
    }
}

