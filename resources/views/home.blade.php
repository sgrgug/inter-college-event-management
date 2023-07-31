<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="px-44 my-5">
        <img class="h-32 w-full object-cover" src="https://images.pexels.com/photos/933054/pexels-photo-933054.jpeg?cs=srgb&dl=pexels-joyston-judah-933054.jpg&fm=jpg" alt="">
    </div>
    

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
            <form method="POST" action="add-interest" class="bg-white p-4 rounded shadow-sm">
                @csrf
                @foreach ($categories as $cat)
                    <input class="hidden" type="checkbox" name="options[]" value="{{ $cat->id }}" id="{{ $cat->id }}">
                    <label onclick="selectLabel(this)" class="bg-slate-200 px-5 py-2 rounded inline-block m-1 cursor-pointer" for="{{ $cat->id }}"> {{ $cat->cat_name }}</label>          
                @endforeach
                <br />
                    <button class="bg-blue-500 text-white p-3 font-bold shadow mt-10" type="submit">Submit</button>
            </form>

            <script>
                function selectLabel(x)
                {
                    if(x.classList.contains("bg-slate-200"))
                    {
                        x.classList.remove("bg-slate-200");
                        x.classList.add("bg-[#FFACAC]");
                        x.classList.add("text-white");
                    } else {
                        x.classList.remove("bg-[#FFACAC]");
                        x.classList.add("bg-slate-200");
                        x.classList.remove("text-white");
                    }
                }
            </script>
            @else
                {{-- if user setup their profile then --}}
    
                {{-- Event Search --}}
                <div class="my-24">
                    <input id="searchInput" class="w-3/5 md:w-2/5 lg:w-1/4 rounded-3xl bg-gray-200 border-none px-5" placeholder="search events" type="text">
                </div>

                <div class="event-cards">
                    @if ($events->count() > 0)
                      @foreach ($events as $event)
                          <div class="bg-white rounded-lg shadow-lg p-10 my-10">
                              <div class="p-4">
                                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                                      <div>
                                          <h1 class="mb-3 text-zinc-500">Category</h1>
                                          <span class="font-source-code-pro text-xl">{{ $event->category->cat_name }}</span>
                                      </div>
                                      <div>
                                          <h1 class="mb-3 text-zinc-500">Location</h1>
                                          <span class="font-source-code-pro text-xl">{{ $event->location }}</span>
                                      </div>
                                      <div>
                                          <h1 class="mb-3 text-zinc-500">Organization</h1>
                                          <span class="font-source-code-pro text-xl">{{ $event->organize_by }}</span>
                                      </div>
                                  </div>
    
                                  <div class="font-bold mt-10 mb-4 text-2xl font-source-code-pro">{{ $event->name }}</div>
                                  <p class="font-normal text-gray-700 mb-3">{{ Illuminate\Support\Str::limit($event->description, 200) }}</p>
                                  <a href="{{ route('events.show', $event->id) }}" class="inline-block bg-blue-500 text-white py-2 px-5 rounded-md my-4">View Event</a>
                              </div>
                          </div>
                      @endforeach
    
                    @else
                          <div class="text-center py-20 text-3xl text-zinc-500">
                            No Data
                          </div>
                    @endif
                    {{-- {{ $events->links() }} --}}
                </div>
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



<script>
    $(document).ready(function() {
        // Function to display all event cards
        function displayAllEventCards() {
            $('.event-cards .bg-white').show();
        }
    
        // Function to hide all event cards
        function hideAllEventCards() {
            $('.event-cards .bg-white').hide();
        }
    
        // Function to display "No results found" message
        function showNoResultsMessage() {
            // Remove any previous "No results found" message
            hideNoResultsMessage();

            // Append the new "No results found" message
            $('.event-cards').append('<div class="no-results">No results found.</div>');
        }
    
        // Function to hide "No results found" message
        function hideNoResultsMessage() {
            $('.no-results').remove();
        }

        // Variable to store the setTimeout function
        var searchTimeout;
    
        // Event listener for the search input field
        $('#searchInput').on('keyup', function() {
            // Clear the previous setTimeout function
            clearTimeout(searchTimeout);

            var searchQuery = $(this).val().toLowerCase();
            var eventCards = $('.event-cards .bg-white'); // Get all event cards
    
            if (searchQuery.trim() === '') {
                displayAllEventCards(); // If search query is empty, show all event cards
                hideNoResultsMessage(); // Hide "No results found" message
                return;
            }

            // Add a delay of 300ms before performing the search
            searchTimeout = setTimeout(function() {
                hideAllEventCards(); // Hide all event cards initially
    
                var resultsFound = false; // To keep track if any results were found
    
                eventCards.each(function() {
                    var eventCard = $(this);
                    var eventName = eventCard.find('.font-bold').text().toLowerCase();
                    var eventDescription = eventCard.find('.font-normal').text().toLowerCase();
    
                    // Check if the search query matches the event name or description
                    if (eventName.includes(searchQuery) || eventDescription.includes(searchQuery)) {
                        eventCard.show(); // Show the event card if there's a match
                        resultsFound = true; // Set to true as results were found
                    }
                });
    
                if (!resultsFound) {
                    showNoResultsMessage(); // If no results were found, show "No results found" message
                } else {
                    hideNoResultsMessage(); // Otherwise, hide "No results found" message
                }
            }, 300); // Delay of 300ms before performing the search
        });
    });
</script>
