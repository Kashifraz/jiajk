@php
use App\Models\Affiliation;
use App\Models\Question;
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
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 underline ">Personal Information</h2>
                    <div class="grid grid-cols-4">
                        <div class="py-2 col-span-1 font-bold">Name</div>
                        <div class="py-2 col-span-3">
                            <p>{{$member->name}}</p>
                        </div>
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
                                            <option value="1" {{$member->type == 2 ? "selected": ""}}>Admin</option>
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
                                            @foreach ($designations as $designation )
                                            <option value="{{$designation->id}}" {{$member->type == 1 ? "selected": ""}}>{{$designation->designation_title}}</option>
                                            @endforeach
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

            <div class=" sm:rounded-lg bg-white shadow">
                <div class="p-4 relative overflow-x-auto rounded">
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 underline ">Location Information</h2>
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
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 underline ">Occupation Information</h2>
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
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 underline ">Academic Information</h2>
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
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 underline ">Contact Information</h2>
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

            @if ($member->form_a != NULL)
            <div class=" sm:rounded-lg bg-white shadow">
                <div class="p-4 relative overflow-x-auto rounded ">
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 underline ">Form A Answers</h2>
                    <div class="mb-5 pl-3">
                        <?php
                        $answers = json_decode($member->form_a, true);
                        $question_ids = json_decode($ids);
                        for ($i = 0; $i < count($question_ids); $i++) {
                            $key = "question_" . $question_ids[$i];
                            $question = Question::find($question_ids[$i]);
                            echo "<p class='text-lg font-medium py-3'>" . $question->question_title . "</p>";
                            if (!is_array($answers[$i][$key])) {
                                echo "<p class='text-md ml-3'>" . $answers[$i][$key] . "</p>";
                            } else {
                                foreach ($answers[$i][$key] as $option) {
                                    echo "<ul class='ml-3'>";
                                    echo "<li>" . $option . "</li>";
                                    echo "</ul>";
                                }
                            }
                        }
                        ?>
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

            @if ($member->form_b != NULL)
            <div class=" sm:rounded-lg bg-white shadow">
                <div class="p-4 relative overflow-x-auto rounded ">
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 underline ">Form B Answers</h2>
                    <div class="mb-5 pl-3">
                        <?php
                        $answers = json_decode($member->form_b, true);
                        $question_ids = json_decode($ids_b);
                        for ($i = 0; $i < count($question_ids); $i++) {
                            $key = "question_" . $question_ids[$i];
                            $question = Question::find($question_ids[$i]);
                            echo "<p class='text-lg font-medium py-3'>" . $question->question_title . "</p>";
                            if (!is_array($answers[$i][$key])) {
                                echo "<p class='text-md ml-3'>" . $answers[$i][$key] . "</p>";
                            } else {
                                foreach ($answers[$i][$key] as $option) {
                                    echo "<ul class='ml-3'>";
                                    echo "<li>" . $option . "</li>";
                                    echo "</ul>";
                                }
                            }
                        }
                        ?>
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
                                    Member promoted to GC
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