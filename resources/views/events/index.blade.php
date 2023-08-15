<x-app-layout>


    <div style="background-image: url('uploads/website/bgimage.jpg');" class="bg-cover backdrop-blur-3xl my-1">
        <div class="max-w-screen-2xl m-auto font-source-code-pro">
            <div class="py-20 md:py-32 lg:py-44 px-5 md:px-10 lg:px-16">
                <h2 class="text-lg md:text-2xl lg:text-3xl"><b>Inter College</b> Event Management</h2>
                <h1 class="text-5xl md:text-6xl lg:text-8xl">2023 Events</h1>
                <a class="inline-block bg-blue-500 text-white py-2 px-5 rounded-md my-7" href="#">All Events</a>
            </div>
        </div>
    </div>


    <div class="max-w-screen-2xl m-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="p-5 md:p-10 lg:p-20 bg-gradient-to-r from-blue-600 to-blue-400">
                <h1 class="text-white font-source-code-pro text-4xl">What is inter college event management?</h1>
                <p class="text-white my-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic nisi excepturi totam quas eligendi beatae maiores porro explicabo quos dolore? Vero alias odit ducimus. Odio, sed tempore? Iste totam, impedit ab laboriosam, autem minus, ex tempore natus hic dolor vero nulla blanditiis voluptatibus saepe quo assumenda sit voluptates fugit obcaecati!</p>
                <a class="inline-block text-white py-3 px-10 border-2 rounded" href="#">Learn More</a>
            </div>
            <div class="bg-[#3c4043f2] text-white">
                <div class="grid justify-items-center grid-cols-1 md:grid-cols-2 lg:grid-cols-3 p-5 md:p-10 lg:p-20 font-source-code-pro">
                    <div class="p-4">
                        <div class="text-5xl">
                            100+
                        </div>
                        <div>
                            Total Events
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="text-5xl">
                            50+
                        </div>
                        <div>
                            Organization
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="text-5xl">
                            80+
                        </div>
                        <div>
                            Users
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="text-5xl">
                            10+
                        </div>
                        <div>
                            Categrory
                        </div>
                    </div>
                </div>
            </div>
            {{-- total events, org, user, event category --}}
        </div>
    </div>


    

    <div class="max-w-screen-2xl m-auto p-1">
        <div class="my-10 px-2 md:px-10 lg:px-32">


            {{-- @can('isOrg')
                <div class="grid grid-cols-1 md:grid-cols-12">
                    <div class="md:col-span-2">
                        <a href="{{ route('events.create') }}" class="inline-block bg-blue-500 text-white py-3 px-10 border-2 rounded">My Events</a>
                    </div>
                    <div class="md:col-span-2">
                        <a href="{{ route('events.create') }}" class="inline-block bg-blue-500 text-white py-3 px-10 border-2 rounded">My Events</a>
                    </div>
                </div>
            @endcan --}}

            {{-- My Events --}}
            <div class="grid grid-cols-1 md:grid-cols-12">
                @can('isOrg')
                    <div class="md:col-span-3">
                        <a href="{{ route('event.myCreateEvent') }}" class="inline-block bg-blue-500 text-white py-3 px-10 border-2 rounded">My Events</a>
                    </div>
                @endcan
                <div class="md:col-span-3">
                    <a href="{{ route('event.myJoinEvent') }}" class="inline-block bg-blue-500 text-white py-3 px-10 border-2 rounded">My Joined Events</a>
                </div>
            </div>

            <div class="my-24">
                <input id="searchInput" class="w-3/5 md:w-2/5 lg:w-1/4 rounded-3xl bg-gray-200 border-none px-5" placeholder="search events" type="text">
            </div>

            <div class=" bg-gray-100">
                <div class="py-12">
                  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                      <div class="p-6 bg-white border-b border-gray-200">
                        <!-- Tab buttons -->
                        <div class="flex flex-wrap space-x-4">
                          <a href="{{ route('events.index') }}" class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border-b-2 cursor-pointer border-transparent hover:border-blue-500 {{ request()->routeIs('events.index') ? 'border-blue-500' : '' }} focus:outline-none focus:text-indigo-500" data-tab="cultural">
                            All
                          </a>
                          @foreach ($cats as $cat)
                            <a href="{{ route('events.getDataByCat', $cat->slug) }}" class="px-4 py-2 text-sm font-medium text-gray-500 bg-white border-b-2 cursor-pointer border-transparent hover:border-blue-500 {{ request()->path() == 'events-'.$cat->slug ? 'border-blue-500' : '' }} focus:outline-none focus:text-indigo-500" data-tab="cultural">
                              {{ $cat->cat_name }}
                            </a>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
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
                                      <span class="font-source-code-pro text-xl">{{ $event->organization->name }}</span>
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
