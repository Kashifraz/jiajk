<?php

namespace App\Http\Controllers;

use App\Models\Affiliation;
use App\Models\Constituency;
use App\Models\UnionCouncil;
use App\Models\Ward;
use Illuminate\Http\Request;

class AffiliationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $affiliations = Affiliation::latest()->get();
        return view('region.edit', [
            "affiliations" => $affiliations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $affiliations = Affiliation::latest()->get();
        $constituencies = Constituency::latest()->get();
        $unioncouncils = UnionCouncil::latest()->get();
        $wards = Ward::latest()->get();
        return view('region.create', [
            "affiliations" => $affiliations,
            "constituencies" => $constituencies,
            "unioncouncils" => $unioncouncils,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'affiliation_title' => ['required', 'string', 'max:255'],
            'region' => ['required'],
        ]);

        $affiliation = Affiliation::create([
            'affiliation_title' => $request->affiliation_title,
            'region' => $request->region,
        ]);

        return redirect()->back()->with("message", "affiliation added successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $affiliation = Affiliation::with('Constituency')->findOrFail($id);
        return view('region.destrict', [
            "affiliation" => $affiliation,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Affiliation $affiliation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Affiliation $affiliation)
    {
        Affiliation::whereId($affiliation->id)->update([
            "affiliation_title" => $request->affiliation_title
        ]);
        return redirect()->back()->with("message", "Affiliation updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Affiliation $affiliation)
    {
        foreach ($affiliation->constituency as $constituency) {
            foreach ($constituency->unioncouncil as $unionCouncil) {
                foreach ($unionCouncil->ward as $ward) {
                    $ward->delete();
                }
                $unionCouncil->delete();
            }
            $constituency->delete();
        }
        $affiliation->delete();
        return redirect()->back()->with('message', 'Affiliation deleted successfully!');
    }
}
