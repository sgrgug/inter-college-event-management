<x-app-layout>
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
