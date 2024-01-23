<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Affiliation;
use App\Models\Constituency;
use App\Models\Designation;
use App\Models\Question;
use App\Models\UnionCouncil;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class MembersController extends Controller
{
   public function addMembers()
   {
      $affiliations = Affiliation::latest()->get();
      return view('member.create', [
         "affiliations" => $affiliations,
      ]);
   }

   public function create(Request $request)
   {
      $affiliation_val = $request->constituency_status != 0 ? ['required', "not_in:0"] : [];
      $constituency_val = $request->union_status != 0 ? ['required', "not_in:0"] : [];
      $union_val = $request->ward_status != 0 ? ['required', "not_in:0"] : [];
      $request->validate([
         'username' => ['string', 'max:255'],
         // 'email' => ['string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
         // 'password' => ['confirmed'],
         'name' => ['required', 'string', 'max:255'],
         'father_name' => ['required', 'string', 'max:255'],
         'cnic' => ['nullable', "digits:13", "numeric"],
         'dob' => ['nullable', 'string'],
         'gender' => ['nullable', 'integer'],
         'social_media' => ['nullable', 'string', 'max:255'],
         'referer' => ['nullable', 'string', 'max:255'],
         'membership_date' => ['required', 'string'],
         'affiliations' => ['required', "not_in:0"],
         'constituency' => $affiliation_val,
         'union_council' => $constituency_val,
         'ward' => $union_val,
         'geographical_address' => ['nullable', 'string', 'max:255'],
         'local_jamat' => ['nullable', 'string', 'max:255'],
         'city' => ['nullable', 'string', 'max:255'],
         'village' => ['nullable', 'string', 'max:255'],
         'mailing_address' => ['nullable', 'string', 'max:255'],
         'occupation' => ['nullable', 'string', 'max:255'],
         'education' => ['nullable', 'string', 'max:255'],
         'home_phone' => ['nullable', "digits_between:10,11", "numeric"],
         'office_phone' => ['nullable', "digits_between:10,11", "numeric"],
         'mobile_phone' => ['required', "digits_between:10,11", "numeric"],
      ], [
         'affiliations.not_in' => 'The selected value was invalid.',
         'constituency.not_in' => 'The selected value was invalid.',
         'union_council.not_in' => 'The selected value was invalid.',
         'ward.not_in' => 'The selected value was invalid.',
      ]);

      $email = rand() . '@gmail.com';
      $password = rand();

      $user = User::create([
         'username' => $request->username,
         'email' => $request->email == null ? $email : $request->email,
         'password' => $request->password == null ? Hash::make($password) : Hash::make($request->password),
         'name' => $request->name,
         'father_name' => $request->father_name,
         'cnic' => $request->cnic,
         'dob' => $request->dob,
         'gender' => $request->gender,
         'social_media' => $request->social_media,
         'referer' => $request->referer,
         'membership_date' => $request->membership_date,
         'affiliations' => $request->affiliations,
         'constituency' => $request->constituency,
         'union_council' => $request->union_council,
         'ward' => $request->ward,
         'geographical_address' => $request->geographical_address,
         'local_jamat' => $request->local_jamat,
         'city' => $request->city,
         'village' => $request->village,
         'mailing_address' => $request->mailing_address,
         'occupation' => $request->occupation,
         'education' => $request->education,
         'home_phone' => $request->home_phone,
         'office_phone' => $request->office_phone,
         'mobile_phone' => $request->mobile_phone,
         'type' => 1,
      ]);

      return redirect()->back()->with("message", "Member added successfully!");
   }

   public function show($id)
   {
      $member = User::find($id);
      $designations = Designation::latest()->get();
      $questions = Question::where("form_type", 1)->orderBy('question_order', 'ASC')->get();
      $ids = array();
      foreach ($questions as $question) {
         array_push($ids, $question->id);
      }
      return view('member.show', [
         'member' => $member,
         'designations' => $designations,
         'questions' => $questions,
         'ids' => json_encode($ids)
      ]);
   }

   public function edit($id)
   {
      $member = User::find($id);
      $affiliations = Affiliation::latest()->get();
      $constituencies = Constituency::where("affiliation_id", $member->affiliations)->get();
      $unioncouncils = UnionCouncil::where("constituency_id", $member->constituency)->get();
      $wards = Ward::where("union_council_id", $member->union_council)->get();
      return view('member.edit', [
         'member' => $member,
         'affiliations' => $affiliations,
         'constituencies' => $constituencies,
         'unioncouncils' => $unioncouncils,
         'wards' => $wards
      ]);
   }

   public function update(Request $request, $id)
   {
      $affiliation_val = $request->constituency_status != 0 ? ['required', "not_in:0"] : [];
      $constituency_val = $request->union_status != 0 ? ['required', "not_in:0"] : [];
      $union_val = $request->ward_status != 0 ? ['required', "not_in:0"] : [];
      $request->validate([
         'email' => ['string', 'lowercase', 'email', 'max:255'],
         'password' => ['confirmed'],
         'name' => ['required', 'string', 'max:255'],
         'father_name' => ['required', 'string', 'max:255'],
         'cnic' => ['nullable', "digits:13", "numeric"],
         'dob' => ['nullable', 'string'],
         'gender' => ['nullable', 'integer'],
         'social_media' => ['nullable', 'string', 'max:255'],
         'referer' => ['nullable', 'string', 'max:255'],
         'membership_date' => ['required', 'string'],
         'affiliations' => ['required', "not_in:0"],
         'constituency' => $affiliation_val,
         'union_council' => $constituency_val,
         'ward' => $union_val,
         'geographical_address' => ['nullable', 'string', 'max:255'],
         'local_jamat' => ['nullable', 'string', 'max:255'],
         'city' => ['nullable', 'string', 'max:255'],
         'village' => ['nullable', 'string', 'max:255'],
         'mailing_address' => ['nullable', 'string', 'max:255'],
         'occupation' => ['nullable', 'string', 'max:255'],
         'education' => ['nullable', 'string', 'max:255'],
         'home_phone' => ['nullable', "digits_between:10,11", "numeric"],
         'office_phone' => ['nullable', "digits_between:10,11", "numeric"],
         'mobile_phone' => ['required', "digits_between:10,11", "numeric"],
      ], [
         'affiliations.not_in' => 'The selected value was invalid.',
         'constituency.not_in' => 'The selected value was invalid.',
         'union_council.not_in' => 'The selected value was invalid.',
         'ward.not_in' => 'The selected value was invalid.',
      ]);

      $user = User::whereId($id)->update([
         'email' => $request->email,
         'password' => Hash::make($request->password),
         'name' => $request->name,
         'father_name' => $request->father_name,
         'cnic' => $request->cnic,
         'dob' => $request->dob,
         'gender' => $request->gender,
         'social_media' => $request->social_media,
         'referer' => $request->referer,
         'membership_date' => $request->membership_date,
         'affiliations' => $request->affiliations,
         'constituency' => $request->constituency,
         'union_council' => $request->union_council,
         'ward' => $request->ward,
         'geographical_address' => $request->geographical_address,
         'local_jamat' => $request->local_jamat,
         'city' => $request->city,
         'village' => $request->village,
         'mailing_address' => $request->mailing_address,
         'occupation' => $request->occupation,
         'education' => $request->education,
         'home_phone' => $request->home_phone,
         'office_phone' => $request->office_phone,
         'mobile_phone' => $request->mobile_phone,
         'type' => 1,
      ]);

      return redirect()->back()->with("message", "Updated added successfully!");
   }



   public function showAllMembers()
   {
      $search = request('search');
      $records = request('records');
      $destrict = request('destrict');
      $members = User::query();
      $affiliations = Affiliation::all();
      if (Auth::user()->type == 3) {
         $destrict_auth = Auth::user()->affiliations;
         $members = $members->where("affiliations", "=", $destrict_auth)
            ->where(["type" => 1])->latest();
      }

      if (request('destrict') && request('destrict') != null) {
         $members = $members->where("affiliations", "=", $destrict);
      }
      if (request('search')) {
         $members = $members->where('name', 'LIKE', "%{$search}%")
            ->orWhere('father_name', 'LIKE', "%{$search}%")
            ->orWhere('city', 'LIKE', "%{$search}%");
      }

      return view('member.list', [
         'members' => $members->paginate($records != null ? $records : 10),
         'search' => $search,
         'records' => $records,
         'destrict' => $destrict,
         'affiliations' => $affiliations
      ]);
   }

   public function verify($id)
   {
      User::where('id', $id)->update(['verified' => 1]);
      return redirect()->back()->with("message", "user verified successfully!");
   }

   public function updateRole(Request $request, $id)
   {
      $member = User::find($id);

      User::whereId($id)->update([
         "type" => $request->role
      ]);
      return redirect()->back()->with('message', "Role updated successfully");
   }

   public function updateDesignation(Request $request, $id)
   {
      $member = User::find($id);

      User::whereId($id)->update([
         "designation" => $request->designation,
         "designation_level" => $request->designation_level
      ]);

      return redirect()->back()->with('message', "Designation updated successfully");
   }

   public function promoteMember($id)
   {
      User::whereId($id)->update([
         "member_level" => "applicant"
      ]);
      return redirect()->back()->with("message", "Member promoted successfully!");
   }

   public function exportExcel()
   {
      $search = request('search');
      $destrict = request('destrict');

      return Excel::download(new UsersExport($destrict, $search),'users.xlsx');
   }
}
