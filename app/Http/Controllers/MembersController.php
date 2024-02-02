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
      $user->assignRole('member');
      return redirect()->back()->with("message", "Member added successfully!");
   }

   public function show($id)
   {
      $member = User::find($id);
      $designations = Designation::latest()->get();
      $questions = Question::where("form_type", 1)->orderBy('question_order', 'ASC')->get();
      $questions_b = Question::where("form_type", 2)->orderBy('question_order', 'ASC')->get();
      $ids = array();
      $ids_b = array();

      foreach ($questions as $question) {
         array_push($ids, $question->id);
      }

      foreach ($questions_b as $question) {
         array_push($ids_b, $question->id);
      }

      return view('member.show', [
         'member' => $member,
         'designations' => $designations,
         'ids' => json_encode($ids),
         'ids_b' => json_encode($ids_b)
      ]);
   }

   public function edit($id)
   {
      $user = Auth::user();
      if (!$user->can('edit member')) {
         die("Warning! Access to the resource is denied");
      }
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
      $user = Auth::user();
      if (!$user->can('edit member')) {
         die("Warning! Access to the resource is denied");
      }
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
      $user = Auth::user();
      if (!$user->can('show all members')) {
         die("Warning! Access to the resource is denied");
      }
      $search = request('search');
      $records = request('records');
      $level = request('level');
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

      if (request('level') && request('level') != null) {
         $members = $members->where("member_level", $level);
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
         'level' => $level,
         'destrict' => $destrict,
         'affiliations' => $affiliations
      ]);
   }

   public function verify($id)
   {
      $user = Auth::user();
      if (!$user->can('verify member')) {
         die("Warning! you are not authorized to perform this action.");
      }
      User::where('id', $id)->update(['verified' => 1]);
      return redirect()->back()->with("message", "user verified successfully!");
   }

   public function updateRole(Request $request, $id)
   {
      $user = Auth::user();
      if (!$user->can('update role')) {
         die("Warning! you are not authorized to perform this action.");
      }
      $member = User::find($id);

      User::whereId($id)->update([
         "type" => $request->role
      ]);
      return redirect()->back()->with('message', "Role updated successfully");
   }

   public function updateDesignation(Request $request, $id)
   {
      $user = Auth::user();
      if (!$user->can('update designation')) {
         die("Warning! you are not authorized to perform this action.");
      }
      $member = User::find($id);

      User::whereId($id)->update([
         "designation" => $request->designation,
         "designation_level" => $request->designation_level
      ]);

      return redirect()->back()->with('message', "Designation updated successfully");
   }

   public function promoteMember($id)
   {
      $user = Auth::user();
      if (!$user->can('promote member')) {
         die("Warning! you are not authorized to perform this action.");
      }
      $user = User::find($id);
      if ($user->member_level == "member") {
         User::whereId($id)->update([
            "member_level" => "applicant"
         ]);
         $user->assignRole('applicant');
         $user->removeRole('member');
      } else if ($user->member_level == "applicant") {
         User::whereId($id)->update([
            "member_level" => "gc"
         ]);
         $user->assignRole('gc');
         $user->removeRole('applicant');
      }
      return redirect()->back()->with("message", "Member promoted successfully!");
   }

   public function exportExcel()
   {
      $user = Auth::user();
      if (!$user->can('export excel')) {
         die("Warning! you are not authorized to perform this action.");
      }
      $search = request('search');
      $destrict = request('destrict');

      return Excel::download(new UsersExport($destrict, $search), 'users.xlsx');
   }
}
