@php
use App\Models\User;
$total_users = User::count();
$total_constituency = $affiliation->constituency->count();
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Showing Destrict'." ".$affiliation->affiliation_title) }}
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

        <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Statistics') }} <span class="bg-green-100 text-green-800 ml-2 text-sm font-medium me-2 px-2.5 py-0.5 rounded">{{$total_constituency}} total constituencies</span>  
                    </h2>
                    <div class="grid grid-cols-1 gap-4 px-4 mt-8 lg:grid-cols-4 sm:px-8">
                        @foreach ($affiliation->constituency as $constituency)
                        @php
                        $gradient_no = rand(1,5);
                        $user_count = User::where("constituency","=",$constituency->id)->count();
                        @endphp
                        <div class="<?php
                         if($gradient_no == 1)
                         echo 'bg-gradient-to-r from-emerald-100 to-cyan-50';
                         else if($gradient_no == 2)
                         echo 'bg-gradient-to-r from-orange-100 via-rose-100 to-red-50';
                         else if($gradient_no == 3)
                         echo 'bg-gradient-to-r from-cyan-100 from-5% via-blue-100 via-40% to-indigo-50 to-90%';
                         else if($gradient_no == 4)
                         echo 'bg-gradient-to-r from-fuchsia-100 to-pink-50';
                         else if($gradient_no == 5)
                         echo 'bg-gradient-to-r from-lime-100 via-emerald-100 to-green-50
                         ';
                        ?> p-5 flex items-center  justify-center bg-white rounded-lg overflow-hidden shadow-md">
                            <div class="p-3 text-gray-700 text-center">
                                <h3 class="text-md tracking-wider hover:underline"><a href="{{route('constituency.show', $constituency->id)}}"> {{$constituency->constituency_title}}</a> </h3>
                                <p class="text-2xl">{{$user_count == 1? $user_count." member" :$user_count." members"  }} </p>
                            </div>
                        </div>
                        @endforeach
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>