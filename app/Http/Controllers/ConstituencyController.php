<?php

namespace App\Http\Controllers;

use App\Models\Constituency;
use Illuminate\Http\Request;

class ConstituencyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'constituency_title' => ['required', 'string', 'max:255'],
            'affiliation' => ['required'],
        ]);

        $constituency = Constituency::create([
            'constituency_title' => $request->constituency_title,
            'affiliation_id' => $request->affiliation,
        ]);

        return redirect()->back()->with("message", "constituency added successfully!");
    }
}
