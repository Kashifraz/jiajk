@php
use App\Models\User;
$cities = User::select('city')->distinct()->get();
$total_users = User::count();
$first_day_this_month = date('m-01-Y');
$last_day_this_month = date('m-t-Y');
$data = json_encode($entries);
@endphp
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            {{ __('Members Statistics:') }}
            <span class="bg-green-100 text-green-800 ml-2 text-sm font-medium me-2 px-2.5 py-0.5 rounded">{{$total_users}} registered members</span>
            <div class="inline-flex text-sm" style="float:right">
              <span class="text-orange-600 mx-2"><i class="fa-solid fa-user text-lg inline-flex"></i> = Member</span>
              <span class="text-teal-600 mx-2"><i class="fa-solid fa-id-card text-lg inline-flex"></i> = Applicant</span>
              <span class="text-blue-600 mx-2"><i class="fa-solid fa-user-graduate text-lg inline-flex"></i> = GC</span>
            </div>
          </h2>

          <div class="grid grid-cols-1 gap-4 px-0 mt-8 lg:grid-cols-4 sm:px-8">
            @foreach ($affiliations as $affiliation)
            @php
            $gradient_no = rand(1,5);
            $user_count = User::where("affiliations","=",$affiliation->id)->count();
            $member_count = User::where("affiliations","=",$affiliation->id)
            ->where("member_level","member")->count();
            $applicant_count = User::where("affiliations","=",$affiliation->id)
            ->where("member_level","applicant")->count();
            $gc_count = User::where("affiliations","=",$affiliation->id)
            ->where("member_level","gc")->count();
            @endphp
            <div class="
                        <?php
                        if ($gradient_no == 1)
                          echo 'bg-gradient-to-r from-emerald-50 to-cyan-50';
                        else if ($gradient_no == 2)
                          echo 'bg-gradient-to-r from-orange-50 via-rose-100 to-yellow-50';
                        else if ($gradient_no == 3)
                          echo 'bg-gradient-to-r from-cyan-50 from-5% via-blue-100 via-40% to-indigo-50 to-90%';
                        else if ($gradient_no == 4)
                          echo 'bg-gradient-to-r from-fuchsia-50 to-pink-50';
                        else if ($gradient_no == 5)
                          echo 'bg-gradient-to-r from-lime-50 via-emerald-50 to-green-50
                        ';
                        ?> flex items-center  justify-center bg-white rounded-lg overflow-hidden shadow-md">

              <div class="p-2 text-gray-700 text-center">
                <h3 class="text-md font-bold tracking-wider hover:underline mb-1"><a href="{{route('affiliation.show', $affiliation->id)}}"> {{$affiliation->affiliation_title}}</a> <button data-popover-target="popover-{{$affiliation->id}}" data-popover-placement="bottom" type="button"><span class="sr-only">Show information</span><i class="fa-solid fa-circle-question"></i></button></h3>
                <div class="bg-white  rounded-lg text-gray-700">
                  <p class=" p-2 "> <b>Total Profiles: </b> {{$user_count }} 
                  <a href="<?php echo url('/show/members?destrict='.$affiliation->id.'') ?>"><i class="fa-solid fa-eye mx-2"></i></a> </p>
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