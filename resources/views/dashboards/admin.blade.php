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
                    <div class="grid grid-cols-1 gap-4 px-4  mt-8 lg:grid-cols-4 sm:px-8">
                        @foreach ($affiliations as $affiliation)
                        @php
                        $gradient_no = rand(1,5);
                        $user_count = User::where("affiliations","=",$affiliation->id)->count();
                        @endphp
                        <div class="
                        <?php
                        if($gradient_no == 1)
                        echo 'bg-gradient-to-r from-emerald-400 to-cyan-400';
                        else if($gradient_no == 2)
                        echo 'bg-gradient-to-l from-orange-500 via-rose-600 to-red-500';
                        else if($gradient_no == 3)
                        echo 'bg-gradient-to-r from-cyan-500 from-5% via-blue-500 via-40% to-indigo-500 to-90%';
                        else if($gradient_no == 4)
                        echo 'bg-gradient-to-r from-fuchsia-500 to-pink-500';
                        else if($gradient_no == 5)
                        echo 'bg-gradient-to-bl from-lime-400 via-emerald-500 to-green-600
                        ';

                        ?> p-5 flex items-center  justify-center bg-white rounded-lg overflow-hidden shadow-md">
                           
                            <div class="p-3 text-gray-50 text-center">
                                <h3 class="text-md tracking-wider hover:underline"><a href="{{route('affiliation.show', $affiliation->id)}}"> {{$affiliation->affiliation_title}}</a> <button data-popover-target="popover-{{$affiliation->id}}" data-popover-placement="bottom" type="button"><span class="sr-only">Show information</span><i class="fa-solid fa-circle-question"></i></button></h3>
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