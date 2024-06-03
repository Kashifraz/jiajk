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

    public function destroy(Constituency $constituency)
    {
        foreach ($constituency->unioncouncil as $unionCouncil) {
            foreach ($unionCouncil->ward as $ward) {
                $ward->delete();
            }
            $unionCouncil->delete();
        }
        $constituency->delete();
        return redirect()->back()->with('message', 'Constituency deleted successfully!');
    }

    public function update(Request $request, Constituency $constituency)
    {
        Constituency::whereId($constituency->id)->update([
            "constituency_title" => $request->constituency_title
        ]);
        return redirect()->back()->with("message", "Constituency updated successfully!");
    }


        /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $constituency = Constituency::with('unioncouncil')->findOrFail($id);
        return view('region.constituency', [
            "constituency" => $constituency,
        ]);
    }
}
