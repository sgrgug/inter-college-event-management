<x-app-layout>

    <div class="bg-white">
        <div class="flex justify-center items-center">
            <div>
                <img class="w-[1800px] h-[800px] object-cover" src="{{ asset('uploads/event/'. $event->photo) }}" alt="">
                <div class="max-w-screen-2xl m-auto font-source-code-pro">
                    <div class="py-16 md:py-28 lg:py-32 px-5 md:px-10 lg:px-16">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl text-zinc-500">Category</h2>
                            @can('isOrg')
                                @if ($eventI_OrgId == $authOrgId)
                                    <a class="bg-blue-500 text-white p-3 font-bold" href="{{ route('events.edit', $event->id) }}">Edit</a>
                                @endif
                            @endcan
                        </div>
                        <h2 class="text-lg md:text-2xl lg:text-3xl">{{ $event->category->cat_name }}</h2>
                        <h1 class="text-4xl md:text-6xl lg:text-8xl">{{ $event->name }}</h1>
                    </div>
                </div>
            </div>
         </div>
         
         <div class="max-w-screen-2xl m-auto p-1">
             <hr class="w-3/4 mx-auto">
             <div class="my-10 px-2 md:px-10 lg:px-32">
                <div class="w-5/6">
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="text-zinc-500 py-4">Organize By</div>
                            <div>{{ $event->organization->name }}</div>
                        </div>
                        <div>
                            <div class="text-zinc-500 py-4">Location</div>
                            <div>{{ $event->location }}</div>
                        </div>
                        <div>
                            <div class="text-zinc-500 py-4">{{ $event->start >= \Carbon\Carbon::now() ? 'Begin In' : 'Ended' }}</div>
                            <div class="{{ $event->start >= \Carbon\Carbon::now() ? 'text-green-600' : 'text-red-600' }} font-bold">{{ \Carbon\Carbon::parse($event->start)->diffForHumans() }}</div>
                        </div>
                    </div>
                    <div class="py-32">
                        {{ $event->description }}
                    </div>
                    @if (session('status'))
                        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" id="modalBackdrop">
                            <!-- Modal content -->
                            <div class="bg-white rounded-lg p-6 max-w-sm mx-auto shadow-lg" id="modalContent">
                                <p class="mb-4">{{ Session::get('status') }}.</p>
                                <div class="flex justify-end">
                                    <button class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600" id="modalCloseBtn">Close</button>
                                </div>
                            </div>
                        </div>
                        <script>
                            // Function to show the modal
                            function showModal() {
                                document.getElementById('modalBackdrop').classList.remove('hidden');
                                document.getElementById('modalContent').classList.remove('hidden');
                            }

                            // Function to hide the modal
                            function hideModal() {
                                document.getElementById('modalBackdrop').classList.add('hidden');
                                document.getElementById('modalContent').classList.add('hidden');
                            }

                            // Attach click event to close button
                            document.getElementById('modalCloseBtn').addEventListener('click', hideModal);

                            // Show the modal when the page finishes loading
                            window.onload = showModal;
                        </script>
                    @endif

                    {{-- @php
                        $eventusers = \App\Models\EventUser::where('user_id', auth()->user()->id)->get();
                    @endphp

                    @foreach ($eventusers as $eventuser)
                        {{ $eventuser->event_id }}
                    @endforeach --}}

                    @can('isOrg')
                        @if ($eventI_OrgId == $authOrgId)

                            {{-- Volunteer Listing --}}
                            <div class="my-3">
                                <h1 class="font-bold text-2xl">List of Volunteer</h1>
                                <div class="bg-zinc-100">
                                    <table class="table w-full">
                                        <thead>
                                            <tr class="bg-zinc-300">
                                                <th scope="col">S.N</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Comment</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Created_at</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach ($volunteers as $volunteer)
                                                <tr class="text-center hover:bg-white duration-300 ease-out">

                                                    <td>{{ $loop->iteration }}.</td>
                                                    <td>{{ $volunteer->user->name }}</td>
                                                    <td>{{ $volunteer->type }}</td>
                                                    <td>{{ $volunteer->description }}</td>
                                                    <td>{{ $volunteer->status }}</td>
                                                    <td>{{ $volunteer->created_at->diffForHumans() }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- List of Joining --}}
                            <div class="my-3">
                                <h1 class="font-bold text-2xl">List of Joining</h1>
                                <div class="bg-zinc-100">
                                    <table class="table w-full">
                                        <thead>
                                            <tr class="bg-zinc-300">
                                                <th scope="col">S.N</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Join</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach ($joinedListing->users as $item)
                                                <tr class="text-center hover:bg-white duration-300 ease-out">
                                                    <td>{{ $loop->iteration }}.</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $joinedListing->created_at->diffForHumans() }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    @endcan

                    
                    @if ($eventI_OrgId == $authOrgId)
                        <div class="text-yellow-500">This event is oraganize by yourself!</div>
                    @else 
                        @if ($event->start >= \Carbon\Carbon::now())
                            <form action="{{ route('event.join', $event->id) }}" method="post">
                                @csrf
                                <input class="inline-block bg-blue-500 text-white py-2 px-5 rounded-md my-4 cursor-pointer {{ auth()->user()->events->contains($event->id) ? 'bg-zinc-500' : '' }}" type="submit" value="{{ auth()->user()->events->contains($event->id) ? 'Joined' : 'Join' }}">
                            </form>

                            {{-- Event volunteer --}}

                            <div class="my-10">
                                <h1 class="text-3xl font-bold my-3">Become Volunteer</h1>
                                <div class="bg-[#f3f3f3] border-2 rounded-md p-5">
                                    <form action="{{ route('volunteer', $event->id) }}" method="post">
                                        @csrf
                                        <label class="inline-block font-bold my-3" for="">Volunteer Type: </label><br />
                                        <input type="text" id="type" name="type" placeholder="Volunteer Type" class="bg-white rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"><br />

                                        <label class="inline-block font-bold my-3" for="">Volunteer Description: </label><br />
                                        <textarea name="description" id="description" placeholder="Mention why your become volunteer!" class="bg-white rounded border w-full border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea><br /><br />

                                        <input class="bg-blue-500 px-4 py-2 text-white cursor-pointer" type="submit" value="Submit">
                                    </form>
                                </div>
                            </div>

                            {{-- Review Section --}}

                            <h1 class="text-3xl font-bold my-3">Add A Review</h1>

                            <div class="bg-[#f3f3f3] border-2 rounded-md p-5">
                                @csrf
                                <form method="POST" action="{{ route('events.reviews.store', $event->id) }}">
                                    @csrf
                                    <label class="inline-block font-bold my-3" for="">Username: </label><span> {{ auth()->user()->name }}</span><br />

                                    <label class="inline-block font-bold my-3" for="">Rating: </label><br />
                                    <input type="text" id="rating" min="1" max="5" name="rating" placeholder="Rating" class="bg-white rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"><br />

                                    <label class="inline-block font-bold my-3" for="">Comment: </label><br />
                                    <textarea name="comment" id="comment" placeholder="Add Review" class="bg-white rounded border w-full border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea><br /><br />

                                    <input class="bg-blue-500 px-4 py-2 text-white cursor-pointer" type="submit" value="Submit Review">
                                </form>
                            </div>

                        @else
                            <div>This event is ended!</div>
                        @endif
                    @endif
                    <div class="text-2xl font-bold mt-6">Reviews</div>

                    @foreach ($reviews as $item)
                        <div class="grid grid-cols-12 bg-zinc-100 cursor-pointer p-4 mt-7">
                            <div class="col-span-1">
                                <div class="bg-zinc-300 w-fit rounded-full px-5 py-4 text-4xl">
                                    <ion-icon name="person-outline"></ion-icon>
                                </div>
                            </div>
                            <div class="col-span-10">
                                <div class="flex items-center space-x-1">
                                    @php
                                        $user = \App\Models\User::where('id', $item->user_id)->first();
                                    @endphp
                                    <a href="" class="font-bold hover:underline">{{ $user->name }}</a>
                                    <div class="text-zinc-600">
                                        {{-- {{ __('@') }}{{ $tweet->user->username }} --}}
                                        {{ __('·') }}
                                        {{ $item->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                <div>
                                    <ion-icon class="text-yellow-400" name="star"></ion-icon><small>{{ $item->rating }}/5</small>
                                </div>
                                <a href="">
                                    <div class="mb-4">
                                        {{ $item->comment }}
                                    </div>
                                </a>
                                <div class="flex justify-between text-md">
                                    <div class="p-2 hover:bg-blue-100 hover:text-blue-700 duration-300 rounded-full">
                                        <a class="flex items-center" href="#">
                                            <ion-icon name="chatbubble-outline"></ion-icon>
                                            <span></span>
                                        </a>
                                    </div>
                                    {{-- <div class="p-2 hover:bg-green-100 hover:text-green-700 duration-300 rounded-full">
                                        <a href="#"><ion-icon name="git-compare-outline"></ion-icon></a>
                                    </div> --}}
                                    <div class="p-2 hover:bg-red-100 hover:text-red-700 duration-300 rounded-full">
                                        <a href="#"><ion-icon name="heart-outline"></ion-icon></a>
                                    </div>
                                    {{-- <div class="p-2 hover:bg-blue-100 hover:text-blue-700 duration-300 rounded-full">
                                        <a href="#"><ion-icon name="stats-chart-outline"></ion-icon></a>
                                    </div> --}}
                                    <div class="p-2 hover:bg-blue-100 hover:text-blue-700 duration-300 rounded-full">
                                        <a href="#"><ion-icon name="share-outline"></ion-icon></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <ion-icon class="hover:bg-blue-100 rounded-full p-3 duration-300" name="ellipsis-horizontal"></ion-icon>
                            </div>
                
                        </div>
                    @endforeach
                </div>
             </div>
         </div>
    </div>
        
</x-app-layout>


