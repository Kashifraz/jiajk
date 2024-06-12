@php
use App\Models\User;
$total_users = User::count();
$total_wards = $UnionCouncil->ward->count();
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Showing UnionCouncil')." ".$UnionCouncil->union_council_title }}
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
                            {{ __('Statistics') }} <span class="bg-green-100 text-green-800 ml-2 text-sm font-medium me-2 px-2.5 py-0.5 rounded">{{$total_wards}} total Wards</span>
                            <div class="inline-flex text-sm" style="float:right">
                                <span class="text-orange-600 mx-2"><i class="fa-solid fa-user text-lg inline-flex"></i> = Member</span>
                                <span class="text-teal-600 mx-2"><i class="fa-solid fa-id-card text-lg inline-flex"></i> = Applicant</span>
                                <span class="text-blue-600 mx-2"><i class="fa-solid fa-user-graduate text-lg inline-flex"></i> = GC</span>
                            </div>
                        </h2>
                        <div class="grid grid-cols-1 gap-4 px-4 mt-8 lg:grid-cols-4 sm:px-8">
                            @foreach ($UnionCouncil->ward as $ward)
                            @php
                            $gradient_no = rand(1,5);
                            $user_count = User::where("ward","=",$ward->id)->count();
                            $member_count = User::where("ward","=",$ward->id)
                            ->where("member_level","member")->count();
                            $applicant_count = User::where("ward","=",$ward->id)
                            ->where("member_level","applicant")->count();
                            $gc_count = User::where("ward","=",$ward->id)
                            ->where("member_level","gc")->count();
                            @endphp
                            <div class="
                        <?php
                        if ($gradient_no == 1) {
                            echo 'bg-gradient-to-r from-emerald-50 to-cyan-50';
                        } else if ($gradient_no == 2) {
                            echo 'bg-gradient-to-r from-orange-50 via-rose-100 to-yellow-50';
                        } else if ($gradient_no == 3) {
                            echo 'bg-gradient-to-r from-cyan-50 from-5% via-blue-100 via-40% to-indigo-50 to-90%';
                        } else if ($gradient_no == 4) {
                            echo 'bg-gradient-to-r from-fuchsia-50 to-pink-50';
                        } else if ($gradient_no == 5) {
                            echo 'bg-gradient-to-r from-lime-50 via-emerald-50 to-green-50
                        ';
                        }

                        ?> flex items-center  justify-center bg-white rounded-lg overflow-hidden shadow-md">
                                <div class="p-2 text-gray-700 text-center">
                                    <h3 class="text-md font-bold tracking-wider hover:underline mb-1"><a href="#"> {{$ward->ward_title}}</a> </h3>
                                    <div class="bg-white  rounded-lg text-gray-700">
                                        <p class=" p-2 "> <b>Total Profiles: </b> {{$user_count }} </p>
                                    </div>

                                    <div class="grid grid-cols-3 gap-3 mt-2">
                                        <div class=" bg-white rounded-lg flex flex-col items-center justify-center h-[40px] w-[65px]">
                                            <p class="text-orange-600  text-sm font-medium">
                                                <i class="fa-solid fa-user text-lg"></i>
                                                <span class=" rounded-full  text-sm font-medium inline-flex items-center justify-center ">{{$member_count}}</span>
                                            </p>

                                        </div>
                                        <div class="bg-white  rounded-lg inline-flex flex-col items-center justify-center h-[40px] w-[65px]">
                                            <p class="text-teal-600  text-sm font-medium">
                                                <i class="fa-solid fa-id-card text-lg"></i>
                                                <span class=" rounded-full text-teal-600 text-sm font-medium inline-flex items-center justify-center mb-1">{{$applicant_count}}</span>
                                            </p>
                                        </div>
                                        <div class="bg-white  rounded-lg flex flex-col items-center justify-center h-[40px] w-[65px]">
                                            <p class="text-blue-600 text-sm font-medium">
                                                <i class="fa-solid fa-user-graduate text-lg"></i>
                                                <span class=" rounded-full  text-blue-600 text-sm font-medium inline-flex items-center justify-center mb-1">{{$gc_count}} <span>
                                            </p>
                                        </div>
                                    </div>


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