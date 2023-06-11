<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="px-44 my-5">
        <img class="h-32 w-full object-cover" src="https://images.pexels.com/photos/933054/pexels-photo-933054.jpeg?cs=srgb&dl=pexels-joyston-judah-933054.jpg&fm=jpg" alt="">
    </div>
    

    
    {{-- <div class="max-w-screen-2xl m-auto">
        <div class="bg-red-300">
            {{ $null }}
        </div>
    </div> --}}

    @if ($check)
        <a href="{{ route('organization.org_profile_update') }}">
            <div class="flex justify-center items-center">
                <div class="bg-gradient-to-r from-[#FFACAC] to-[#FFBFA9] p-4 rounded-lg">
                    <div class="flex text-white">
                        <div>
                            <span class="font-bold text-2xl">Complete your profile</span>
                            <p>You need to complete your profile to check available events</p>
                        </div>
                        <div>
                            <ion-icon class="text-6xl" name="person-outline"></ion-icon>
                        </div>
                    </div>
                    <div class="bg-slate-100 rounded">
                        <div class="bg-red-400 rounded w-1/2 text-sm text-center text-white">50%</div>
                    </div>
                </div>
            </div>
        </a>
        
          
    @else
        data xa
    @endif

    <div class="max-w-screen-2xl m-auto p-1">
        <div class="my-10 px-2 md:px-10 lg:px-32">

            @can('isOrg')
                <div class="my-5 py-5">
                    <a class="bg-blue-500 text-white p-3 font-bold" href="{{ route('events.create') }}">Create New Event</a>
                </div>
            @endcan



            

            @if ($checkingInterest === 0)
            <form method="POST" action="add-interest">
                @foreach ($categories as $cat)
                    {{-- <span class="bg-red-300 font-bold px-5 py-2 text-white inline-block my-1 rounded cursor-pointer">{{ $cat->cat_name }}</span> --}}
                    @csrf
                    {{-- <input type="checkbox" name="categories[]" value="{{ $cat->id }}" id="{{ $cat->id }}"> --}}
                    
                    <input type="checkbox" name="options[]" value="{{ $cat->id }}" id="{{ $cat->id }}"> {{ $cat->cat_name }}<br>

                    {{-- <label class="" for="{{ $cat->id }}">{{ $cat->cat_name }}</label> --}}
                    <br>
                    @endforeach
                    <button type="submit">Submit</button>
            </form>
            @else
                {{-- if user setup their profile then --}}
    
                {{-- Event Search --}}
                <form action="" method="post">
                    <input class="w-3/5 md:w-2/5 lg:w-1/4 rounded-3xl bg-gray-200 border-none px-5" placeholder="search events" type="text">
                </form>



            @endif
            
            
            
            
        </div>
    </div>




    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
