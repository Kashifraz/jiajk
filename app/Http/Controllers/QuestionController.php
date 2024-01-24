<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the Question for creating a new resource.
     */
    public function create()
    {
        $formQuestions = Question::orderBy('question_order', 'ASC')->paginate(5);
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
            'question_order' => ['required'],
            'question_type' => ['required'],
        ]);

        $Question = Question::create([
            'question_title' => $request->question_title,
            'form_type' => $request->form_type,
            'question_order' => $request->question_order,
            'question_type' => $request->question_type,
            'options' => json_encode($request->options),
        ]);

        return redirect()->back()->with("message", "question added successfully");
    }

    /**
     * Display the specified resource.
     */
    public function showFormA(User $user)
    {
        $questions = Question::where("form_type", 1)->orderBy('question_order', 'ASC')->get();
        return view("forms.formA", [
            "questions" => $questions,
            "user" => $user
        ]);
    }

    public function submitFormA(Request $request, User $user = null)
    {
        $question_ids = json_decode($request->ids);
        $answers = null;
        for ($id = 0; $id < count($question_ids); $id++) {
            $answers[] = [
                'question_' . $question_ids[$id] => $request->answer[$id]
            ];
        }

        if (Auth::user()->type != 2) {
            $user = User::whereId(Auth::user()->id)->update([
                "form_a" => json_encode($answers)
            ]);
        } else {
            $user = User::whereId($user->id)->update([
                "form_a" => json_encode($answers)
            ]);
        }

        return redirect()->back()->with("message", "Form A submitted successfully");
    }

    public function showFormB(User $user)
    {
        $questions = Question::where("form_type", 2)->orderBy('question_order', 'ASC')->get();
        return view("forms.formB", [
            "questions" => $questions,
            "user" => $user
        ]);
    }

    public function submitFormB(Request $request, User $user = null)
    {
        $question_ids = json_decode($request->ids);
        $answers = null;
        for ($id = 0; $id < count($question_ids); $id++) {
            $answers[] = [
                'question_' . $question_ids[$id] => $request->answer[$id]
            ];
        }

        if (Auth::user()->type != 2) {
            $user = User::whereId(Auth::user()->id)->update([
                "form_b" => json_encode($answers)
            ]);
        } else {
            $user = User::whereId($user->id)->update([
                "form_b" => json_encode($answers)
            ]);
        }

        return redirect()->back()->with("message", "Form B submitted successfully");
    }

    /**
     * Show the Question for editing the specified resource.
     */
    public function edit(Question $Question)
    {
        $formQuestions = Question::orderBy('question_order', 'ASC')->paginate(5);
        return view("forms.create", [
            "form" => $Question,
            "formQuestions" => $formQuestions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $Question)
    {
        $request->validate([
            'question_title' => ['required', 'string'],
            'form_type' => ['required'],
            'question_order' => ['required'],
            'question_type' => ['required']
        ]);

        $Question->question_title = $request->question_title;
        $Question->form_type = $request->form_type;
        $Question->question_order = $request->question_order;
        $Question->question_type = $request->question_type;
        $Question->options = json_encode($request->options);
        $Question->save();

        return redirect()->route("form.create")
            ->with("message", "Form question updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $Question)
    {
        $Question->delete();
        return redirect()->back()
            ->with("message", "Question question deleted successfully!");
    }
}
