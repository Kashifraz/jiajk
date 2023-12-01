<?php

namespace App\Http\Controllers;

use App\Models\UnionCouncil;
use Illuminate\Http\Request;

class UnionCouncilController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'union_council_title' => ['required', 'string', 'max:255'],
            'constituency' => ['required'],
        ]);

        $constituency = UnionCouncil::create([
            'union_council_title' => $request->union_council_title,
            'constituency_id' => $request->constituency,
        ]);

        return redirect()->back()->with("message", "Union Council added successfully!");
    }
}
