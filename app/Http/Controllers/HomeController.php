<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $allPrograms = Program::all();
        dd($allPrograms);  // Verificar os dados que estão sendo retornados
        return view('home')->with('programs', $allPrograms);
    }
}
