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
                                        <img class="w-8 h-8 rounded-full" src="https://static.thenounproject.com/png/674079-200.png" alt="Neil image">
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
                                            <img class="w-8 h-8 rounded-full" src="data:image/png;base64,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" alt="Neil image">
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
                                                <img class="w-8 h-8 rounded-full" src="https://www.shutterstock.com/image-vector/committee-icon-vector-logotype-600nw-2142316783.jpg" alt="Neil image">
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
                                                    <img class="w-8 h-8 rounded-full" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAclBMVEX///8AAAATExPz8/Pv7+8ZGRkWFhbs7OxHR0fMzMyYmJgwMDD09PTl5eXW1tasrKwMDAw4ODiHh4e7u7tiYmKSkpJcXFyzs7NxcXEgICArKytJSUnCwsIlJSWvr6+fn59UVFRBQUHd3d2BgYFsbGx4eHhq/dykAAADnUlEQVR4nO3caXeiMACFYeNStYJr3dex9f//xZmeKQGrWYiQ5HLu85kjeasCCdRWi4iIiIiIiIiIiIiIKFLjj9lotp+EHkZ9luK/QeiB1GUsMvPQQ6nJShaK0EOpSS8v7IQeSz3aLITHQnwsxMdCfCzEx0J8LMTHQnwsxMdCfCzEx0J8LMTHQnwsxMdCfCzEx0J8LMTHQnwsxMdCfCzEx0J8LMRnWXg9nE7rYdfbsCpkUdg/X+Q2m0XidXgVMBamG3Gnd/Y8wleZCufiwXbte5Av0Rem28fA78+q/3G60xYOn/b98wfouKsrVAYKMcI54GgK06m6UKyKW/aHtbn26ytMdppAIT7zLZ8cjao0+ly/kqkuNI17nG04NmxYhdXa+WuhLOyYdrrPtjzXmSZt36su/DLu8/Cz5XuNXXcWlRam5h1mb6K3QrFyOUmpCm0+eqnvQtEbVle4Uu9GmngvdPmkKgq7bfVOpE2AQlH6n84VhRZfQ/lF9FtY+l1UFGou2HJvSYjC/ET8UuHCal+dIIXHcid/ReHaal9hCsWXv/cwzKc0v9Z4pdDqWnMXqnBaQWHfZkc/Myj/heL0emFrZrGfebDCUQWFG/XLS8NghaLE1Zuq8GDeSy8JV1hiLUw5e3q+ylaUzfJDFE7tZxnKwolxL9nSQojCEhc26lUM07W3/MWeIIX2M351oembKK+dghTaX9doVhP1S1H50SxIof35QrcirJsFF6ZpQQrtf/NJV5ioT/vFn80CLmy1PhQvfzfRDlNoPYUy3F1bPnvxX+tBdvOQqtkGGu8fXh/fxuWvP1/Se9ikfvYXNea73OP7A8788WZ+fz7w7FJiPcrmSYXO4rbfHY/b2WXpsF4ZmvXTJkmCc8vwDp+nwcdCfCzEx0J8hULQM7pJoTDt9mF0uy6zJyxv+9vC6ole2MJv05tFI3ShsLnnjV4ojI8swxca30X8wqnhqIpfKJaNLzQsuzWhUH8fqgmF+oW3QuFg73tR0N3oWCjUr50WCvUf57gkSeEO7kW7Kezs6ZoPfKfdELaw8Bx6W7shC6PFQomF0WKhxMJosVBiYbRYKLEwWiyUWBgtl0KsO6SJQ2HaQZI6FPawOBTCYiE+FuJjIT4W4rMufMPiUJh2kbhclzZ/btH8+SEL48JCiYXRYqHEwmixUGJhtFgosTBaLJSaXzhtQKH+RwZno0wbrLAtRz4LPRYiIiIiIiIiIiIiIqLn/gLNIld6KIU+QAAAAABJRU5ErkJggg==" alt="Neil image">
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
                                                        <div class="col-span-1">
                                                            <p class="text-sm font-medium text-gray-900 truncate ">
                                                                {{$ward->ward_title}}
                                                            </p>
                                                            <p class="text-sm text-gray-500 truncate ">
                                                                Ward
                                                            </p>
                                                        </div>
                                                        <div class="col-span-3">
                                                            <i id="{{$ward->id}}" onclick="showWardEdit()" class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center me-2 fa-regular fa-pen-to-square"></i>
                                                            <form class="inline-flex" action="{{ route('ward.destroy' , $ward->id ) }}" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="text-red-700 border border-red-700 hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center me-2">
                                                                    <i class="fa-regular fa-trash-can"></i>
                                                                </button>
                                                            </form>
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