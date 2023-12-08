<?php

namespace App\Http\Controllers;

use App\Models\Affiliation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MembersController extends Controller
{
   public function addMembers()
   {
      $affiliations = Affiliation::latest()->get();
      return view('members', [
         "affiliations" => $affiliations,
      ]);
   }

   public function create(Request $request)
   {
      $request->validate([
         'username' => ['required', 'string', 'max:255'],
         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
         'password' => ['required', 'confirmed'],
         'name' => ['required', 'string', 'max:255'],
         'father_name' => ['required', 'string', 'max:255'],
         'cnic' => ['nullable',"digits:13","numeric"],
         'dob' => ['nullable', 'string'],
         'gender' => ['nullable','integer'],
         'social_media' => ['nullable','string', 'max:255'],
         'referer' => ['nullable','string', 'max:255'],
         'membership_date' => ['required','string'],
         'affiliations' => ['required','not_in:0','string', 'max:255'],
         'constituency' => ['required','not_in:0','string', 'max:255'],
         'union_council' => ['required','not_in:0','string', 'max:255'],
         'ward' => ['required','not_in:0','string', 'max:255'],
         'geographical_address' => ['nullable','string', 'max:255'],
         'local_jamat' => ['nullable','string', 'max:255'],
         'city' => ['nullable','string', 'max:255'],
         'village' => ['nullable','string', 'max:255'],
         'mailing_address' => ['nullable','string', 'max:255'],
         'occupation' => ['nullable','string', 'max:255'],
         'education' => ['nullable','string', 'max:255'],
         'home_phone' => ['nullable',"digits_between:10,11","numeric"],
         'office_phone' => ['nullable', "digits_between:10,11","numeric"],
         'mobile_phone' => ['nullable',"digits_between:10,11","numeric"],
      ]);

      $user = User::create([
         'username' => $request->username,
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

      return redirect()->back()->with("message", "Member added successfully!");
   }

   public function show($id)
   {
      $member = User::find($id);
      return view('showmember', [
         'member' => $member
      ]);
   }

   public function showAllMembers()
   {
      $members = null;

      if (request('search')) {
         $search = request('search');
         $members = User::query()
            ->where(["type" => 1])
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('father_name', 'LIKE', "%{$search}%")
            ->orWhere('city', 'LIKE', "%{$search}%")
            ->get();
      } else {
         $members = User::where(["type" => 1])
            ->latest()->get();
      }

      return view('memberslist', [
         'members' => $members
      ]);
   }

   public function verify($id){
      User::where('id',$id)->update(['verified'=> 1]);
      return redirect()->back()->with("message", "user verified successfully!");
   }
}
