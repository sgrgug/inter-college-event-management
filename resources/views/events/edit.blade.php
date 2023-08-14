<x-app-layout>
    <div class="max-w-screen-2xl m-auto p-1">
        <div class="my-10 px-2 md:px-10 lg:px-32">


            <div class="bg-white shadow-sm">
                <h1 class="inline-block font-bold text-lg px-4 py-5 rounded shadow-sm w-full">Create Event</h1>


                <form action="{{ route('events.update', $event->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col p-4">
                        <label class="font-bold text-gray-500" for="">Event Name</label>
                        @error('name')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <input id="field1" oninput="copyFieldToSlug()" class="rounded-md border-gray-400" placeholder="Event Name" name="name" type="text" value={{ $event->name }}>
                    </div>

                    <div class="flex flex-col p-4">
                        <label class="font-bold text-gray-500" for="">Event Slug</label>
                        @error('slug')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <input id="slug" class="rounded-md border-gray-400" placeholder="Event Slug" name="slug" type="text" value={{ $event->slug }}>
                    </div>

                    <script>
                        function slugify(text) {
                          return text.toString().toLowerCase()
                            .replace(/\s+/g, '-')           // Replace spaces with -
                            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                            .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                            .replace(/^-+/, '')             // Trim - from start of text
                            .replace(/-+$/, '');            // Trim - from end of text
                        }
                    
                        function copyFieldToSlug() {
                          var field1Value = document.getElementById("field1").value;
                          var slugValue = slugify(field1Value);
                          document.getElementById("slug").value = slugValue;
                        }
                    </script>
                    
                    <div class="flex flex-col p-5">
                        <label class="font-bold text-gray-500" for="">Description</label>
                        @error('description')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <textarea class="rounded-md border-gray-400" name="description" placeholder="Description" type="text">{{ $event->description }}</textarea>
                    </div>
                    
                    <div class="flex flex-col p-5">
                        <label class="font-bold text-gray-500" for="">Event Category</label>

                        @error('category')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        <select class="rounded-md border-gray-400" name="cat_value" id="cat_value">
                            @foreach ($event_cat as $all_cat)
                                <option @selected($event->category->cat_name == $all_cat->cat_name) value="{{ $all_cat->id }}">{{ $all_cat->cat_name }}</option>
                            @endforeach
                        </select>
                        
                    </div>

                    <div class="flex flex-col p-5">
                        <label class="font-bold text-gray-500" for="">Photo</label>
                        <img class="w-24 h-24" src="{{ asset('uploads/event/'. $event->photo) }}" alt="">
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
                        <input class="rounded-md border-gray-400" name="location" type="text" value="{{ $event->location }}">
                    </div>


                    <div class="flex flex-col p-5">
                        <label class="font-bold text-gray-500" for="">Time</label>
                        @error('datetime')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <input type="datetime-local" id="datetime" name="datetime" value="{{ $event->start }}">
                    </div>

                    <div class="p-5">
                        <input class="bg-blue-500 text-white px-3 py-1 cursor-pointer rounded-md my-4" type="submit" value="Update">
                    </div>
                </form>
            </div>

        </div>
    </div>

</x-app-layout>
