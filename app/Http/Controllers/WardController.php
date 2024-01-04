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

    public function destroy(Ward $ward)
    {
        $ward->delete();
        return redirect()->back()->with('message', 'Ward deleted successfully!');
    }

    public function update(Request $request, Ward $ward)
    {
        Ward::whereId($ward->id)->update([
            "ward_title" => $request->ward_title
        ]);
        return redirect()->back()->with("message", "ward updated successfully!");
    }

    public function addPopulation(Request $request, $id)
    {
        Ward::whereId($id)->update([
            "population" => $request->population
        ]);
        return redirect()->back()->with("message", "Population added successfully!");
    }
}
