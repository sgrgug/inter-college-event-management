<x-app-layout>
    <div class="max-w-screen-2xl m-auto p-1">
        <div class="my-10 px-2 md:px-10 lg:px-32">

            @if (session('status'))
                <div class="bg-green-500 text-white p-2 rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white shadow-sm">
                <h1 class="inline-block font-bold text-lg px-4 py-5 rounded shadow-sm w-full">Create Event</h1>
                <div class="px-4 py-5">
                    <b class="text-red-600">Note:</b><span> You have </span><b class="text-green-600">{{ $org->noofcreation }}</b><span></span> times to create events.</span>
                    <div class="text-blue-500 hover:text-blue-700">
                        <a href="{{ route('proSubscription') }}">Click here to buy pro subscription!</a>
                    </div>
                </div>

                <form action="{{ route('events.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col p-4">
                        <label class="font-bold text-gray-500" for="">Event Name</label>
                        @error('name')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <input @disabled($org->noofcreation <= 0) id="field1" oninput="copyFieldToSlug()" class="rounded-md border-gray-400 {{ $org->noofcreation <= 0 ? 'bg-zinc-200' : '' }}" placeholder="Event Name" name="name" type="text" value={{ old('name') }}>
                    </div>

                    <div class="flex flex-col p-4">
                        <label class="font-bold text-gray-500" for="">Event Slug</label>
                        @error('slug')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <input @disabled($org->noofcreation <= 0) id="slug" class="rounded-md border-gray-400 {{ $org->noofcreation <= 0 ? 'bg-zinc-200' : '' }}" placeholder="Event Slug" name="slug" type="text" value={{ old('slug') }}>
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
                        <textarea @disabled($org->noofcreation <= 0) class="rounded-md border-gray-400 {{ $org->noofcreation <= 0 ? 'bg-zinc-200' : '' }}" name="description" placeholder="Description" type="text">{{ old('description') }}</textarea>
                    </div>
                    
                    <div class="flex flex-col p-5">
                        <label class="font-bold text-gray-500" for="">Event Category</label>

                        @error('category')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <select @disabled($org->noofcreation <= 0) class="rounded-md border-gray-400 {{ $org->noofcreation <= 0 ? 'bg-zinc-200' : '' }}" name="cat_value" id="cat_value">
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
                        <input @disabled($org->noofcreation <= 0) type="file" name="photo">
                    </div>
                    
                    <div class="flex flex-col p-5">
                        <label class="font-bold text-gray-500" for="">Location</label>
                        @error('location')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <input @disabled($org->noofcreation <= 0) class="rounded-md border-gray-400 {{ $org->noofcreation <= 0 ? 'bg-zinc-200' : '' }}" name="location" type="text" value="{{ old('location') }}">
                    </div>


                    <div class="flex flex-col p-5">
                        <label class="font-bold text-gray-500" for="">Time</label>
                        @error('datetime')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <input @disabled($org->noofcreation <= 0) class="{{ $org->noofcreation <= 0 ? 'bg-zinc-200' : '' }}" type="datetime-local" id="datetime" name="datetime" value="{{ old('datetime') }}">
                    </div>

                    <div class="p-5">
                        <input @disabled($org->noofcreation <= 0) class="bg-blue-500 text-white px-3 py-1 cursor-pointer rounded-md my-4 {{ $org->noofcreation <= 0 ? 'bg-zinc-200' : '' }}" type="submit" value="Save">
                    </div>
                </form>
            </div>

        </div>
    </div>

</x-app-layout>
