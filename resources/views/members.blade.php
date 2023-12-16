<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register Members') }}
        </h2>
    </x-slot>

    <div>
        @if(Session::has('message'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-3">
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

        <form method="post" action="{{ route('member.create') }}" class="mt-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @csrf
                        <h2 class="text-lg text-center font-medium text-gray-900 mb-4">
                            {{ __('Who are you ?') }}
                        </h2>
                        <div class="mb-5">
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 ">Username <span class="text-red-500">*</span></label>
                            <input type="text" id="username" name="username" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="UserName">
                            <x-input-error class="mt-2" :messages="$errors->get('username')" />

                        </div>
                        <div class="mb-5">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 "> Email <span class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Email">
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />

                        </div>
                        <div class="mb-5">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Password <span class="text-red-500">*</span></label>
                            <input type="password" id="password" name="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Password">
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />

                        </div>
                        <div class="mb-5">
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 ">Confirm Password <span class="text-red-500">*</span></label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Confirm Password">
                            <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />

                        </div>

                        <div class="mb-5">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Name <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Name">
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />

                        </div>

                        <div class="mb-5">
                            <label for="father_name" class="block mb-2 text-sm font-medium text-gray-900 ">Father/Husband Name <span class="text-red-500">*</span></label>
                            <input type="text" id="father_name" name="father_name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Father/ Husband Name">
                            <x-input-error class="mt-2" :messages="$errors->get('father_name')" />

                        </div>

                        <div class="mb-5">
                            <label for="cnic" class="block mb-2 text-sm font-medium text-gray-900 ">CNIC</label>
                            <input type="text" id="cnic" name="cnic" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="CNIC">
                            <x-input-error class="mt-2" :messages="$errors->get('cnic')" />

                        </div>
                        <div class="mb-5">
                            <label for="dob" class="block mb-2 text-sm font-medium text-gray-900 ">Select Date of Birth</label>
                            <input type="date" id="dob" name="dob" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Select Date of Birth">
                            <x-input-error class="mt-2" :messages="$errors->get('dob')" />
                        </div>
                        <div class="mb-5">
                            <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 ">Select Gender</label>
                            <select id="gender" name="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                        </div>

                        <div class="mb-5">
                            <label for="membership_date" class="block mb-2 text-sm font-medium text-gray-900 ">Select Membership Date <span class="text-red-500">*</span></label>
                            <input type="date" id="membership_date" name="membership_date" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Select Date of Birth">
                            <x-input-error class="mt-2" :messages="$errors->get('membership_date')" />
                        </div>

                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-2xl">
                        @csrf
                        <h2 class="text-lg text-center font-medium text-gray-900 mb-4">
                            What's your GEO Location?
                        </h2>
                        <div class="mb-5">
                            <label for="affiliations" class="block mb-2 text-sm font-medium text-gray-900 ">Select Organizational Affiliations <span class="text-red-500">*</span></label>
                            <select id="affiliations" name="affiliations" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="0">Select Affiliation</option>

                                @foreach ($affiliations as $affiliation)
                                <option value="{{$affiliation->id}}">{{$affiliation->affiliation_title}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="constituency_status" name="constituency_status" value="0">
                            <x-input-error class="mt-2" :messages="$errors->get('affiliations')" />
                        </div>
                        <div class="mb-5">
                            <label for="constituency" class="block mb-2 text-sm font-medium text-gray-900 ">Select Constituency <span class="text-red-500">*</span></label>
                            <select id="constituency" name="constituency" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="0">Select Constituency</option>
                            </select>
                            <input type="hidden" id="union_status" name="union_status" value="0">
                            <x-input-error class="mt-2" :messages="$errors->get('constituency')" />
                        </div>
                        <div class="mb-5">
                            <label for="union_council" class="block mb-2 text-sm font-medium text-gray-900 ">Select union council <span class="text-red-500">*</span></label>
                            <select id="union_council" name="union_council" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="0">Union Council</option>
                            </select>
                            <input type="hidden" id="ward_status" name="ward_status" value="0">
                            <x-input-error class="mt-2" :messages="$errors->get('union_council')" />
                        </div>
                        <div class="mb-5">
                            <label for="ward" class="block mb-2 text-sm font-medium text-gray-900 ">Select ward <span class="text-red-500">*</span></label>
                            <select id="ward" name="ward" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="0">Select Ward</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('ward')" />
                        </div>
                        <div class="mb-5">
                            <label for="geographical_address" class="block mb-2 text-sm font-medium text-gray-900 ">Geographical Address </label>
                            <input type="text" id="geographical_address" name="geographical_address" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Geographical Address">
                            <x-input-error class="mt-2" :messages="$errors->get('geographical_address')" />
                        </div>

                        <div class="mb-5">
                            <label for="local_jamat" class="block mb-2 text-sm font-medium text-gray-900 ">Name of Local Jamat </label>
                            <input type="text" id="local_jamat" name="local_jamat" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Name of Local Jamat">
                            <x-input-error class="mt-2" :messages="$errors->get('local_jamat')" />
                        </div>

                        <div class="mb-5">
                            <label for="city" class="block mb-2 text-sm font-medium text-gray-900 ">City</label>
                            <input type="text" id="city" name="city" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="City">
                            <x-input-error class="mt-2" :messages="$errors->get('city')" />
                        </div>

                        <div class="mb-5">
                            <label for="village" class="block mb-2 text-sm font-medium text-gray-900 ">Village</label>
                            <input type="text" id="village" name="village" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Village">
                            <x-input-error class="mt-2" :messages="$errors->get('village')" />
                        </div>

                        <div class="mb-5">
                            <label for="mailing_address" class="block mb-2 text-sm font-medium text-gray-900 ">Mailing Address</label>
                            <input type="text" id="mailing_address" name="mailing_address" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Mailing Address">
                            <x-input-error class="mt-2" :messages="$errors->get('mailing_address')" />
                        </div>

                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-2xl">
                        @csrf
                        <h2 class="text-lg text-center font-medium text-gray-900 mb-4">
                            What's your Occupation?
                        </h2>
                        <div class="mb-5">
                            <label for="occupation" class="block mb-2 text-sm font-medium text-gray-900 ">Occupation</label>
                            <input type="text" id="occupation" name="occupation" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Occupation">
                            <x-input-error class="mt-2" :messages="$errors->get('occupation')" />
                        </div>
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-2xl">
                        @csrf
                        <h2 class="text-lg text-center font-medium text-gray-900 mb-4">
                            What's your Academic Record?
                        </h2>
                        <div class="mb-5">
                            <label for="education" class="block mb-2 text-sm font-medium text-gray-900 ">Education</label>
                            <input type="text" id="education" name="education" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Education">
                            <x-input-error class="mt-2" :messages="$errors->get('education')" />
                        </div>

                    </div>
                </div>

                <div class="md:col-span-2 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-2xl">
                        @csrf
                        <h2 class="text-lg text-center font-medium text-gray-900 mb-4">
                            What's your Phone No's?
                        </h2>
                        <div class="mb-5">
                            <label for="home_phone" class="block mb-2 text-sm font-medium text-gray-900 ">Home Phone</label>
                            <input type="text" id="home_phone" name="home_phone" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Home Phone">
                            <x-input-error class="mt-2" :messages="$errors->get('home_phone')" />
                        </div>
                        <div class="mb-5">
                            <label for="office_phone" class="block mb-2 text-sm font-medium text-gray-900 ">Office Phone</label>
                            <input type="text" id="office_phone" name="office_phone" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Office Phone">
                            <x-input-error class="mt-2" :messages="$errors->get('office_phone')" />
                        </div>
                        <div class="mb-5">
                            <label for="mobile_phone" class="block mb-2 text-sm font-medium text-gray-900 ">Mobile <span class="text-red-500">*</span></label>
                            <input type="text" id="mobile_phone" name="mobile_phone" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Mobile">
                            <x-input-error class="mt-2" :messages="$errors->get('mobile_phone')" />
                        </div>

                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pb-8">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-large rounded-lg text-md px-8 py-2.5 text-center ">Register</button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {

            $("#affiliations").change(function() {
                var id = $(this).val();
                var url = '/getconstituency/' + id;
                $.get(url, function(data) {
                    if (data.length === 0) {
                        $("#constituency_status").attr("value", "0");
                        $("#constituency").find('option')
                            .remove()
                            .end().
                        append($('<option>', {
                            text: "No constituency found",
                            value: "0"
                        }));
                    } else {
                        $("#constituency_status").attr("value", "1");
                        $("#constituency").find('option')
                            .remove()
                            .end().
                        append($('<option>', {
                            text: "Select Constituency",
                            value: "0"
                        }));
                        for (var i = 0; i < data.length; i++) {
                            $("#constituency").
                            append($('<option>', {
                                value: data[i].id,
                                text: data[i].constituency_title,
                            }));
                        }
                    }
                })
            });

            $("#constituency").change(function() {
                var id = $(this).val();
                var url = '/getunioncouncil/' + id;
                $.get(url, function(data) {
                    if (data.length === 0) {
                        $("#union_status").attr("value", "0");
                        $("#union_council").find('option')
                            .remove()
                            .end().
                        append($('<option>', {
                            text: "No union council found",
                            value: "0"
                        }));
                    } else {
                        $("#union_status").attr("value", "1");
                        $("#union_council").find('option')
                            .remove()
                            .end().
                        append($('<option>', {
                            text: "Select union council",
                            value: "0"
                        }));
                        for (var i = 0; i < data.length; i++) {
                            $("#union_council").
                            append($('<option>', {
                                value: data[i].id,
                                text: data[i].union_council_title,
                            }));
                        }
                    }
                })
            });

            $("#union_council").change(function() {
                var id = $(this).val();
                var url = '/getward/' + id;
                $.get(url, function(data) {
                    if (data.length === 0) {
                        $("#ward_status").attr("value", "0");
                        $("#ward").find('option')
                            .remove()
                            .end().
                        append($('<option>', {
                            text: "No ward found",
                            value: "0"
                        }));
                    } else {
                        $("#ward_status").attr("value", "1");
                        $("#ward").find('option')
                            .remove()
                            .end().
                        append($('<option>', {
                            text: "Select ward",
                            value: "0"
                        }));
                        for (var i = 0; i < data.length; i++) {
                            $("#ward").
                            append($('<option>', {
                                value: data[i].id,
                                text: data[i].ward_title,
                            }));
                        }
                    }
                })
            });
        });
    </script>
</x-app-layout>