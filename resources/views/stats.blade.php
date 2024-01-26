@php
use App\Models\User;
use App\Models\Affiliation;
use App\Models\Constituency;
use App\Models\UnionCouncil;
use App\Models\Ward;
use App\Models\Designation;

$cities = User::select('city')->distinct()->get();
$total_users = User::count();
$total_members = User::where('member_level', 'member')->count();
$total_applicants = User::where('member_level', 'applicant')->count();
$total_gcs = User::where('member_level', 'gc')->count();
$total_designated_Districts = User::where('designation_level',2)->whereNotNull('designation')->count();
$total_designated_constituencies = User::where('designation_level',3)->whereNotNull('designation')->count();
$total_designated_unions = User::where('designation_level',4)->whereNotNull('designation')->count();
$total_designated_wards = User::where('designation_level',5)->whereNotNull('designation')->count();
$Districts = Affiliation::count();
$destrict_stats =json_encode(array($Districts,$total_designated_Districts));
$constituencys = Constituency::count();
$constituency_stats =json_encode(array($constituencys,$total_designated_constituencies));
$unionCouncils = UnionCouncil::count();
$unioncouncil_stats =json_encode(array($unionCouncils,$total_designated_unions));
$wards = Ward::count();
$ward_stats =json_encode(array($wards,$total_designated_wards));
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stats') }}
        </h2>
        <!-- Other head elements -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-lg font-medium text-gray-900 p-4">
                        {{ __('Members Statistics') }} <span class="bg-green-100 text-green-800 ml-2 text-sm font-medium me-2 px-2.5 py-0.5 rounded">{{$total_users}} registered members</span>
                    </h2>
                    <hr>
                    <div class="grid sm:grid-cols-3 grid-cols-1 text-center">
                        <div class="my-5">
                            <h2 class="text-lg font-medium text-gray-900">
                                <i class="fa-solid fa-user text-xl"></i> {{ __('Total Members') }}
                            </h2>
                            <span class="bg-green-100 text-green-800 ml-2 text-sm font-medium me-2 px-2.5 py-0.5 rounded">{{$total_members}} registered members</span>
                        </div>
                        <div class="my-5">
                            <h2 class="text-lg font-medium text-gray-900">
                                <i class="fa-solid fa-user-tie text-xl"></i> {{ __('Total Applicants') }}
                            </h2>
                            <span class="bg-green-100 text-green-800 ml-2 text-sm font-medium me-2 px-2.5 py-0.5 rounded">{{$total_applicants}} registered applicants</span>
                        </div>
                        <div class="my-5">
                            <h2 class="text-lg font-medium text-gray-900">
                                <i class="fa-solid fa-user-graduate text-xl"></i> {{ __('Total GCs') }}
                            </h2>
                            <span class="bg-green-100 text-green-800 ml-2 text-sm font-medium me-2 px-2.5 py-0.5 rounded">{{$total_gcs}} registered GCs</span>
                        </div>
                    </div>
                    <hr>
                    <div class=" flex justify-center grid sm:grid-cols-3 grid-cols-1 my-8">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900 p-4">
                                {{ __('Total Districts') }} <span class="bg-green-100 text-green-800 ml-2 text-sm font-medium me-2 px-2.5 py-0.5 rounded">{{$Districts}} added Districts</span>
                            </h2>
                            <div class="p-6 bg-white shadow rounded-lg mb-5" style="width:90%;">
                                <canvas id="Districts"></canvas>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-lg font-medium text-gray-900 p-4">
                                {{ __('Constituencies') }} <span class="bg-green-100 text-green-800 ml-2 text-sm font-medium me-2 px-2.5 py-0.5 rounded">{{$constituencys}} added Constituencies</span>
                            </h2>
                            <div class="p-6 bg-white shadow rounded-lg mb-5" style="width:90%;">
                                <canvas id="constituencies"></canvas>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-lg font-medium text-gray-900 p-4">
                                {{ __('Union Councils') }} <span class="bg-green-100 text-green-800 ml-2 text-sm font-medium me-2 px-2.5 py-0.5 rounded">{{$unionCouncils}} added unionCouncils</span>
                            </h2>
                            <div class="p-6 bg-white shadow rounded-lg mb-5" style="width:90%;">
                                <canvas id="unioncouncils"></canvas>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-lg font-medium text-gray-900 p-4">
                                {{ __('Wards') }} <span class="bg-green-100 text-green-800 ml-2 text-sm font-medium me-2 px-2.5 py-0.5 rounded">{{$wards}} added Wards</span>
                            </h2>
                            <div class="p-6 bg-white shadow rounded-lg mb-5" style="width:90%;">
                                <canvas id="wards"></canvas>
                            </div>
                        </div>
                    </div>


                    <script>
                        const Districts = {
                            labels: [
                                'Districts',
                                'designations',
                            ],
                            datasets: [{
                                label: 'count',
                                data: <?php echo $destrict_stats ?>,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                ],
                                hoverOffset: 4
                            }]
                        };
                        const constituencies = {
                            labels: [
                                'constituencies',
                                'designations',
                            ],
                            datasets: [{
                                label: 'count',
                                data: <?php echo $constituency_stats ?>,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                ],
                                hoverOffset: 4
                            }]
                        };
                        const unioncouncils = {
                            labels: [
                                'unioncouncils',
                                'designations',
                            ],
                            datasets: [{
                                label: 'count',
                                data: <?php echo $unioncouncil_stats ?>,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                ],
                                hoverOffset: 4
                            }]
                        };
                        const wards = {
                            labels: [
                                'wards',
                                'designations',
                            ],
                            datasets: [{
                                label: 'count',
                                data: <?php echo $ward_stats ?>,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                ],
                                hoverOffset: 4
                            }]
                        };

                        window.onload = function() {
                            var ctx = document.getElementById("Districts").getContext("2d");
                            window.doughnut1 = new Chart(ctx, {
                                type: 'doughnut',
                                data: Districts,
                                options: {

                                    responsive: true,
                                }
                            });
                            var ctx2 = document.getElementById("constituencies").getContext("2d");
                            window.doughnut1 = new Chart(ctx2, {
                                type: 'doughnut',
                                data: constituencies,
                                options: {

                                    responsive: true,
                                }
                            });
                            var ctx3 = document.getElementById("unioncouncils").getContext("2d");
                            window.doughnut1 = new Chart(ctx3, {
                                type: 'doughnut',
                                data: unioncouncils,
                                options: {
                                    responsive: true,
                                }
                            });
                            var ctx4 = document.getElementById("wards").getContext("2d");
                            window.doughnut1 = new Chart(ctx4, {
                                type: 'doughnut',
                                data: wards,
                                options: {
                                    responsive: true,
                                }
                            });
                        };
                    </script>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>