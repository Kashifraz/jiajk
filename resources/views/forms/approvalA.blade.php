<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pending FormA Approvals') }}
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
                    <table class="w-full  text-sm text-left rtl:text-right text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Father Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Submitted On
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($users) == 0)
                            <tr>
                                <td class="p-4">
                                    <p>No form questions found!</p>
                                </td>
                            </tr>
                            @else
                            @foreach ($users as $user )
                            <tr class="bg-white border-b hover:bg-gray-50">

                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{$user->name}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{$user->father_name}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{$user->created_at}}
                                </th>
                                <td class="px-6 py-4">
                                    <a href="{{route('form.a.show',$user->forma->id )}}"><i class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center me-2 fa-regular fa-eye"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mb-3 p-5">
                
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