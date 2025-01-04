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
use App\Models\User;

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
        $user = Auth::user();

        return view('reports.show', compact('report'));
    }

    public function edit(Report $report): View
    {
        $allPrograms = Program::all();
        return view('reports.edit')->withReport($report)->with('programs', $allPrograms);
    }


    public function myReports(): View
    {
        $user = Auth::user();
        if ($user->type == 'C') {
            $reports = Report::where('researcher_id', $user->id)->paginate(10);
        }
        return view('reports.myReports', compact('reports'));
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
        //dd($request);
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
            'researcher_id' => Auth::check() ? Auth::user()->id : null,
            'program_id' => $request->has('program_id') ? $request['program_id'] : null,
            'title' => $request['title'],
            'description' => $request['description'],
            'severity' => $request['severity'],
            'status' => 'open',
            'steps_to_reproduce' => $request['stepsToReproduce'],
            'proof_of_concept' => $fileName,
        ];

        $newReport = Report::create($formData);

        Alert::success('Report Created', 'Report created successfully!');

        return redirect()->route('home');
    }

    public function update(Request $request, Report $report): RedirectResponse
    {
        //dd($request);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'steps_to_reproduce' => 'nullable|string',
            'program_id' => 'nullable|exists:programs,id',
            'severity' => 'nullable|string',
            'file_attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,txt|max:10240',
        ]);


        $fileName = $report->proof_of_concept;
        if ($request->hasFile('file_attachment')) {
            $file = $request->file('file_attachment');
            if ($file->isValid()) {

                $fileName = $file->getClientOriginalName();
                $file->storeAs('attachments', $fileName, 'public');
            }
        }


        $formData = [
            'researcher_id' => Auth::user()->id,
            'program_id' => $request->has('program_id') ? $request['program_id'] : null,
            'title' => $request['title'],
            'description' => $request['description'],
            'steps_to_reproduce' => $request['stepsToReproduce'],
            'severity' => $request['severity'],
            'status' => $report->status,
            'proof_of_concept' => $fileName,
        ];


        $report->update($formData);

        Alert::success('Report updated', 'Report updated successfully!');

        return redirect()->route('reports.myReports');
    }


    public function destroy(Report $report): RedirectResponse
    {
        $report->delete();
        Alert::success('Report Deleted', 'Report deleted successfully!');
        return redirect()->back();
    }
}
