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
            {{ __('Data Entry Calender') }}
          </h2>
          <div id='calendar'></div>
        </div>
    
    </div>
  </div>
</x-app-layout>