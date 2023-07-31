<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        @include('spinner')
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @include('layouts.footer')

        <script>
            // Function to hide the spinner
            function hideSpinner() {
                document.getElementById('spinner-overlay').style.display = 'none';
            }
    
            // Show the spinner
            document.getElementById('spinner-overlay').style.display = 'flex';
    
            // Function to hide the spinner after 3 seconds
            function hideSpinnerAfterTimeout() {
                hideSpinner();
                document.removeEventListener('DOMContentLoaded', hideSpinnerAfterTimeout);
            }
    
            // Call the hideSpinnerAfterTimeout function after 3 seconds
            setTimeout(hideSpinnerAfterTimeout, 3000);
    
            // Hide the spinner on DOMContentLoaded
            document.addEventListener('DOMContentLoaded', hideSpinnerAfterTimeout);
        </script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        {{-- icon --}}
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>
</html>
