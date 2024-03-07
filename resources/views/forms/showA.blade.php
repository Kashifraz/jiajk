<?php

use App\Models\Question;
use App\Models\User;

$member = $formA->user;
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Approval') }}
        </h2>
    </x-slot>

    <div>
        @if(Session::has('message'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-5">
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

        <div class="py-5  gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class=" p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-4">
                <div class="md:col-span-3">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">
                        Showing Member information for <b class="capitalize">{{$formA->user->name}}</b>
                    </h2>
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

                        <div class="py-2 col-span-1 font-bold">Father Name</div>
                        <div class="py-2 col-span-3">{{$member->father_name}}</div>
                        <div class="py-2 col-span-1 font-bold">Status</div>
                        <div class="py-2 col-span-3">{{$member->verified == 1? "Verified": "Not Verified" }}</div>
                        <div class="py-2 col-span-1 font-bold">Email</div>
                        <div class="py-2 col-span-3">{{$member->email}}</div>
                    </div>
                </div>
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

                <div class="p-4 relative overflow-x-auto rounded">
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 underline ">Occupation Information</h2>
                    <div class="grid grid-cols-4">
                        <div class="py-2 col-span-1 font-bold">Occupation</div>
                        <div class="py-2 col-span-3">
                            <p>{{$member->occupation}}</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 relative overflow-x-auto rounded">
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 underline ">Academic Information</h2>
                    <div class="grid grid-cols-4">
                        <div class="py-2 col-span-1 font-bold">Education</div>
                        <div class="py-2 col-span-3">
                            <p>{{$member->education}}</p>
                        </div>
                    </div>
                </div>

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


            <div class=" p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="md:col-span-3">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">
                        Showing Form A for <b class="capitalize">{{$formA->user->name}}</b>
                    </h2>
                    @if (isset($formA->form_a))
                    <div class="p-4 relative overflow-x-auto rounded ">
                        <div class="mb-5 pl-3">
                            <?php
                            $answers = json_decode($formA->form_a, true);
                            $question_ids = json_decode($ids);
                            for ($i = 0; $i < count($question_ids); $i++) {
                                $key = "question_" . $question_ids[$i];
                                $question = Question::find($question_ids[$i]);
                                echo "<p class='text-lg font-medium py-3'>" . $question->question_title . "</p>";
                                if (isset($answers[$i][$key])) {
                                    if (!is_array($answers[$i][$key])) {
                                        echo "<p class='text-md ml-3 mb-3'>" . $answers[$i][$key] . "</p>";
                                    } else {
                                        foreach ($answers[$i][$key] as $option) {
                                            echo "<ul class='ml-3'>";
                                            echo "<li class='mb-3'>" . $option . "</li>";
                                            echo "</ul>";
                                        }
                                    }
                                } else {
                                    echo "<p class='text-md ml-3 mb-3'> no answer</p>";
                                }
                                echo "<hr>";
                            }
                            ?>
                        </div>

                    </div>
                    @endif
                </div>
            </div>
            @if($formA->sg_approval == null || $formA->dpd_approval == null )
            @if (($formA->dpd_approval != null && $formA->dpd_approval != "disapprove" && Auth::user()->can('second approval forma'))
            ||($formA->dpd_approval == null && Auth::user()->can('first approval forma')))
            <div class="p-4 mt-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="text-lg font-medium text-gray-900 mb-4">
                    Submit your aprroval
                </h2>
                <form method="post" action="{{ Auth::user()->can('first approval forma') ? route('form.approval.dpd', $formA->id):route('form.approval.sg', $formA->id) }}" class="mt-6 space-y-6">
                    @csrf
                    <div class="mb-5 w-1/2 ">
                        <label for="approval" class="block mb-2 text-sm font-medium text-gray-900 ">Your Approval</label>
                        <select id="approval" name="approval" class="mr-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                            <option value="approve">Approve</option>
                            <option value="disapprove">Disapprove</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('form_type')" />
                    </div>
                    <div class="mb-5">
                        <label for="comments" class="block mb-2 text-sm font-medium text-gray-900 ">Your comments</label>
                        <textarea id="comments" name="comments" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('comments')" />
                    </div>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Submit</button>
                </form>
            </div>
            @elseif($formA->dpd_approval == null)
            <div class="p-4 mt-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="text-lg font-medium text-blue-600 text-center my-4">
                    Note: Awaiting District president's approval.
                </h2>
            </div>
            @endif
            @endif

            @if($formA->dpd_approval != null)
            <div class="p-4 mt-4 sm:p-8 bg-white shadow sm:rounded-lg  antialiased">
                <div class="max-w-full mx-auto px-4">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">
                        Comments by Approvers
                    </h2>
                    @php
                    $dpd = User::find($formA->dpd_id);
                    @endphp
                    <article class="p-6 text-base bg-white rounded-lg">
                        <footer class="flex justify-start items-center mb-2">
                            <div class="flex items-center">
                                <p class="inline-flex items-center mr-3 text-sm text-gray-900  font-semibold">
                                    @if ($dpd->profile)
                                    <img class="mr-2 w-6 h-6 rounded-full" src="{{ asset('uploads/'.$dpd->profile) }}" alt="Michael Gough">
                                    @endif
                                    <span class="capitalize">{{"Mr/Ms ".$dpd->name}} - (DPD)</span>
                                </p>
                                <p class="text-sm text-gray-600 ">{{date("F d, Y", strtotime($formA->dpd_approval_date))}}
                                    @if ($formA->dpd_approval == "approve")
                                    <span class="bg-green-200 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded mx-3">Approved</span>
                                    @elseif($formA->dpd_approval == "disapprove")
                                    <span class="bg-red-200 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded mx-3">Disapproved</span>
                                    @endif
                                </p>
                            </div>
                        </footer>
                        <p class="text-gray-500">{{$formA->dpd_comment}}</p>
                    </article>
                    @if($formA->sg_approval != null)
                    @php
                    $sg = User::find($formA->sg_id);
                    @endphp
                    <article class="p-6 text-base bg-white rounded-lg">
                        <footer class="flex justify-start items-center mb-2">
                            <div class="flex items-center">
                                <p class="inline-flex items-center mr-3 text-sm text-gray-900  font-semibold">
                                    @if ($sg->profile)
                                    <img class="mr-2 w-6 h-6 rounded-full" src="{{ asset('uploads/'.$sg->profile) }}" alt="Michael Gough">
                                    @endif
                                    <span class="capitalize">{{"Mr/Ms ".$sg->name}} - (SG)</span>
                                </p>
                                <p class="text-sm text-gray-600 ">{{date("F d, Y", strtotime($formA->sg_approval_date))}}
                                    @if ($formA->sg_approval == "approve")
                                    <span class="bg-green-200 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded mx-3">Approved</span>
                                    @elseif($formA->sg_approval == "disapprove")
                                    <span class="bg-red-200 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded mx-3">Disapproved</span>
                                    @endif
                                </p>
                            </div>
                        </footer>
                        <p class="text-gray-500">{{$formA->sg_comment}}</p>
                    </article>

                    @endif
                </div>
            </div>
            @endif

        </div>


        <script>
            $(document).ready(function() {
                if ($('#question_type').val() == 4 || $('#question_type').val() == 5) {
                    $("#options").removeClass("hidden");
                } else {
                    $("#options").addClass("hidden");
                }
            });
            var count = 0;
            $("#question_type").change(function(e) {
                if (e.target.value == 4 || e.target.value == 5) {
                    $("#options").removeClass("hidden");
                } else {
                    $("#options").addClass("hidden");
                }
            });

            $("#option_btn").click(function(e) {
                e.preventDefault();
                count++;
                $("#options").append('<div class="mb-5"><input type="text"  name="options[]"  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="enter option ' + count + '"></div>');
            });
        </script>
    </div>
</x-app-layout>