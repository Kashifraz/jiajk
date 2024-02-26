<?php

namespace App\Http\Controllers;

use App\Models\FormA;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Show the Question for creating a new resource.
     */
    public function updateApprovalPresident(Request $request, $id)
    {
        $formA = FormA::find($id);
        $formA->president_approval = $request->approval;
        $formA->president_comment = $request->comments;
        $formA->president_approval_date = date("Y/m/d");
        $formA->president_id = Auth::user()->id;
        $formA->save();

        return redirect()->back()->with('message', 'approval submitted successfully');
    }

    public function updateApprovalSG(Request $request, $id)
    {
        $formA = FormA::find($id);
        $formA->sg_approval = $request->approval;
        $formA->sg_comment = $request->comments;
        $formA->sg_approval_date = date("Y/m/d");
        $formA->sg_id = Auth::user()->id;
        $formA->save();

        return redirect()->back()->with('message', 'approval submitted successfully');
    }
    public function approval()
    {
        $users = User::with('forma')->get();

        $users = User::with('forma')->whereHas('forma', function ($query) {
            $query->whereNotNull(['form_a']);
        })->get();

        return view('forms.approval', [
            "users" => $users
        ]);
    }

    public function showForm($id)
    {
        $formA = FormA::find($id);
        $questions = Question::where("form_type", 1)->orderBy('question_order', 'ASC')->get();
        $ids = array();

        foreach ($questions as $question) {
            array_push($ids, $question->id);
        }
        return view('forms.show', [
            'formA' => $formA,
            'ids' => json_encode($ids)
        ]);
    }

    public function create()
    {
        $auth_user = Auth::user();
        if (!$auth_user->can('view questions')) {
            die("Warning! Access to the resource is denied");
        }
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
        $auth_user = Auth::user();
        if (!$auth_user->can('add questions')) {
            die("Warning! You are not Authorized to Perform this Action");
        }
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
        $auth_user = Auth::user();
        if (!$auth_user->can('forma view')) {
            die("Warning! Access to the resource is denied");
        }
        $questions = Question::where("form_type", 1)->orderBy('question_order', 'ASC')->get();
        return view("forms.formA", [
            "questions" => $questions,
            "user" => $user
        ]);
    }

    public function submitFormA(Request $request, User $user = null)
    {
        $auth_user = Auth::user();
        if (!$auth_user->can('forma submit')) {
            die("Warning! You are not Authorized to Perform this Action");
        }
        $question_ids = json_decode($request->ids);
        $answers = null;
        for ($id = 0; $id < count($question_ids); $id++) {
            $answers[] = [
                'question_' . $question_ids[$id] => $request->answer[$id]
            ];
        }

        if (Auth::user()->type != 2) {
            // $user = User::whereId(Auth::user()->id)->update([
            //     "form_a" => json_encode($answers)
            // ]);
            FormA::create([
                "user_id" => Auth::user()->id,
                "form_a" => json_encode($answers)
            ]);
        } else {
            // $user = User::whereId($user->id)->update([
            //     "form_a" => json_encode($answers)
            // ]);
            FormA::create([
                "user_id" => $user->id,
                "form_a" => json_encode($answers)
            ]);
        }

        return redirect()->back()->with("message", "Form A submitted successfully");
    }

    public function showFormB(User $user)
    {
        $auth_user = Auth::user();
        if (!$auth_user->can('formb view')) {
            die("Warning! Access to the resource is denied");
        }
        $questions = Question::where("form_type", 2)->orderBy('question_order', 'ASC')->get();
        return view("forms.formB", [
            "questions" => $questions,
            "user" => $user
        ]);
    }

    public function submitFormB(Request $request, User $user = null)
    {
        $auth_user = Auth::user();
        if (!$auth_user->can('formb submit')) {
            die("Warning! You are not Authorized to Perform this Action");
        }
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
        $auth_user = Auth::user();
        if (!$auth_user->can('edit questions')) {
            die("Warning! Access to the resource is denied");
        }
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
        $auth_user = Auth::user();
        if (!$auth_user->can('edit questions')) {
            die("Warning! You are not Authorized to Perform this Action");
        }
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
        $auth_user = Auth::user();
        if (!$auth_user->can('delete questions')) {
            die("Warning! You are not Authorized to Perform this Action");
        }
        $Question->delete();
        return redirect()->back()
            ->with("message", "Question question deleted successfully!");
    }
}
