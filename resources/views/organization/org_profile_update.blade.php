<x-app-layout>
    <div class="max-w-screen-2xl m-auto p-1">
        <div class="my-10 px-2 md:px-10 lg:px-32">

            {{-- Status message --}}
            @if (session()->has('status'))
                <div class="bg-green-500 text-white py-2 px-10 my-5">{{ session('status') }}</div>
            @endif

            <div class="bg-white p-5 shadow rounded-md">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Orangization Information') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __("Update your organization's profile information and location.") }}
                </p>

                {{-- Update Form Here --}}
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col py-10 space-y-2">
                        <label class="font-bold text-gray-500">Organization Name</label>
                        @error('name')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <input class="rounded-md border-gray-400" type="text" name="name"
                            value="{{ $org->name }}">
                    </div>

                    <div class="flex flex-col space-y-2">
                        <label class="font-bold text-gray-500">Organization Description</label>
                        @error('description')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <textarea class="rounded-md border-gray-400" name="description" type="text">{{ $org->description }}</textarea>
                    </div>

                    <div class="flex flex-col py-10 space-y-2">
                        <label class="font-bold text-gray-500">Organization Location</label>
                        @error('location')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <input class="rounded-md border-gray-400" type="text" name="location"
                            value="{{ $org->location }}">
                    </div>


                    @if ($org->photo)
                        <img class="my-5 w-32 h-32" src="{{ asset('uploads/' . $org->photo) }}" alt="">
                    @endif

                    <div>
                        @error('photo')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <input type="file" name="photo">
                    </div>

            </div>

            <input class="bg-black text-white px-3 py-1 cursor-pointer rounded-md my-4" type="submit" value="Save">
            </form>
        </div>




    </div>
    </div>
</x-app-layout>
