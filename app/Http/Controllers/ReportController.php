<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Program;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        
        $titleFilter = $request->title ?? '';
        $dateFilter = $request->date ?? '';

        $reportQuery = Report::query();
        if ($titleFilter !== '') {
            $reportQuery->where('title', 'like', "%$titleFilter%");
        }

        if ($dateFilter !== '') {
            $reportQuery->whereDate('created_at', $dateFilter);
        }
        
        $reports = $reportQuery->paginate(10); 
       
        return view('reports.index', compact('reports', 'titleFilter', 'dateFilter'));
    }

    public function show(Report $report): View
    {
        return view('reports.show')->withReport($report);
    }


    public function create(): View
    {
        $newReport = new Report();
        $allPrograms = Program::all();
        return view('reports.create')
            ->with('report', $newReport)
            ->with('allPrograms', $allPrograms);
    }


    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'file_attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,txt|max:10240',
    ]);
    $fileName = null;
    
    if ($request->hasFile('file_attachment')) {
        $file = $request->file('file_attachment');
        if ($file->isValid()) {
            $fileName = $file->getClientOriginalName();
            $path = $file->storeAs('attachments', $fileName, 'public');
        } 
    } 

    $formData = [
        'researcher_id' => Auth::user()->id,
        'program_id' => $request->has('program_id') ? $request['program_id'] : null,
        'title' => $request['title'],
        'description' => $request['description'],
        'severity' => $request['severity'],
        'status' => 'open',
        'proof_of_concept' => $fileName, 
    ];

    $newReport = Report::create($formData);

    Alert::success('Report Created', 'Report created successfully!');

    return redirect()->route('home');
}



}
