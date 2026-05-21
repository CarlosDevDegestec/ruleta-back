<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Claim;

class ClaimController extends Controller
{
    public function index()
    {
        $claims = Claim::with('prize')->latest()->get();
        return view('admin.claims.index', compact('claims'));
    }
}
