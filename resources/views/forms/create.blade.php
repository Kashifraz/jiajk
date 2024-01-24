<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Questions') }}
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
                            Add Form Questions
                        </h2>
                        <form method="post" action="{{ isset($form) ? route('form.update', $form->id) :route('form.store') }}" class="mt-6 space-y-6">
                            @csrf
                            <div class="mb-5">
                                <label for="question_title" class="block mb-2 text-sm font-medium text-gray-900 ">Question Title</label>
                                <input type="text" id="question_title" name="question_title" value="{{isset($form) && $form->question_title ? $form->question_title:''}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Question Title">
                                <x-input-error class="mt-2" :messages="$errors->get('question_title')" />
                            </div>
                            <div class="mb-5">
                                <label for="form_type" class="block mb-2 text-sm font-medium text-gray-900 ">Form Type</label>
                                <select id="form_type" name="form_type" class="mr-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option value="1" {{isset($form) && $form->form_type == 1 ? "selected": "" }}>Form A</option>
                                    <option value="2" {{isset($form) && $form->form_type == 2 ? "selected": "" }}>Form B</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('form_type')" />
                            </div>
                            <div class="mb-5">
                                <label for="question_order" class="block mb-2 text-sm font-medium text-gray-900 ">Question Order</label>
                                <input type="number" id="question_order" name="question_order" value="{{isset($form) && $form->question_order ? $form->question_order:''}}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Question order">
                                <x-input-error class="mt-2" :messages="$errors->get('question_order')" />
                            </div>
                            <div class="mb-5">
                                <label for="question_type" class="block mb-2 text-sm font-medium text-gray-900 ">Question Type</label>
                                <select id="question_type" name="question_type" class="mr-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option value="1" {{isset($form) != null && $form->question_type == 1 ? "selected": "" }}>Text</option>
                                    <option value="2" {{isset($form) != null && $form->question_type == 2 ? "selected": "" }}>Select</option>
                                    <option value="3" {{isset($form) != null && $form->question_type == 3 ? "selected": "" }}>Date</option>
                                    <option value="4" {{isset($form) != null && $form->question_type == 4 ? "selected": "" }}>options</option>
                                    <option value="5 " {{isset($form) != null && $form->question_type == 5 ? "selected": "" }}>List</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('question_type')" />
                            </div>
                            <div class="mb-5 hidden" id="options">
                                <button id="option_btn" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline mb-4">Add option</button>
                            </div>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5  gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class=" p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <div class="md:col-span-3">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">
                        All Added Questions
                        <a href="{{route('form.show.a', Auth::user()->id)}}" class="ml-3 px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Form A
                        </a>
                        <a href="{{route('form.show.b', Auth::user()->id)}}" class="ml-3 px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Form B
                        </a>
                    </h2>
                    <table class="w-full  text-sm text-left rtl:text-right text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Question Title
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Form Type
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Question Type
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Order
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($formQuestions) == 0)
                            <tr>
                                <td class="p-4">
                                    <p>No form questions found!</p>
                                </td>
                            </tr>
                            @else
                            @foreach ($formQuestions as $question )
                            <tr class="bg-white border-b hover:bg-gray-50">

                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{$question->question_title}}
                                </th>
                                <td class="px-6 py-4">
                                    @php
                                    if($question->form_type == 1){
                                    echo "Form A";
                                    }else if($question->form_type == 2){
                                    echo "Form B";
                                    }
                                    @endphp
                                </td>
                                <td class="px-6 py-4 ">
                                    @php
                                    if($question->question_type == 1){
                                    echo "Text Input";
                                    }else if($question->question_type == 2){
                                    echo "Select Input";
                                    }
                                    else if($question->question_type == 3){
                                    echo "Date Input";
                                    }
                                    else if($question->question_type == 4){
                                    echo "Option Input";
                                    }
                                    else if($question->question_type == 5){
                                    echo "List Input";
                                    }
                                    @endphp
                                </td>
                                <td class="px-6 py-4 ">
                                    {{$question->question_order}}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{route('form.edit',$question->id )}}"><i class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center me-2 fa-regular fa-pen-to-square"></i></a>
                                    <form class="inline-flex" action="{{route('form.delete',$question->id )}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="text-red-700 border border-red-700 hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center me-2">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mb-3 p-5">
                {!! $formQuestions->links() !!}
            </div>
        </div>
        </form>

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