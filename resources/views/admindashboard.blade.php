@php
use App\Models\User;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Members Statistics') }}
                    </h2>
                    <div class="grid grid-cols-1 gap-4 px-4 mt-8 lg:grid-cols-4 sm:px-8">
                        @foreach ($affiliations as $affiliation)
                        @php
                        $user_count = User::where("affiliations","=",$affiliation->id)->count();
                        @endphp
                        <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                            <div class="p-4 bg-blue-400 h-20 w-20 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mt-2 ml-2 text-white" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                    <path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                                </svg>
                            </div>
                            <div class="px-4 text-gray-700">
                                <h3 class="text-md tracking-wider">{{$affiliation->affiliation_title}}</h3>
                                <p class="text-2xl">{{$user_count == 1? $user_count." member" :$user_count." members"  }}</p>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>