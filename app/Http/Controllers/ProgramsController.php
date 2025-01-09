<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function create(): View
    {
        $newProgram = new Program();

        return view('programs.create')
            ->with('program', $newProgram);
    }

    public function store(Request $request): RedirectResponse
    {
        //d($request);

        $formData = [
            'created_by' => Auth::user()->id,
            'name' => $request['name'],
            'description' => $request['description'],
            'scope' => $request['scope'],
            'rewards_info' => $request['rewards_info'],
            'is_active' => 1,
            'date_limit' => $request['date_limit'],
            'rules' => $request['rules']
        ];

        $newProgram = Program::create($formData);

        Alert::success('Program Created', 'Program created successfully!');

        return redirect()->route('home');
    }

    public function destroy(Program $program): RedirectResponse
    {
        $program->delete();
        Alert::success('Program Deleted', 'Program deleted successfully!');
        return redirect()->back();
    }
}
