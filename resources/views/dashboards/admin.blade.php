@php
use App\Models\User;
$cities = User::select('city')->distinct()->get();
$total_users = User::count();
$first_day_this_month = date('m-01-Y');
$last_day_this_month = date('m-t-Y');
$data = json_encode($entries);
@endphp


<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
    let data = <?php echo $data ?>;
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: data,
        });
        calendar.render();
    });
</script>

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
                        {{ __('Members Statistics') }} <span class="bg-green-100 text-green-800 ml-2 text-sm font-medium me-2 px-2.5 py-0.5 rounded">{{$total_users}} registered members</span>
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
                                <h3 class="text-md tracking-wider">{{$affiliation->affiliation_title}} <button data-popover-target="popover-{{$affiliation->id}}" data-popover-placement="bottom" type="button"><span class="sr-only">Show information</span><i class="fa-solid fa-circle-question"></i></button></h3>
                                <p class="text-2xl">{{$user_count == 1? $user_count." member" :$user_count." members"  }} </p>
                                <div data-popover id="popover-{{$affiliation->id}}" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 ">
                                    <div class="p-3 space-y-2">
                                        <h3 class="font-semibold text-gray-900">Members Current location Stats</h3>
                                        <ul>
                                            @php
                                            $is_present = false;
                                            foreach ($cities as $city){
                                            $count = User::where("city","=",$city->city)->where("affiliations","=",$affiliation->id)->count();
                                            if ($count > 0 && $city->city != null){
                                            $is_present = true;
                                            @endphp
                                            <li><span class="font-bold">{{$count}}</span> Members live in <span class="capitalize">{{$city->city}}</span></li>
                                            @php
                                            }
                                            }
                                            @endphp


                                            @if ($is_present == false)
                                            <li>No data available</li>
                                            @endif ()

                                        </ul>

                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

                    </div>
                </div>
                <div class="p-6 text-gray-900">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Data Entry Calender') }}
                    </h2>
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>