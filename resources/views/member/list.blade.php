@php
use App\Models\Affiliation;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Members List') }}
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

        <div class="max-w-7xl pb-8 mx-auto sm:px-6 lg:px-8 mt-5 space-y-6">
            <div class="mb-3 px-3">
                {!! $members->withQueryString()->links() !!}
            </div>
            <div class=" sm:rounded-lg bg-white shadow">
                <div class="relative overflow-x-auto rounded">
                    <div class="p-4 ">
                        <div class="relative">
                            <form action="{{route('members.show')}}" method="GET" class="flex items-center">
                                @if (Auth::user()->type != 3)
                                <select id="destrict" name="destrict" class="mr-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option value="0">Filter by destrict</option>
                                    @foreach ($affiliations as $affiliation )
                                    <option {{$destrict != null && $destrict==$affiliation->id ? "selected":""}} value="{{$affiliation->id}}">{{$affiliation->affiliation_title}}</option>
                                    @endforeach
                                </select>
                                @endif
                                <select id="level" name="level" class=" mr-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option value="member" {{$level != null && $level=="member" ? "selected":""}}>Members</option>
                                    <option value="applicant" {{$level != null && $level=="applicant" ? "selected":""}}>Applicants</option>
                                    <option value="gc" {{$level != null && $level=="gc" ? "selected":""}}>GCs</option>
                                </select>

                                <select id="records" name="records" class=" mr-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option value="10" {{$records != null && $records==10 ? "selected":""}}>10 records per page</option>
                                    <option value="20" {{$records != null && $records==20 ? "selected":""}}>20 records per page</option>
                                    <option value="50" {{$records != null && $records==50 ? "selected":""}}>50 records per page</option>
                                    <option value="100" {{$records != null && $records==100 ? "selected":""}}>100 records per page</option>
                                </select>

                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                                        </svg>
                                    </div>
                                    <input type="text" id="simple-search" name="search" value="{{$search}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5" placeholder="Search members...">
                                </div>
                                <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    <span class="sr-only">Search</span>
                                </button>

                                <a href="/show/members/" class="p-2.5 ms-2 text-sm font-medium text-white bg-red-700 rounded-lg border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
                                    <i class="fa-solid fa-eraser"></i>
                                    <span class="sr-only">clear</span>
                                </a>
                                <a href="/member/export/excel/{{$destrict}}/{{$search}}" class="p-2.5 ms-2 text-sm font-medium text-white bg-green-700 rounded-lg border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                                    <i class="fa-solid fa-file-excel"></i>
                                    <span class="sr-only">clear</span>
                                </a>
                            </form>
                        </div>
                    </div>
                    <table class="w-full  text-sm text-left rtl:text-right text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    serial no
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    father name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    city
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    destrict
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    education
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $count = 1 + ($members->currentPage()- 1) * ($records ?$records: 10 );
                            @endphp
                            @foreach ($members as $member )
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{$count}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{$member->name}}
                                </th>
                                <td class="px-6 py-4">
                                    {{$member->father_name ? $member->father_name : "NA" }}
                                </td>
                                <td class="px-6 py-4 ">
                                    <p>{{$member->city ? $member->father_name : "NA"}}</p>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                    if($member->affiliations != null){
                                    $result = Affiliation::find($member->affiliations);
                                    echo $result->affiliation_title;
                                    }else{
                                    echo "No Destrict";
                                    }
                                    @endphp
                                </td>
                                <td class="px-6 py-4">
                                    {{$member->education ? $member->education: "NA" }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{route('member.show',$member->id )}}" class="font-medium text-blue-600 hover:underline">show</a>
                                    @if ($member->verified === 1)
                                    <span class="ml-3 text-green-600">Verified </span>
                                    @else
                                    <a href="{{route('member.verify',$member->id )}}" class="ml-3 font-medium text-blue-600 hover:underline">verify</a>
                                    @endif
                                </td>
                            </tr>
                            @php
                            $count ++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mb-3 px-3">
                {!! $members->withQueryString()->links() !!}
            </div>
        </div>


    </div>
</x-app-layout>