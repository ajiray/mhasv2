@extends('layouts.adminlayout')

@section('content')
    <div class="flex justify-center h-20 items-center mt-5 relative">

        <x-woymAdmin />

        @if (session()->has('success'))
            <div class="absolute top-0 left-0 mt-5 ml-10 sm:ml-20 md:ml-32" id="alert">
                <div class="bg-green-300 p-3 rounded-lg text-green-700 font-semibold shadow-md">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session()->has('delete'))
            <div class="absolute top-0 right-0 mt-5 mr-10 sm:mr-20 md:mr-32" id="alert">
                <div class="bg-red-300 p-3 rounded-lg text-red-700 font-semibold shadow-md">
                    {{ session('delete') }}
                </div>
            </div>
        @endif

        @if (session()->has('profanity'))
            <div class="absolute top-0 left-0 flex items-center justify-center w-full p-4 md:w-96 md:p-6" id="alert">
                <div class="bg-red-300 rounded-lg text-red-700 font-semibold shadow-md p-2 md:p-4 md:text-base">
                    {{ session('profanity') }}
                </div>
            </div>
        @endif

    </div>

    <div class="flex flex-row flex-wrap justify-center sm:gap-x-16 md:gap-x-16 xl:gap-x-16 mb-20">
        <x-adminfeed :posts="$posts" />
    </div>

    <script>
        // Function to automatically fade out alert messages after 3 seconds
        function fadeOutAlert(alertId) {
            setTimeout(function() {
                var alert = document.getElementById(alertId);
                if (alert) {
                    alert.style.transition = "opacity 1s";
                    alert.style.opacity = 0;
                    setTimeout(function() {
                        alert.style.display = "none";
                    }, 1000);
                }
            }, 2500); // 2500 milliseconds (2.5 seconds)
        }

        // Call the fadeOutAlert function for each alert message
        fadeOutAlert("alert");
    </script>
@endsection
