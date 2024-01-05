@php
use App\Models\User;
use App\Models\Affiliation;
use App\Models\Constituency;
use App\Models\UnionCouncil;
use App\Models\Ward;
$cities = User::select('city')->distinct()->get();
$total_users = User::count();
$destricts = Affiliation::count();
$constituencys = Constituency::count();
$unionCouncils = UnionCouncil::count();
$wards = Ward::count();
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stats') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-lg font-medium text-gray-900 p-4">
                        {{ __('Members Statistics') }} <span class="bg-green-100 text-green-800 ml-2 text-sm font-medium me-2 px-2.5 py-0.5 rounded">{{$total_users}} registered members</span>
                    </h2>
                    <h2 class="text-lg font-medium text-gray-900 p-4">
                        {{ __('Total Destricts') }} <span class="bg-green-100 text-green-800 ml-2 text-sm font-medium me-2 px-2.5 py-0.5 rounded">{{$destricts}} added Destricts</span>
                    </h2>
                    <h2 class="text-lg font-medium text-gray-900 p-4">
                        {{ __('Constituencies') }} <span class="bg-green-100 text-green-800 ml-2 text-sm font-medium me-2 px-2.5 py-0.5 rounded">{{$constituencys}} added Constituencies</span>
                    </h2>
                    <h2 class="text-lg font-medium text-gray-900 p-4">
                        {{ __('Union Councils') }} <span class="bg-green-100 text-green-800 ml-2 text-sm font-medium me-2 px-2.5 py-0.5 rounded">{{$unionCouncils}} added unionCouncils</span>
                    </h2>
                    <h2 class="text-lg font-medium text-gray-900 p-4">
                        {{ __('Wards') }} <span class="bg-green-100 text-green-800 ml-2 text-sm font-medium me-2 px-2.5 py-0.5 rounded">{{$wards}} added Wards</span>
                    </h2>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>