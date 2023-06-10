<x-app-layout>
    <div class="max-w-screen-2xl m-auto p-1">
        <div class="my-10 px-2 md:px-10 lg:px-32">

            <div class="bg-white p-5 shadow rounded-md">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Orangizatio Information') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __("Update your organization's profile information and location.") }}
                </p>

                {{-- Update Form Here --}}
                <form action="" method="post">
                    @csrf
                    <div class="flex flex-col py-10 space-y-2">
                        <label class="font-bold text-gray-500">Organization Name</label>
                        <input class="rounded-md border-gray-400" type="text" value="{{ $org->name }}">
                    </div>

                    <div class="flex flex-col space-y-2">
                        <label class="font-bold text-gray-500">Organization Description</label>
                        <textarea class="rounded-md border-gray-400" type="text">{{ $org->description }}</textarea>
                    </div>

                    <input class="bg-black text-white px-3 py-1 cursor-pointer rounded-md my-4" type="submit" value="Save">

                </form>

            </div>




        </div>
    </div>
</x-app-layout>
