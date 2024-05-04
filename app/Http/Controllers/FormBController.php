<?php

namespace App\Http\Controllers;

use App\Models\FormA;
use App\Models\FormB;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormBController extends Controller
{

    public function updateApprovalDPD(Request $request, $id)
    {
        $formA = FormB::find($id);
        $formA->dpd_approval = $request->approval;
        $formA->dpd_comment = $request->comments;
        $formA->dpd_approval_date = date("Y/m/d");
        $formA->dpd_id = Auth::user()->id;
        $formA->save();

        return redirect()->back()->with('message', 'approval submitted successfully');
    }

    public function updateApprovalSG(Request $request, $id)
    {
        $formA = FormB::find($id);
        $formA->sg_approval = $request->approval;
        $formA->sg_comment = $request->comments;
        $formA->sg_approval_date = date("Y/m/d");
        $formA->sg_id = Auth::user()->id;
        $formA->save();

        return redirect()->back()->with('message', 'approval submitted successfully');
    }

    public function updateApprovalDP(Request $request, $id)
    {
        $formB = FormB::find($id);
        $formB->pd_approval = $request->approval;
        $formB->pd_comment = $request->comments;
        $formB->pd_approval_date = date("Y/m/d");
        $formB->pd_id = Auth::user()->id;
        $formB->save();
        $user = User::find($formB->user->id);
        $user->member_level = "gc";
        $user->save();
        $user->assignRole('gc');
        $user->removeRole('applicant');
        return redirect()->back()->with('message', 'approval submitted successfully');
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
            FormB::create([
                "user_id" => Auth::user()->id,
                "form_b" => json_encode($answers)
            ]);
        } else {
            FormB::create([
                "user_id" => $user->id,
                "form_b" => json_encode($answers)
            ]);
        }

        return redirect()->back()->with("message", "Form B submitted successfully");
    }


    public function showFormBDetails($id)
    {
        $formB = FormB::find($id);
        $questions = Question::where("form_type", 2)->orderBy('question_order', 'ASC')->get();
        $ids = array();

        foreach ($questions as $question) {
            array_push($ids, $question->id);
        }
        return view('forms.showB', [
            'formB' => $formB,
            'ids' => json_encode($ids)
        ]);
    }


    public function approvalFormB()
    {
        if (Auth::user()->can('first approval forma')) {
            $users = User::with('formb')->where('affiliations', Auth::user()->affiliations)->whereHas('formb', function ($query) {
                $query->whereNotNull(['form_b']);
            })->get();
        } else {
            $users = User::with('formb')->whereHas('formb', function ($query) {
                $query->whereNotNull(['form_b']);
            })->get();
        }

        return view('forms.approvalB', [
            "users" => $users
        ]);
    }
}
