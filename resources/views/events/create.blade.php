<x-app-layout>
    <div class="max-w-screen-2xl m-auto p-1">
        <div class="my-10 px-2 md:px-10 lg:px-32">


            <div class="bg-white shadow-sm">
                <h1 class="inline-block font-bold text-lg px-4 py-5 rounded shadow-sm w-full">Create Event</h1>


                <form action="{{ route('events.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col p-4">
                        <label class="font-bold text-gray-500" for="">Event Name</label>
                        @error('name')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <input class="rounded-md border-gray-400" placeholder="Event Name" name="name" type="text" value={{ old('name') }}>
                    </div>
                    
                    <div class="flex flex-col p-5">
                        <label class="font-bold text-gray-500" for="">Description</label>
                        @error('description')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <textarea class="rounded-md border-gray-400" name="description" placeholder="Description" type="text">{{ old('description') }}</textarea>
                    </div>
                    
                    <div class="flex flex-col p-5">
                        <label class="font-bold text-gray-500" for="">Event Category</label>

                        @error('category')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <select class="rounded-md border-gray-400" name="cat_value" id="cat_value">
                            @foreach ($event_cat as $all_cat)
                                <option value="{{ $all_cat->id }}">{{ $all_cat->cat_name }}</option>
                            @endforeach
                        </select>
                        
                    </div>

                    <div class="flex flex-col p-5">
                        <label class="font-bold text-gray-500" for="">Photo</label>
                        @error('photo')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <input type="file" name="photo">
                    </div>
                    
                    <div class="flex flex-col p-5">
                        <label class="font-bold text-gray-500" for="">Location</label>
                        @error('location')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <input class="rounded-md border-gray-400" name="location" type="text" value="{{ old('location') }}">
                    </div>


                    <div class="flex flex-col p-5">
                        <label class="font-bold text-gray-500" for="">Time</label>
                        @error('datetime')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <input type="datetime-local" id="datetime" name="datetime">
                    </div>

                    <div class="p-5">
                        <input class="bg-blue-500 text-white px-3 py-1 cursor-pointer rounded-md my-4" type="submit" value="Save">
                    </div>
                </form>
            </div>

        </div>
    </div>

</x-app-layout>
