@php
use App\Models\Affiliation;
use App\Models\Question;
use App\Models\User;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Member Details') }}
            <a href="{{route('member.edit', $member->id)}}" class="ml-3 px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <i class="fa-solid fa-user-pen mr-1"></i>
                Edit
            </a>
        </h2>
    </x-slot>

    <div>
        @if(Session::has('message'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-5 ">
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Success alert!</span> {{ Session::get('message') }}
                </div>
            </div>
        </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5 pb-8 space-y-6">
            <div class=" sm:rounded-lg bg-white shadow">
                <div class="p-4 relative overflow-x-auto rounded">
                    <h2 class="mb-2 text-xl font-semibold text-gray-900 "><i class="fa-solid fa-id-card mx-2"></i> Personal Information</h2>
                    <div class="grid grid-cols-4">
                        <div class="py-2 col-span-4 font-bold">
                            <div class="flex items-center gap-4 mt-3 capitalize ">
                                @if (isset($member->profile))
                                <img class="w-20 h-20 rounded-full" src="{{ asset('uploads/'.$member->profile) }}" alt="">
                                @endif
                                <div class="font-medium">
                                    <div>{{$member->name}}</div>
                                    <div class="text-sm text-gray-500">{{$member->created_at}}</div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="py-2 col-span-3">
                            <p>{{$member->name}}</p>
                        </div> -->
                        <div class="py-2 col-span-1 font-bold">Father Name</div>
                        <div class="py-2 col-span-3">{{$member->father_name}}</div>
                        <div class="py-2 col-span-1 font-bold">Status</div>
                        <div class="py-2 col-span-3">{{$member->verified == 1? "Verified": "Not Verified" }}</div>
                        <div class="py-2 col-span-1 font-bold">Email</div>
                        <div class="py-2 col-span-3">{{$member->email}}</div>
                        @if (Auth::user()->type == 2)
                        <div class="py-2 col-span-1 font-bold">Member Level</div>
                        <div class="py-2 col-span-3">
                            <div class=" col-span-2 inline-flex">
                                <p class="capitalize">{{$member->member_level}}</p>
                                @if ($member->member_level === "applicant")
                                <a href="{{route('form.show.b', $member->id )}}" class=" ml-3 font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">
                                    Submit form B
                                </a>
                                @elseif($member->member_level === "member")
                                <a href="{{route('form.show.a', $member->id )}}" class=" ml-3 font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">
                                    Submit form A
                                </a>
                                @endif

                            </div>

                        </div>
                        <div class="py-2 col-span-1 font-bold">Member Role</div>
                        <div class="py-2 col-span-3">
                            <form action="{{route('member.role.update', $member->id)}}" method="post">
                                <div class="grid grid-cols-5">
                                    @csrf
                                    <div class=" col-span-2">
                                        <select id="role" name="role" class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                            <option value="1" {{$member->type == 1 ? "selected": ""}}>Member</option>
                                            <option value="2" {{$member->type == 2 ? "selected": ""}}>Admin</option>
                                            <option value="3" {{$member->type == 3 ? "selected": ""}}>Moderator</option>
                                        </select>
                                    </div>
                                    <div class="col-span-2">
                                        <button type="submit" class="ml-3 px-3 py-3 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            update
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="py-2 col-span-1 font-bold">Member Designation</div>
                        <div class="py-2 col-span-3">
                            <form action="{{route('member.designation.update', $member->id)}}" method="post">
                                <div class="grid grid-cols-8">
                                    @csrf
                                    <div class=" col-span-3">
                                        <select id="designation" name="designation" class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                            <option value="1" {{$member->designation == 1 ? "selected": ""}}>District President</option>
                                            <option value="2" {{$member->designation == 2 ? "selected": ""}}>Secretary General</option>
                                            <option value="3" {{$member->designation == 3 ? "selected": ""}}>President</option>

                                            <!-- @foreach ($designations as $designation )
                                            <option value="{{$designation->id}}" {{$member->type == 1 ? "selected": ""}}>{{$designation->designation_title}}</option>
                                            @endforeach -->
                                        </select>
                                    </div>
                                    <div class=" col-span-3">
                                        <select id="designation_level" name="designation_level" class=" mx-3 bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                            <option value="1" {{$member->designation_level == 1 ? "selected": ""}}>Central</option>
                                            <option value="2" {{$member->designation_level == 2 ? "selected": ""}}>Destrict</option>
                                            <option value="3" {{$member->designation_level == 3 ? "selected": ""}}>Constituency</option>
                                            <option value="4" {{$member->designation_level == 4 ? "selected": ""}}>Unioncouncil</option>
                                            <option value="5" {{$member->designation_level == 5 ? "selected": ""}}>Ward</option>
                                        </select>
                                    </div>
                                    <div class="ml-3 col-span-2">
                                        <button type="submit" class="mx-3 px-3 py-3 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            update
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>


            <div class="grid grid-cols-2 gap-4">

                <div class="sm:rounded-lg bg-white shadow">
                    <div class="p-4 relative overflow-x-auto rounded">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900 "><i class="fa-solid fa-location-crosshairs mx-2"></i>Location Information</h2>
                        <div class="grid grid-cols-4">
                            <div class="py-2 col-span-1 font-bold">Geographical Address</div>
                            <div class="py-2 col-span-3">
                                <p>{{$member->geographical_address}}</p>
                            </div>
                            <div class="py-2 col-span-1 font-bold">Local Jamat</div>
                            <div class="py-2 col-span-3">{{$member->local_jamat}}</div>
                            <div class="py-2 col-span-1 font-bold">City</div>
                            <div class="py-2 col-span-3">{{$member->city}}</div>
                            <div class="py-2 col-span-1 font-bold">Village</div>
                            <div class="py-2 col-span-3">{{$member->village}}</div>
                            <div class="py-2 col-span-1 font-bold">Mailing Address</div>
                            <div class="py-2 col-span-3">{{$member->mailing_address}}</div>
                        </div>
                    </div>
                </div>

                <div class=" sm:rounded-lg bg-white shadow">
                    <div class="p-4 relative overflow-x-auto rounded">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900"> <i class="fa-solid fa-briefcase mx-2"></i> Occupation Information</h2>
                        <div class="grid grid-cols-4">
                            <div class="py-2 col-span-1 font-bold">Occupation</div>
                            <div class="py-2 col-span-3">
                                <p>{{$member->occupation}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" sm:rounded-lg bg-white shadow">
                    <div class="p-4 relative overflow-x-auto rounded">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900"><i class="fa-solid fa-user-graduate mx-2"></i> Academic Information</h2>
                        <div class="grid grid-cols-4">
                            <div class="py-2 col-span-1 font-bold">Education</div>
                            <div class="py-2 col-span-3">
                                <p>{{$member->education}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" sm:rounded-lg bg-white shadow">
                    <div class="p-4 relative overflow-x-auto rounded">
                        <h2 class="mb-2 text-xl font-semibold text-gray-900 "> <i class="fa-solid fa-square-phone mx-2 "></i> Contact Information</h2>
                        <div class="grid grid-cols-4">
                            <div class="py-2 col-span-1 font-bold">Office Phone</div>
                            <div class="py-2 col-span-3">
                                <p>{{$member->office_phone}}</p>
                            </div>
                            <div class="py-2 col-span-1 font-bold">Home Phone</div>
                            <div class="py-2 col-span-3">
                                <p>{{$member->home_phone}}</p>
                            </div>
                            <div class="py-2 col-span-1 font-bold">Mobile Phone</div>
                            <div class="py-2 col-span-3">
                                <p>{{$member->mobile_phone}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @if (isset($member->forma->form_a))
            <div class=" sm:rounded-lg bg-white shadow">
                <div class="p-4 relative overflow-x-auto rounded ">
                    <h2 class="mb-2 text-xl font-semibold text-gray-900"> <i class="fa-solid fa-file-lines mx-2"></i> Form A Status</h2>
                    <div class="mb-5 pl-3">
                        <ul class="space-y-4 text-left text-gray-900 ">

                            <!-- form A district president approval  status-->
                            @php
                            $dpd = User::find($member->forma->dpd_id);
                            @endphp
                            @if ($member->forma->dpd_approval == "approve")
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <i class="fa-solid fa-square-check text-green-500 text-xl"></i>
                                <span>The Form A is approved by district president <b class="capitalize">Mr/Ms {{$dpd->name}}</b> on {{$member->forma->dpd_approval_date}}</span>
                            </li>
                            @elseif($member->forma->dpd_approval == "disapprove")
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <i class="fa-solid fa-square-xmark text-red-500 text-xl"></i>
                                <span>The Form A is disapproved by district president <b class="capitalize">Mr/Ms {{$dpd->name}}</b> on {{$member->forma->dpd_approval_date}}</span>
                            </li>
                            @else
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <i class="fa-solid fa-bars-progress text-orange-500 text-xl"></i>
                                <span>The Form A approval by district president is pending</span>
                            </li>
                            @endif

                            <!-- Form A secretery general approval status -->
                            @php
                            $sg = User::find($member->forma->sg_id);
                            @endphp
                            @if ($member->forma->sg_approval == "approve")
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <i class="fa-solid fa-square-check text-green-500 text-xl"></i>
                                <span>The Form A is approved by secretery general <b class="capitalize">Mr/Ms {{$sg->name}}</b> on {{$member->forma->sg_approval_date}}</span>
                            </li>
                            @elseif($member->forma->sg_approval == "disapprove")
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <i class="fa-solid fa-square-xmark text-red-500 text-xl"></i>
                                <span>The Form A is by secretery general <b class="capitalize">Mr/Ms {{$sg->name}}</b> on {{$member->forma->sg_approval_date}}</span>
                            </li>
                            @else
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <i class="fa-solid fa-bars-progress text-orange-500 text-xl"></i>
                                <span>The Form A approval by secretery general is pending</span>
                            </li>
                            @endif
                        </ul>
                    </div>

                    <form action="{{route('member.level.update', $member->id)}}" method="post">
                        <div class="grid grid-cols-5">
                            @csrf
                            <div class="col-span-2">
                                @if ($member->member_level === "member")
                                <button type="submit" class="ml-3 px-3 py-3 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Promote Now
                                </button>
                                @else
                                <div class="bg-green-100 text-green-800 text-xs w-1/2 font-medium me-2 px-2.5 py-2 rounded mb-5 ml-4">
                                    Member promoted to Applicant
                                </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endif


            @if (isset($member->formb->form_b))
            <div class=" sm:rounded-lg bg-white shadow">
                <div class="p-4 relative overflow-x-auto rounded ">
                    <h2 class="mb-2 text-xl font-semibold text-gray-900 "> <i class="fa-solid fa-file-lines mx-2"></i> Form B Status</h2>
                    <div class="mb-5 pl-3">
                        <ul class="space-y-4 text-left text-gray-900 ">
                            <!-- form B district president approval status -->
                            @php
                            $dpd = User::find($member->formb->dpd_id);
                            @endphp
                            @if ($member->formb->dpd_approval == "approve")
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <i class="fa-solid fa-square-check text-green-500 text-xl"></i>
                                <span>The Form B is approved by district president <b class="capitalize">Mr/Ms {{$dpd->name}}</b> on {{$member->formb->dpd_approval_date}}</span>
                            </li>
                            @elseif($member->forma->dpd_approval == "disapprove")
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <i class="fa-solid fa-square-xmark text-red-500 text-xl"></i>
                                <span>The Form B is by disapproved district president <b class="capitalize">Mr/Ms {{$dpd->name}}</b> on {{$member->formb->dpd_approval_date}}</span>
                            </li>
                            @else
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <i class="fa-solid fa-bars-progress text-orange-500 text-xl"></i>
                                <span>The Form B approval by District President is pending</span>
                            </li>
                            @endif

                            <!-- form B secretery general approval status  -->
                            @php
                            $sg = User::find($member->formb->sg_id);
                            @endphp
                            @if ($member->formb->sg_approval == "approve")
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <i class="fa-solid fa-square-check text-green-500 text-xl"></i>
                                <span>The Form B is approved by secretery general <b class="capitalize">Mr/Ms {{$sg->name}}</b> on {{$member->formb->sg_approval_date}}</span>
                            </li>
                            @elseif($member->formb->sg_approval == "disapprove")
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <i class="fa-solid fa-square-xmark text-red-500 text-xl"></i>
                                <span>The Form B is by secretery general <b class="capitalize">Mr/Ms {{$sg->name}}</b> on {{$member->formb->sg_approval_date}}</span>
                            </li>
                            @else
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <i class="fa-solid fa-bars-progress text-orange-500 text-xl"></i>
                                <span>The Form B approval by secretery general is pending</span>
                            </li>
                            @endif

                            <!-- Form B president approval status -->
                            @php
                            $pd = User::find($member->formb->pd_id);
                            @endphp
                            @if ($member->formb->pd_approval == "approve")
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <i class="fa-solid fa-square-check text-green-500 text-xl"></i>
                                <span>The Form B is approved by president <b class="capitalize">Mr/Ms {{$pd->name}}</b> on {{$member->formb->pd_approval_date}}</span>
                            </li>
                            @elseif($member->formb->pd_approval == "disapprove")
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <i class="fa-solid fa-square-xmark text-red-500 text-xl"></i>
                                <span>The Form B is disapproved by president <b class="capitalize">Mr/Ms {{$pd->name}}</b> on {{$member->formb->pd_approval_date}}</span>
                            </li>
                            @else
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <i class="fa-solid fa-bars-progress text-orange-500 text-xl"></i>
                                <span>The Form B approval by president is pending</span>
                            </li>
                            @endif
                        </ul>
                    </div>

                    <form action="{{route('member.level.update', $member->id)}}" method="post">
                        <div class="grid grid-cols-5">
                            @csrf
                            <div class="col-span-2">
                                @if ($member->member_level === "applicant")
                                <button type="submit" class="ml-3 px-3 py-3 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Promote Now
                                </button>
                                @else
                                <div class="bg-green-100 text-green-800 text-xs w-1/2 font-medium me-2 px-2.5 py-2 rounded mb-5 ml-4">
                                    Member promoted to gc
                                </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>