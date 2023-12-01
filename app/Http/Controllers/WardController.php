<?php

namespace App\Http\Controllers;

use App\Models\Ward;
use Illuminate\Http\Request;

class WardController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ward_title' => ['required', 'string', 'max:255'],
            'union_council' => ['required'],
        ]);

        $ward = Ward::create([
            'ward_title' => $request->ward_title,
            'union_council_id' => $request->union_council,
        ]);

        return redirect()->back()->with("message", "Ward added successfully!");
    }
}
