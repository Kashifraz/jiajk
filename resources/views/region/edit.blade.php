@php
use App\Models\Ward;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Region List') }}
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
                    <div class=" max-w-screen-xl mx-auto  bg-white min-h-sceen">
                        <ul class="p-5 px-12 divide-y divide-gray-200 ">
                            @if (count($affiliations) > 0)
                            @foreach ($affiliations as $affiliation )
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                    <div class="flex-shrink-0">
                                        <i class="fa-solid fa-building text-3xl rounded-full"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <form class="hidden" method="POST" action="{{route('affiliation.update',$affiliation->id)}}" id="{{'edit-a-'.$affiliation->id}}">
                                            @csrf
                                            <div class="flex">
                                                <div class="relative w-1/2">
                                                    <input type="text" id="affiliation_title" name="affiliation_title" value="{{$affiliation->affiliation_title}}" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg rounded-s-gray-100 rounded-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                                    <button type="submit" class="absolute top-0 end-0 p-2.5 h-full text-sm font-medium text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                                                        <i class="fa-solid fa-circle-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="grid grid-cols-8 details-a-{{$affiliation->id}}">
                                            <div class="col-span-1">
                                                <p class="text-sm font-medium text-gray-900 truncate ">
                                                    {{$affiliation->affiliation_title}}
                                                </p>
                                                <p class="text-sm text-gray-500 truncate ">
                                                    Destrict
                                                </p>
                                            </div>
                                            <div class="col-span-3">

                                                <i id="{{$affiliation->id}}" onclick="showDestrictEdit()" class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center me-2 fa-regular fa-pen-to-square"></i>

                                                <form class="inline-flex" action="{{ route('affiliation.destroy' , $affiliation->id ) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="text-red-700 border border-red-700 hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center me-2">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inline-flex items-left float-left text-base font-semibold text-gray-900 ">
                                        <i class="fa-solid fa-angle-up icon-a-{{$affiliation->id}}" id="{{$affiliation->id}}" onclick="toggleDestrict()"></i>
                                    </div>
                                </div>
                            </li>
                            <ul class="pl-12  divide-y divide-gray-200 hidden" id="{{'body-a-'.$affiliation->id}}">
                                @if (count($affiliation->constituency) > 0)
                                @foreach ($affiliation->constituency as $constituency )
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                        <div class="flex-shrink-0">
                                            <i class="fa-solid fa-magnifying-glass-location text-3xl rounded-full"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <form class="hidden" method="POST" id="{{'edit-c-'.$constituency->id}}" action="{{route('constituency.update',$constituency->id)}}" id="{{'edit-a-'.$constituency->id}}">
                                                @csrf
                                                <div class="flex">
                                                    <div class="relative w-1/2">
                                                        <input type="text" id="constituency_title" name="constituency_title" value="{{$constituency->constituency_title}}" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg rounded-s-gray-100 rounded-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                                        <button type="submit" class="absolute top-0 end-0 p-2.5 h-full text-sm font-medium text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                                                            <i class="fa-solid fa-circle-right"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="grid grid-cols-8 details-c-{{$constituency->id}}">
                                                <div class="col-span-1">
                                                    <p class="text-sm font-medium text-gray-900 truncate ">
                                                        {{$constituency->constituency_title}}
                                                    </p>
                                                    <p class="text-sm text-gray-500 truncate ">
                                                        Constituency
                                                    </p>
                                                </div>
                                                <div class="col-span-3">
                                                    <i id="{{$constituency->id}}" onclick="showConstituencyEdit()" class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center me-2 fa-regular fa-pen-to-square"></i>

                                                    <form class="inline-flex" action="{{ route('constituency.destroy' , $constituency->id ) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="text-red-700 border border-red-700 hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center me-2">
                                                            <i class="fa-regular fa-trash-can"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="inline-flex items-center text-base font-semibold text-gray-900 ">
                                            <i class="fa-solid fa-angle-up icon-c-{{$constituency->id}}" id="{{$constituency->id}}" onclick="toggleConstituency()"></i>
                                        </div>
                                    </div>
                                </li>
                                <ul class="pl-12  divide-y divide-gray-200 hidden" id="{{'body-c-'.$constituency->id}}">
                                    @if (count($constituency->unioncouncil) > 0)
                                    @foreach ($constituency->unioncouncil as $unioncouncil )
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                            <div class="flex-shrink-0">
                                                <i class="fa-solid fa-users-rectangle text-3xl rounded-full"></i>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <form class="hidden" method="POST" id="{{'edit-u-'.$unioncouncil->id}}" action="{{route('unioncouncil.update',$unioncouncil->id)}}" id="{{'edit-a-'.$affiliation->id}}">
                                                    @csrf
                                                    <div class="flex">
                                                        <div class="relative w-1/2">
                                                            <input type="text" id="union_council_title" name="union_council_title" value="{{$unioncouncil->union_council_title}}" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg rounded-s-gray-100 rounded-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                                            <button type="submit" class="absolute top-0 end-0 p-2.5 h-full text-sm font-medium text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                                                                <i class="fa-solid fa-circle-right"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="grid grid-cols-8 details-u-{{$unioncouncil->id}}">
                                                    <div class="col-span-1">
                                                        <p class="text-sm font-medium text-gray-900 truncate ">
                                                            {{$unioncouncil->union_council_title}}
                                                        </p>
                                                        <p class="text-sm text-gray-500 truncate ">
                                                            Union Council
                                                        </p>
                                                    </div>
                                                    <div class="col-span-3">
                                                        <i id="{{$unioncouncil->id}}" onclick="showUnionEdit()" class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center me-2 fa-regular fa-pen-to-square"></i>

                                                        <form class="inline-flex" action="{{ route('unioncouncil.destroy' , $unioncouncil->id ) }}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="text-red-700 border border-red-700 hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center me-2">
                                                                <i class="fa-regular fa-trash-can"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="inline-flex items-center text-base font-semibold text-gray-900 ">
                                                <i class="fa-solid fa-angle-up icon-u-{{$unioncouncil->id}}" id="{{$unioncouncil->id}}" onclick="toggleUnion()"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <ul class="pl-12  divide-y divide-gray-200 hidden" id="{{'body-u-'.$unioncouncil->id}}">
                                        @if (count($unioncouncil->ward) > 0)
                                        @foreach ($unioncouncil->ward as $ward )
                                        <li class="py-3 sm:py-4">
                                            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                                <div class="flex-shrink-0">
                                                    <i class="fa-solid fa-bed text-3xl rounded-full"></i>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <form class="hidden" method="POST" id="{{'edit-w-'.$ward->id}}" action="{{route('ward.update',$ward->id)}}">
                                                        @csrf
                                                        <div class="flex">
                                                            <div class="relative w-1/2">
                                                                <input type="text" id="ward_title" name="ward_title" value="{{$ward->ward_title}}" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg rounded-s-gray-100 rounded-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                                                <button type="submit" class="absolute top-0 end-0 p-2.5 h-full text-sm font-medium text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                                                                    <i class="fa-solid fa-circle-right"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="grid grid-cols-8 details-w-{{$ward->id}}">
                                                        <div class="col-span-2">
                                                            <p class="text-sm font-medium text-gray-900 truncate ">
                                                                {{$ward->ward_title}}
                                                            </p>
                                                            <p class="text-sm text-gray-500 truncate ">
                                                                Ward
                                                            </p>
                                                            <p class="text-sm text-gray-500 truncate ">
                                                                @php
                                                                $population = $ward->population;
                                                                $population = $population."";

                                                                echo Ward::nice_number($ward->population);
                                                                @endphp
                                                            </p>
                                                        </div>
                                                        <div class="col-span-6">
                                                            <div class="grid grid-cols-8">
                                                                <div class="col-span-1">
                                                                    <i id="{{$ward->id}}" onclick="showWardEdit()" class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center me-2 fa-regular fa-pen-to-square"></i>
                                                                    <form class="inline-flex" action="{{ route('ward.destroy' , $ward->id ) }}" method="POST">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit" class="text-red-700 border border-red-700 hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center me-2">
                                                                            <i class="fa-regular fa-trash-can"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                                <div class="col-span-7">
                                                                    @if ($ward->population == null)
                                                                    <form action="{{route('ward.population', $ward->id)}}" method="post">
                                                                        @csrf
                                                                        <div class="grid grid-cols-4">
                                                                            <div class="mb-5 col-span-2">
                                                                                <input type="text" id="population" name="population" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter Population" required>
                                                                            </div>
                                                                            <div class="col-span-2">
                                                                                <button type="submit" class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>

                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                        @else
                                        <p class="p-5">No wards added in the union council!</p>
                                        @endif

                                    </ul>
                                    @endforeach
                                    @else
                                    <p class="p-5">No union Councils added in the constituency!</p>
                                    @endif

                                </ul>
                                @endforeach
                                @else
                                <p class="p-5">No constituencies added in the destrict!</p>
                                @endif
                            </ul>
                            @endforeach
                            @else
                            <p>No Destricts Added!</p>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDestrict() {
            var id = this.event.target.id;
            var body_id = "#body-a-" + id;
            var icon_id = ".icon-a-" + id;

            if ($(body_id).hasClass("hidden")) {
                $(body_id).removeClass("hidden");
                $(icon_id).removeClass("fa-angle-up");
                $(icon_id).addClass("fa-angle-down");
            } else {
                $(body_id).addClass("hidden");
                $(icon_id).removeClass("fa-angle-down");
                $(icon_id).addClass("fa-angle-up");
            }
        }

        function toggleConstituency() {
            var id = this.event.target.id;
            var body_id = "#body-c-" + id;
            var icon_id = ".icon-c-" + id;
            if ($(body_id).hasClass("hidden")) {
                $(icon_id).removeClass("fa-angle-up");
                $(icon_id).addClass("fa-angle-down");
                $(body_id).removeClass("hidden");
            } else {
                $(body_id).addClass("hidden");
                $(icon_id).removeClass("fa-angle-down");
                $(icon_id).addClass("fa-angle-up");
            }
        }

        function toggleUnion() {
            var id = this.event.target.id;
            var body_id = "#body-u-" + id;
            var icon_id = ".icon-u-" + id;
            if ($(body_id).hasClass("hidden")) {
                $(body_id).removeClass("hidden");
                $(icon_id).removeClass("fa-angle-up");
                $(icon_id).addClass("fa-angle-down");
            } else {
                $(body_id).addClass("hidden");
                $(icon_id).removeClass("fa-angle-down");
                $(icon_id).addClass("fa-angle-up");
            }
        }

        function showDestrictEdit() {
            var id = this.event.target.id;
            var edit_id = "#edit-a-" + id;
            var details_id = ".details-a-" + id;
            if ($(edit_id).hasClass("hidden")) {
                $(edit_id).removeClass("hidden");
                $(details_id).addClass("hidden");
            } else {
                $(edit_id).addClass("hidden");
                $(details_id).removeClass("hidden");
            }
        }

        function showConstituencyEdit() {
            var id = this.event.target.id;
            var edit_id = "#edit-c-" + id;
            var details_id = ".details-c-" + id;
            if ($(edit_id).hasClass("hidden")) {
                $(edit_id).removeClass("hidden");
                $(details_id).addClass("hidden");
            } else {
                $(edit_id).addClass("hidden");
                $(details_id).removeClass("hidden");
            }
        }

        function showUnionEdit() {
            var id = this.event.target.id;
            var edit_id = "#edit-u-" + id;
            var details_id = ".details-u-" + id;
            if ($(edit_id).hasClass("hidden")) {
                $(edit_id).removeClass("hidden");
                $(details_id).addClass("hidden");
            } else {
                $(edit_id).addClass("hidden");
                $(details_id).removeClass("hidden");
            }
        }

        function showWardEdit() {
            var id = this.event.target.id;
            var edit_id = "#edit-w-" + id;
            var details_id = ".details-w-" + id;
            if ($(edit_id).hasClass("hidden")) {
                $(edit_id).removeClass("hidden");
                $(details_id).addClass("hidden");
            } else {
                $(edit_id).addClass("hidden");
                $(details_id).removeClass("hidden");
            }
        }
    </script>
</x-app-layout>