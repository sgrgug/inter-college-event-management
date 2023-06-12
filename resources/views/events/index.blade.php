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
    

    <div class="max-w-screen-2xl m-auto p-1 bg-yellow-200">
        <div class="my-10 px-2 md:px-10 lg:px-32 bg-yellow-100">


            
            @foreach ($events as $item)
                {{ $item->name }}
                {{-- {{ $item->start->diffForHumans() }} --}}
                {{ \Carbon\Carbon::parse($item->start)->diffForHumans() }}
<br />
                    {{-- @if (\Carbon\Carbon::parse($item->start)->isFuture(\Carbon\Carbon::now()))
                        The record was updated in the future.
                    @else
                        The record was updated in the past.
                    @endif --}}



            @endforeach

        </div>
    </div>
    
</x-app-layout>
