<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Region') }}
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

        <div class="py-5 grid grid-cols-1 md:grid-cols-2 gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class=" p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg text-center font-medium text-gray-900 mb-4">
                        Add Organizational Affiliations
                    </h2>
                    <form method="post" action="{{ route('affiliation.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div class="mb-5">
                            <label for="affiliation_title" class="block mb-2 text-sm font-medium text-gray-900 ">Affiliation Title</label>
                            <input type="text" id="affiliation_title" name="affiliation_title" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Affiliation">
                            <x-input-error class="mt-2" :messages="$errors->get('affiliation_title')" />
                        </div>

                        <div class="mb-5">
                            <label for="region" class="block mb-2 text-sm font-medium text-gray-900 ">Select Region</label>
                            <select id="region" name="region" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="ajk">AJK</option>
                                <option value="gb">GB</option>
                                <option value="pk">PK</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('region')" />
                        </div>

                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Register</button>
                    </form>
                </div>
            </div>


            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-2xl">

                    <h2 class="text-lg text-center font-medium text-gray-900 mb-4">
                        Add Constituency
                    </h2>
                    <form method="post" action="{{ route('constituency.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div class="mb-5">
                            <label for="constituency_title" class="block mb-2 text-sm font-medium text-gray-900 ">Constituency Title</label>
                            <input type="text" id="constituency_title" name="constituency_title" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Constituency">
                            <x-input-error class="mt-2" :messages="$errors->get('constituency_title')" />
                        </div>

                        <div class="mb-5">
                            <label for="affiliation" class="block mb-2 text-sm font-medium text-gray-900 ">Select Parrent Organizational Affiliation</label>
                            <select id="affiliation" name="affiliation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                @foreach ($affiliations as $affiliation )
                                <option value="{{$affiliation->id}}">{{$affiliation->affiliation_title}}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('affiliation')" />
                        </div>

                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Register</button>

                    </form>

                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-2xl">
                    <h2 class="text-lg text-center font-medium text-gray-900 mb-4">
                        Add Union Council
                    </h2>
                    <form method="post" action="{{ route('unioncouncil.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div class="mb-5">
                            <label for="union_council_title" class="block mb-2 text-sm font-medium text-gray-900 ">Union Council Title</label>
                            <input type="text" id="union_council_title" name="union_council_title" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Union Council">
                            <x-input-error class="mt-2" :messages="$errors->get('union_council_title')" />

                        </div>

                        <div class="mb-5">
                            <label for="constituency" class="block mb-2 text-sm font-medium text-gray-900 ">Select Parrent Constituency</label>
                            <select id="constituency" name="constituency" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                @foreach ($constituencies as $constituency )
                                <option value="{{$constituency->id}}">{{$constituency->constituency_title}}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('constituency')" />
                        </div>

                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Register</button>

                    </form>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-2xl">
                    <h2 class="text-lg text-center font-medium text-gray-900 mb-4">
                        Add Ward
                    </h2>

                    <form method="post" action="{{ route('ward.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div class="mb-5">
                            <label for="ward_title" class="block mb-2 text-sm font-medium text-gray-900 ">Ward Title</label>
                            <input type="text" id="ward_title" name="ward_title" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Ward">
                            <x-input-error class="mt-2" :messages="$errors->get('ward_title')" />

                        </div>

                        <div class="mb-5">
                            <label for="union_council" class="block mb-2 text-sm font-medium text-gray-900 ">Select Parrent Union Council</label>
                            <select id="union_council" name="union_council" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                @foreach ($unioncouncils as $unioncouncil )
                                <option value="{{$unioncouncil->id}}">{{$unioncouncil->union_council_title}}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('union_council')" />
                        </div>

                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Register</button>

                    </form>
                </div>
            </div>
        </div>
        </form>
    </div>
</x-app-layout>