<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ProgramsController extends Controller
{
    public function index(Request $request)
    {
        $nameFilter = $request->name ?? '';

        $programQuery = Program::query()
            ->where('is_active', 1)
            ->where('date_limit', '>', now());

        if (Auth::check() && Auth::user()->type == 'E') {
            $programQuery->where('created_by', Auth::user()->id);
        }

        if ($nameFilter !== '') {
            $programQuery->where('name', 'like', "%$nameFilter%");
        }

        $programs = $programQuery->paginate(8);

        return view('home', compact('programs', 'nameFilter'));
    }



    public function show(Program $program): View
    {
        return view('programs.show')->withProgram($program);
    }
}
