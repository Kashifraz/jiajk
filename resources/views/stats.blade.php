@php
use App\Models\User;
use App\Models\Affiliation;
use App\Models\Constituency;
use App\Models\UnionCouncil;
use App\Models\Ward;
use App\Models\Designation;

if(Auth::user()->type == 3){
$total_users = User::where('affiliations',Auth::user()->affiliations)->count();
$total_members = User::where('member_level', 'member')->where('affiliations',Auth::user()->affiliations)->count();
$total_applicants = User::where('member_level', 'applicant')->where('affiliations',Auth::user()->affiliations)->count();
$total_gcs = User::where('member_level', 'gc')->where('affiliations',Auth::user()->affiliations)->count();

$total_designated_constituencies = User::where('designation_level',3)->whereNotNull('designation')->where('affiliation_id',Auth::user()->affiliations)->count();
$total_designated_unions = User::where('designation_level',4)->whereNotNull('designation')->where('affiliations',Auth::user()->affiliations)->count();
$total_designated_wards = User::where('designation_level',5)->whereNotNull('designation')->where('affiliations',Auth::user()->affiliations)->count();
$constituencys = Constituency::count();
$constituency_stats =json_encode(array($constituencys,$total_designated_constituencies));
$unionCouncils = UnionCouncil::count();
$unioncouncil_stats =json_encode(array($unionCouncils,$total_designated_unions));
$wards = Ward::count();
$ward_stats =json_encode(array($wards,$total_designated_wards));
}else{
$cities = User::select('city')->distinct()->get();
$total_users = User::count();
$total_members = User::where('member_level', 'member')->count();
$total_applicants = User::where('member_level', 'applicant')->count();
$total_gcs = User::where('member_level', 'gc')->count();
$total_designated_Districts = User::where('designation_level',2)->whereNotNull('designation')->count();
$total_designated_constituencies = User::where('designation_level',3)->whereNotNull('designation')->count();
$total_designated_unions = User::where('designation_level',4)->whereNotNull('designation')->count();
$total_designated_wards = User::where('designation_level',5)->whereNotNull('designation')->count();
$Districts = Affiliation::get();
$destrict_stats =json_encode(array(count($Districts),$total_designated_Districts));
$constituencys = Constituency::count();
$constituency_stats =json_encode(array($constituencys,$total_designated_constituencies));
$unionCouncils = UnionCouncil::count();
$unioncouncil_stats =json_encode(array($unionCouncils,$total_designated_unions));
$wards = Ward::count();
$ward_stats =json_encode(array($wards,$total_designated_wards));
}

@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stats') }}
        </h2>
        <!-- Other head elements -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
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
                        <div class="px-4 text-gray-700 my-5">
                            <h2 class="text-lg font-medium text-gray-900">
                                <i class="fa-solid fa-user text-xl"></i> {{ __('Total Members') }}
                                <button data-popover-target="popover" data-popover-placement="bottom" type="button"><span class="sr-only">Show information</span><i class="fa-solid fa-circle-question"></i></button>
                            </h2>
                            <span class="bg-green-100 text-green-800 ml-2 text-sm font-medium me-2 px-2.5 py-0.5 rounded">{{$total_members}} registered members</span>
                            <div data-popover id="popover" role="tooltip" class="absolute z-10 overflow-y-scroll max-h-72 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 ">
                                <div class="p-3 space-y-2">
                                    <h3 class="font-semibold text-gray-900">Members Stats</h3>
                                    @foreach ($Districts as $District)
                                    <?php
                                    $members = User::where('affiliations', $District->id)->where('member_level', 'member')->count(); ?>
                                    <p>{{$District->affiliation_title}} : {{$members}} members found</p>
                                    @endforeach
                                </div>
                                <div data-popper-arrow></div>
                            </div>
                        </div>
                        <div class="px-4 text-gray-700 my-5">
                            <h2 class="text-lg font-medium text-gray-900">
                                <i class="fa-solid fa-user text-xl"></i> {{ __('Total Applicants') }}
                                <button data-popover-target="popover-1" data-popover-placement="bottom" type="button"><span class="sr-only">Show information</span><i class="fa-solid fa-circle-question"></i></button>
                            </h2>
                            <span class="bg-green-100 text-green-800 ml-2 text-sm font-medium me-2 px-2.5 py-0.5 rounded">{{$total_applicants}} registered applicants</span>
                            <div data-popover id="popover-1" role="tooltip" class="absolute overflow-y-scroll max-h-72 z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 ">
                                <div class="p-3 space-y-2">
                                    <h3 class="font-semibold text-gray-900">Applicants Stats</h3>
                                    @foreach ($Districts as $District)
                                    <?php
                                    $members = User::where('affiliations', $District->id)->where('member_level', 'applicant')->count(); ?>
                                    <p>{{$District->affiliation_title}} : {{$members}} applicants found</p>
                                    @endforeach
                                </div>
                                <div data-popper-arrow></div>
                            </div>
                        </div>
                        <div class="px-4 text-gray-700 my-5">
                            <h2 class="text-lg font-medium text-gray-900">
                                <i class="fa-solid fa-user text-xl"></i> {{ __('Total GCs') }}
                                <button data-popover-target="popover-2" data-popover-placement="bottom" type="button"><span class="sr-only">Show information</span><i class="fa-solid fa-circle-question"></i></button>
                            </h2>
                            <span class="bg-green-100 text-green-800 ml-2 text-sm font-medium me-2 px-2.5 py-0.5 rounded">{{$total_gcs}} registered GCs</span>
                            <div data-popover id="popover-2" role="tooltip" class="absolute z-10 overflow-y-scroll max-h-72 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 ">
                                <div class="p-3 space-y-2">
                                    <h3 class="font-semibold text-gray-900">GCs Stats</h3>
                                    @foreach ($Districts as $District)
                                    <?php
                                    $members = User::where('affiliations', $District->id)->where('member_level', 'gc')->count(); ?>
                                    <p>{{$District->affiliation_title}} : {{$members}} GCs found</p>
                                    @endforeach
                                </div>
                                <div data-popper-arrow></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class=" flex justify-center grid sm:grid-cols-3 grid-cols-1 my-8">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900 p-4">
                                {{ __('Total Districts') }} <span class="bg-green-100 text-green-800 ml-2 text-sm font-medium me-2 px-2.5 py-0.5 rounded">{{count($Districts)}} added Districts</span>
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