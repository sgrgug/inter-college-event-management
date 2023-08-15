<x-app-layout>

    <div class="">
        <div class="max-w-screen-2xl m-auto p-1">
             <hr class="w-3/4 mx-auto">
             <div class="my-10 px-2 md:px-10 lg:px-32">
                <div class="w-5/6 mx-auto">
                    
                    <h1 class="text-4xl md:text-4xl lg:text-6xl">My Created Events</h1>
                    
                    @if ($myCreatedEvents->isEmpty())
                        null
                    @else
                        @foreach ($myCreatedEvents as $myCreatedEvent)
                        
                            <div class="bg-white rounded-lg shadow-lg p-10 my-10">
                                <div class="p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                                        <div>
                                            <h1 class="mb-3 text-zinc-500">Category</h1>
                                            <span class="font-source-code-pro text-xl">{{ $myCreatedEvent->category->cat_name }}</span>
                                        </div>
                                        <div>
                                            <h1 class="mb-3 text-zinc-500">Location</h1>
                                            <span class="font-source-code-pro text-xl">{{ $myCreatedEvent->location }}</span>
                                        </div>
                                        <div>
                                            <h1 class="mb-3 text-zinc-500">Organization</h1>
                                            <span class="font-source-code-pro text-xl">{{ $myCreatedEvent->organization->name }}</span>
                                        </div>
                                    </div>
    
                                    <div class="font-bold mt-10 mb-4 text-2xl font-source-code-pro">{{ $myCreatedEvent->name }}</div>
                                    <p class="font-normal text-gray-700 mb-3">{{ Illuminate\Support\Str::limit($myCreatedEvent->description, 200) }}</p>
                                    <a href="{{ route('events.show', $myCreatedEvent->id) }}" class="inline-block bg-blue-500 text-white py-2 px-5 rounded-md my-4">View Event</a>
                                </div>
                            </div>

                        @endforeach
                    @endif
                    

                </div>
            </div>
        </div>
    </div>
        
</x-app-layout>


