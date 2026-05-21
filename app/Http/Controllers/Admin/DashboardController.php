<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prize;
use App\Models\Question;
use App\Models\Claim;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalPrizes'    => Prize::count(),
            'totalQuestions' => Question::count(),
            'totalClaims'    => Claim::count(),
        ]);
    }
}
