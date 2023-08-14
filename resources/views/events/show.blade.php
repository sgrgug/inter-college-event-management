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

                    @php
                        $eventusers = \App\Models\EventUser::where('user_id', auth()->user()->id)->get();
                    @endphp

                    @foreach ($eventusers as $eventuser)
                        {{ $eventuser->event_id }}
                    @endforeach
                    <form action="{{ route('event.join', $event->id) }}" method="post">
                        @csrf
                        <input class="inline-block bg-blue-500 text-white py-2 px-5 rounded-md my-4 cursor-pointer {{ auth()->user()->events->contains($event->id) ? 'bg-zinc-500' : '' }}" type="submit" value="{{ auth()->user()->events->contains($event->id) ? 'Joined' : 'Join' }}">
                        {{-- <input class="inline-block bg-blue-500 text-white py-2 px-5 rounded-md my-4 cursor-pointer" type="submit" value="s"> --}}
                    </form>
                </div>
             </div>
         </div>
    </div>
        
</x-app-layout>


