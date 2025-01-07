<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reward;

class RewardsController extends Controller
{
    public function myPayments()
    {
        $user = Auth::user();
        if ($user->type == 'E') {
            $payments = Reward::where('created_by', $user->id)->paginate(10);
            return view('rewards.myRewards', compact('payments'));
        }else if ($user->type == 'C')
        $payments = Reward::where('researcher_id', $user->id)->paginate(10);
        return view('rewards.myRewards', compact('payments'));
    }
}
