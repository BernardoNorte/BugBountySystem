<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{

    public function usersWithMostReports()
    {
        $users = Report::select('researcher_id')
            ->with('user')
            ->groupBy('researcher_id')
            ->selectRaw('researcher_id, COUNT(*) as reports_count')
            ->orderByDesc('reports_count')
            ->take(20) 
            ->get();

        return view('leaderboard.index', compact('users'));
    }

}
