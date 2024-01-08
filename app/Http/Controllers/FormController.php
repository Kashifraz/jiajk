<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $formQuestions = Form::latest()->paginate(5);
        return view("forms.create", [
            "formQuestions" => $formQuestions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question_title' => ['required', 'string',],
            'form_type' => ['required'],
            'question_type' => ['required']
        ]);

        $form = Form::create([
            'question_title' => $request->question_title,
            'form_type' => $request->form_type,
            'question_type' => $request->question_type
        ]);

        return redirect()->back()->with("message", "question added successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Form $form)
    {
        $formQuestions = Form::latest()->paginate(5);
        return view("forms.create", [
            "form" => $form,
            "formQuestions" => $formQuestions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Form $form)
    {
        $request->validate([
            'question_title' => ['required', 'string'],
            'form_type' => ['required'],
            'question_type' => ['required']
        ]);

        $form->question_title = $request->question_title;
        $form->form_type = $request->form_type;
        $form->question_type = $request->question_type;
        $form->save();

        return redirect()->route("form.create")
            ->with("message", "Form question updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
        $form->delete();
        return redirect()->back()
            ->with("message", "Form question deleted successfully!");
    }
}
