<x-app-layout>
    <div class="max-w-screen-2xl m-auto p-1">
        <div class="my-10 px-2 md:px-10 lg:px-32">

            @if (session('status'))
                <div
                    class="bg-green-500 text-white p-2 rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white shadow-sm my-5">
                <section class="body-font overflow-hidden">
                    <div class="container mx-auto">

                        <div class="relative">
                            <div class="relative">
                                <img class="h-96 w-full object-cover" src="{{ asset('uploads/' . $org->photo) }}"
                                    alt="">
                                <div class="absolute inset-0 bg-blue-500 opacity-50"></div>
                            </div>
                            <div class="absolute bottom-5 left-10">
                                <div class="text-4xl font-bold">
                                    Organization Profile
                                </div>
                                <div>
                                    <span>{{ $org->name }}</span> - <span>{{ $org->location }}</span>
                                </div>
                            </div>
                            <div class="absolute bottom-10 right-5">
                                <a href="{{ route('organization.org_profile_update') }}"
                                    class="inline-block bg-gray-500 text-white py-3 px-10 border-0 rounded font-bold">Edit
                                    Profile</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-2">
                <div class="col-span-4">
                    <div class="bg-white shadow-md my-5">
                        <section class="body-font overflow-hidden">
                            <div class="container mx-auto">
                                <div class="px-10 py-5">
                                    <h1 class="font-bold text-2xl">About</h1>
                                    <div class="flex justify-start items-start py-1">
                                        <div>
                                            <p><ion-icon name="location-outline"></ion-icon></p>
                                        </div>
                                        <div>
                                            <p>{{ $org->location }}</p>
                                        </div>
                                    </div>
                                    <div class="flex justify-start items-start py-1">
                                        <div>
                                            <p><ion-icon name="document-text-outline"></ion-icon></p>
                                        </div>
                                        <div>
                                            <p>{{ $limitedText = Str::limit($org->description, 80, '...') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="bg-white shadow-md my-5">
                        <section class="body-font overflow-hidden">
                            <div class="container mx-auto">
                                <div class="px-10 py-5">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h1 class="font-bold text-2xl"> <span class="text-red-600">{{ $notificationCount }} </span>Notifications</h1>
                                        </div>
                                        <div>
                                            <a href="" class="text-blue-600 hover:text-blue-400">Read All</a> | <a href="" class="text-blue-600 hover:text-blue-400">View all</a>
                                        </div>
                                    </div>
                                    <div class="py-1">
                                        <div>
                                            @foreach ($notifications as $notification)
                                                <div class="my-1 p-1 hover:bg-zinc-200 hover:rounded-md">
                                                    <span class="font-bold">{{ $notification->title }} </span><span>{{ $notification->message }}</span><ion-icon class="{{ $notification->read == false ? 'text-blue-500 px-2' : 'text-transparent' }}" name="ellipse"></ion-icon><br />
                                                    <p class="text-sm text-bold {{ $notification->read == false ? 'text-blue-500' : 'text-zinc-400' }}">{{ $notification->created_at->diffForHumans()  }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="col-span-8">
                    <div class="bg-white shadow-md my-5">
                        <section class="body-font overflow-hidden">
                            <div class="container mx-auto">
                                <div class="px-10 py-5">
                                    <div class="flex justify-between items-center">
                                        <span class="font-bold text-3xl">My Events</span><span class="text-blue-600 hover:text-blue-400"><a
                                                href="{{ route('event.myCreateEvent') }}">View all</a></span>
                                    </div>
                                    <div class="flex justify-start items-center py-3 text-xl">
                                        <ion-icon name="terminal-outline"></ion-icon><span class="font-bold">Total: </span><span
                                            class="text-red-500 mx-1">{{ $myEventCount }}</span> <span> Events</span>
                                    </div>


                                    <section class="text-gray-600 body-font">
                                        <div class="container px-5 py-5 mx-auto">
                                            <div class="flex flex-wrap -m-4">
                                                @foreach ($myEvents as $myEvent)
                                                    <div class="p-4 md:w-1/3">
                                                        <div
                                                            class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                                                            <img class="lg:h-48 md:h-36 w-full object-cover object-center"
                                                                src="{{ asset('uploads/event/'. $myEvent->photo) }}" alt="blog">
                                                            <div class="p-6">
                                                                <h2
                                                                    class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">
                                                                    {{ $myEvent->category->cat_name }}</h2>
                                                                <h1
                                                                    class="title-font text-lg font-medium text-gray-900 mb-3">
                                                                    {{ $myEvent->name }}</h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </section>

                                </div>
                            </div>
                        </section>
                    </div>

                    
                    <div class="bg-white shadow-md my-5">
                        <section class="body-font overflow-hidden">
                            <div class="container mx-auto">
                                <div class="px-10 py-5">
                                    <section class="text-gray-600 body-font">
                                        <h1 class="font-bold text-3xl py-3 text-black">Volunteer Section</h1>
                                        <div class="container px-5 mx-auto">
                                            @foreach ($volunteers as $volunteer)
                                                <div class="bg-[#fbfbfb] px-4 py-1 rounded-md">
                                                    <span class="font-bold">Event :</span><span>{{ $volunteer->event->name }}</span><br />
                                                    <span class="font-bold">User :</span><span class="text-blue-500">{{ $volunteer->user->name }}</span><br />
                                                    <span class="font-bold">Type :</span><span>{{ $volunteer->type }}</span><br />
                                                    <span class="font-bold">Description :</span><span>{{ $volunteer->description }}</span><br />

                                                    <div class="flex justify-between items-center">
                                                        <span class="text-blue-500">{{ $volunteer->created_at->diffForHumans() }}</span>
                                                        <div>
                                                            <span><a class="text-blue-500 hover:text-blue-300" href="{{ route('volunteer.approve', $volunteer->id) }}">Approve</a></span> | <span><a class="text-red-500 hover:text-red-300" href="{{ route('volunteer.reject', $volunteer->id) }}">Reject</a></span>
                                                        </div>
                                                    </div>

                                                </div><br/>
                                            @endforeach
                                        </div>
                                    </section>

                                </div>
                            </div>
                        </section>
                    </div>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>
