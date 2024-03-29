<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form B') }}
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
                <div class="grid grid-cols-1 md:grid-cols-4">
                    <div class="md:col-span-4">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">
                            Submit Answers to Form B
                        </h2>
                        <hr>
                        <form method="post" action="{{route('form.b.submit', $user->id)}}" class="mt-6 space-y-6">
                            @csrf
                            @php
                            $ids = array();
                            @endphp
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                @foreach ($questions as $question)
                                <?php array_push($ids, $question->id); ?>
                                @if ($question->question_type == 1)
                                <div class="md:col-span-2">
                                    <div class="mb-2">
                                        <label for="{{$question->id}}" class="block mb-2 text-lg font-medium text-gray-900 ">{{$question->question_title}}</label>
                                        <input type="text" id="{{$question->id}}" name="answer[]" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Enter your brief answer">
                                        <x-input-error class="mt-2" :messages="$errors->get('{{$question->id}}')" />
                                    </div>
                                </div>
                                @endif
                                @if ($question->question_type == 2)
                                <div class="md:col-span-2">
                                    <div class="mb-2">
                                        <label for="{{$question->id}}" class="block mb-2 text-lg font-medium text-gray-900 ">{{$question->question_title}}</label>
                                        <select id="{{$question->id}}" name="answer[]" class="mr-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                            <option value="1">Yes</option>
                                            <option value="2">No</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('form_type')" />
                                    </div>
                                </div>
                                @endif
                                @if ($question->question_type == 3)
                                <div class="md:col-span-2">
                                    <div class="mb-2">
                                        <label for="{{$question->id}}" class="block mb-2 text-lg font-medium text-gray-900 ">{{$question->question_title}}</label>
                                        <input type="datetime-local" id="{{$question->id}}" name="answer[]" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Enter your brief answer">
                                        <x-input-error class="mt-2" :messages="$errors->get('{{$question->id}}')" />
                                    </div>
                                </div>
                                @endif

                                @if ($question->question_type == 4)
                                <div class="md:col-span-2">
                                    <div class="mb-2">
                                        <label for="{{$question->id}}" class="block mb-2 text-lg font-medium text-gray-900 ">{{$question->question_title}}</label>
                                        <select id="{{$question->id}}" name="answer[]" class="mr-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                            @php
                                            $options = json_decode($question->options);
                                            print_r($options);
                                            @endphp
                                            @if (is_array($options) || is_object($options))
                                            @foreach ($options as $option )
                                            <option value="{{$option}}">{{$option}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('form_type')" />
                                    </div>
                                </div>
                                @endif

                                @if ($question->question_type == 5)
                                <div class="md:col-span-2">
                                    <div class="mb-2">
                                        <label for="{{$question->id}}" class="block mb-2 text-lg font-medium text-gray-900 ">{{$question->question_title}}</label>
                                        @foreach (json_decode($question->options) as $option )
                                        <div class="flex items-center mb-3">
                                            <input checked id="checkbox" type="checkbox" name="answer[{{$question->question_order-1}}][]" value="{{$option}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                            <label for="checked-checkbox" class="ms-2 text-sm font-medium text-gray-900">{{$option}}</label>
                                        </div>
                                        @endforeach
                                        <x-input-error class="mt-2" :messages="$errors->get('form_type')" />
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                            <input type="hidden" name="ids" value="{{json_encode($ids)}}">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>