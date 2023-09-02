<x-app-layout>
    <div class="max-w-screen-2xl m-auto p-1">
        <div class="my-10 px-2 md:px-10 lg:px-32">

            @if (session('status'))
                <div class="{{ session('status') == 'Payment Successful' ? 'bg-green-500' : 'bg-red-500' }} text-white p-2 rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white shadow-sm my-5">
                <section class="body-font overflow-hidden">
                    <div class="container mx-auto">
                        
                        <div class="relative">
                            <div class="relative">
                                <img class="h-96 w-full object-cover" src="{{ asset('uploads/' . $org->photo) }}" alt="">
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
                                <a href="{{ route('organization.org_profile_update') }}" class="inline-block bg-gray-500 text-white py-3 px-10 border-0 rounded font-bold">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-2">
                <div class="col-span-4">
                    <div class="bg-white shadow-sm my-5">
                        <section class="body-font overflow-hidden">
                            <div class="container mx-auto">
                                <div class="font-source-code-pro px-10 py-5">
                                    <h1 class="font-bold text-2xl">About</h1>
                                    <div class="flex justify-start items-start py-1">
                                        <div><p><ion-icon name="location-outline"></ion-icon></p></div>
                                        <div><p>{{ $org->location }}</p></div>
                                    </div>
                                    <div class="flex justify-start items-start py-1">
                                        <div><p><ion-icon name="document-text-outline"></ion-icon></p></div>
                                        <div><p>{{ $limitedText = Str::limit($org->description, 80, '...'); }}</p></div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="col-span-8">
                    <div class="bg-white shadow-sm my-5">
                        <section class="body-font overflow-hidden">
                            <div class="container mx-auto">
                                <div class="font-source-code-pro px-10 py-5">
                                    <h1 class="font-bold text-3xl">My Events</h1>
                                    <div class="flex justify-start items-center py-3 text-2xl">
                                        <ion-icon name="terminal-outline"></ion-icon>Total: {{ $myEventCount }} <span> Events</span>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
