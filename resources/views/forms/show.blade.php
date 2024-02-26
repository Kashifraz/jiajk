<?php

use App\Models\Question;
use App\Models\User;

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
            @if($formA->sg_approval == null || $formA->president_approval == null )
            <div class="p-4 mt-4 sm:p-8 bg-white shadow sm:rounded-lg">
                @if (($formA->sg_approval != null && Auth::user()->can('final approval forma')) ||($formA->sg_approval == null && Auth::user()->can('initial approval forma')))
                <h2 class="text-lg font-medium text-gray-900 mb-4">
                    Submit your aprroval
                </h2>
                <form method="post" action="{{ Auth::user()->can('initial approval forma') ? route('form.approval.sg', $formA->id):route('form.approval.president', $formA->id) }}" class="mt-6 space-y-6">
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
                @elseif($formA->sg_approval == null)
                <h2 class="text-lg font-medium text-blue-600 text-center my-4">
                    Note: Awaiting secretery general's approval.
                </h2>
                @endif

            </div>
            @endif

            @if($formA->sg_approval != null)
            <div class="p-4 mt-4 sm:p-8 bg-white shadow sm:rounded-lg  antialiased">
                <div class="max-w-full mx-auto px-4">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">
                        Comments by Approvers
                    </h2>

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
                                    <span class="capitalize">{{"Mr/Ms ".$sg->name}}</span>
                                </p>
                                <p class="text-sm text-gray-600 ">{{date("F d, Y", strtotime($formA->sg_approval_date))}}</p>
                            </div>
                        </footer>
                        <p class="text-gray-500">{{$formA->sg_comment}}</p>
                    </article>
                    @if($formA->president_approval != null)
                    @php
                    $president = User::find($formA->president_id);
                    @endphp
                    <article class="p-6 text-base bg-white rounded-lg">
                        <footer class="flex justify-start items-center mb-2">
                            <div class="flex items-center">
                                <p class="inline-flex items-center mr-3 text-sm text-gray-900  font-semibold">
                                    @if ($president->profile)
                                    <img class="mr-2 w-6 h-6 rounded-full" src="{{ asset('uploads/'.$president->profile) }}" alt="Michael Gough">
                                    @endif
                                    <span class="capitalize">{{"Mr/Ms ".$president->name}}</span>
                                </p>
                                <p class="text-sm text-gray-600 ">{{date("F d, Y", strtotime($formA->president_approval_date))}}</p>
                            </div>
                        </footer>
                        <p class="text-gray-500">{{$formA->president_comment}}</p>
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