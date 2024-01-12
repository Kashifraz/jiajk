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
                <div class="grid grid-cols-1 md:grid-cols-5">
                    <div class="md:col-span-3">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">
                            Form B
                        </h2>
                        <form method="post" action="{{ isset($form) ? route('form.update', $form->id) :route('form.store') }}" class="mt-6 space-y-6">
                            @csrf
                            @foreach ($questions as $question)
                            @if ($question->question_type == 1)
                            <div class="mb-5">
                                <label for="question_{{$question->id}}" class="block mb-2 text-sm font-medium text-gray-900 ">{{$question->question_title}}</label>
                                <input type="text" id="question_{{$question->id}}" name="question_{{$question->id}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Enter your brief answer">
                                <x-input-error class="mt-2" :messages="$errors->get('question_{{$question->id}}')" />
                            </div>
                            @endif
                            @if ($question->question_type == 2)
                            <div class="mb-5">
                                <label for="form_type" class="block mb-2 text-sm font-medium text-gray-900 ">{{$question->question_title}}</label>
                                <select id="form_type" name="form_type" class="mr-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('form_type')" />
                            </div>
                            @endif
                            @endforeach
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>