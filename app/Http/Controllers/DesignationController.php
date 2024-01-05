<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $designations = Designation::latest()->get();
        return view("designation.create",[
            "designations" => $designations
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'designation_title' => ['required', 'string', 'max:255'],
        ]);

        $affiliation = Designation::create([
            'designation_title' => $request->designation_title,
        ]);

        return redirect()->back()->with("message", "designation added successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Designation $designation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Designation $designation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Designation $designation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Designation $designation)
    {
        $designation->delete();
        return redirect()->back()->with("message","Designation deleted successfully!");
    }
}
