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

    public function destroy(UnionCouncil $unionCouncil)
    {
        foreach ($unionCouncil->ward as $ward) {
            $ward->delete();
        }
        $unionCouncil->delete();
        return redirect()->back()->with('message', 'Union Council deleted successfully!');
    }

    public function update(Request $request, UnionCouncil $unionCouncil)
    {
        UnionCouncil::whereId($unionCouncil->id)->update([
            "union_council_title" => $request->union_council_title
        ]);
        return redirect()->back()->with("message", "Union Council updated successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $UnionCouncil = UnionCouncil::with('ward','Constituency.affiliation')->findOrFail($id);
        return view('region.unioncouncil', [
            "UnionCouncil" => $UnionCouncil,
        ]);
    }
}
