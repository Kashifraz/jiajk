<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Image') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Upload a clear formal photograph in jpg format") }}
        </p>
        <div class="flex items-center gap-4 mt-3">
            @if (isset(Auth::user()->profile))
            <img class="w-20 h-20 rounded-full" src="{{ asset('uploads/'.Auth::user()->profile) }}" alt="">
            @endif
            <div class="font-medium">
                <div>{{Auth::user()->name}}</div>
                <div class="text-sm text-gray-500">{{Auth::user()->created_at}}</div>
            </div>
        </div>
    </header>

    <form method="post" action="{{route('upload.image')}}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        <div>
            <input id="multiple_files" name="file" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>