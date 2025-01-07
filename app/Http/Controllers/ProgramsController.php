<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
        $programId = $program->id;
        $users = User::whereHas('reports', function ($query) use ($programId) {
            $query->where('program_id', $programId);
        })
            ->withCount(['reports' => function ($query) use ($programId) {
                $query->where('program_id', $programId);
            }])
            ->orderByDesc('reports_count')
            ->take(3)
            ->get();
        return view('programs.show', compact('program', 'users'));

    }
}
