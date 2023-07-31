<x-app-layout>

    <div class="bg-white">
        <div class="flex justify-center items-center">
            <div>
                <img class="w-[1800px] h-[800px] object-cover" src="{{ asset('uploads/event/'. $event->photo) }}" alt="">
                <div class="max-w-screen-2xl m-auto font-source-code-pro">
                    <div class="py-16 md:py-28 lg:py-32 px-5 md:px-10 lg:px-16">
                        <h2 class="text-xl text-zinc-500">Category</h2>
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
                            <div>{{ $event->organize_by }}</div>
                        </div>
                        <div>
                            <div class="text-zinc-500 py-4">Location</div>
                            <div>{{ $event->location }}</div>
                        </div>
                        <div>
                            <div class="text-zinc-500 py-4">Date</div>
                            <div>{{ $event->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    <div class="py-32">
                        {{ $event->description }}
                    </div>
                </div>
             </div>
         </div>
    </div>
        
</x-app-layout>


