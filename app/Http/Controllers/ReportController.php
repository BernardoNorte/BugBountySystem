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
use App\Models\Reward;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $titleFilter = $request->input('title', '');

        if (Auth::user()->type == 'A') {
            $reports = Report::when($titleFilter, function ($query, $title) {
                return $query->where('title', 'like', '%' . $title . '%');
            })->paginate(10);
        } else if (Auth::user()->type == 'E') {
            $reports = Report::whereHas('program', function ($query) {
                $query->where('created_by', Auth::user()->id);
            })
                ->when($titleFilter, function ($query, $title) {
                    return $query->where('title', 'like', '%' . $title . '%');
                })
                ->paginate(10);

            return view('reports.index', compact('reports', 'titleFilter'));
        }

        return view('reports.index', compact('reports', 'titleFilter'));
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

        $activePrograms = Program::whereDate('date_limit', '>=', now()->toDateString())->get();

        return view('reports.create')
            ->with('report', $newReport)
            ->with('allPrograms', $activePrograms);
    }



    public function customReport(Program $program): View
    {
        $newReport = new Report();

        return view('reports.custom')
            ->with('report', $newReport)
            ->with('program', $program);
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
        //dd($request);

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
        if ($report->status == 'Open' || $report->status == 'in_review') {
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
        Alert::warning('Cannot do that', 'Report in review or concluded!');
        return redirect()->route('reports.myReports');
    }

    public function updateStatus(Request $request, Report $report): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:Open,in_review,Resolved,Rejected',
        ]);

        $report->update(['status' => $request->status]);
        
        if ($report->status == 'Rejected') {
            Alert::error('Status Updated', 'The report status has been rejected.');
            return redirect()->route('reports.index');
        }
        Alert::success('Status Updated', 'The report status has been updated successfully.');
        if ($report->status == 'Resolved' && $report->program) {


            $existingReward = Reward::where('report_id', $report->id)->first();

            if ($existingReward) {
                
                Alert::error('Payment Rejected', 'This report has already been paid for.');
                return redirect()->route('reports.index');
            }

            $program = $report->program;
            $rewardAmount = $program->rewards_info;

            $user = $report->user;
            $newMoneyAmount = $user->money + $rewardAmount;

            $user->update(['money' => $newMoneyAmount]);

            $newReward = new Reward();
            $newReward->report_id = $report->id;
            $newReward->researcher_id = $report->researcher_id;
            $newReward->amount = $rewardAmount;
            $newReward->created_by = Auth::user()->id;
            $newReward->save();

            Alert::success('Status Updated', 'The report status has been updated successfully and the reward has been issued.');
        }



        return redirect()->route('reports.index');
    }

    public function pay(Request $request, Report $report)
    {
        if ($report->status == 'Resolved') {
            $request->validate([
                'payment_amount' => 'required|numeric|min:0',
            ]);

            $existingReward = Reward::where('report_id', $report->id)->first();

            if ($existingReward) {
                
                Alert::error('Payment Rejected', 'This report has already been paid for.');
                return redirect()->route('reports.index');
            }

            $user = $report->user;
            $paymentAmount = $request->payment_amount;
            $newMoneyAmount = $user->money + $paymentAmount;

            $user->update(['money' => $newMoneyAmount]);

            $newReward = new Reward();
            $newReward->report_id = $report->id;
            $newReward->researcher_id = $report->researcher_id;
            $newReward->amount = $paymentAmount;
            $newReward->created_by = Auth::user()->id;
            $newReward->save();

            Alert::success('Payment Successful', 'The payment has been issued successfully.');
            return redirect()->route('reports.index');
        }
        Alert::error('Payment Rejected', 'The payment has been rejected, report isn´t resolved.');
        return redirect()->route('reports.index');
    }


    public function destroy(Report $report): RedirectResponse
    {
        $report->delete();
        Alert::success('Report Deleted', 'Report deleted successfully!');
        return redirect()->back();
    }
}
