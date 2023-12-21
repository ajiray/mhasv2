@extends('layouts.adminlayout')

@section('content')
    <div
        class="flex justify-center items-center h-full w-full flex-col space-y-10 pb-10 xl:pb-0 xl:space-y-0 xl:space-x-32 xl:flex-row">

        <!-- Registration Form -->
        <form action="/registerGuidance" method="post"
            class="bg-white shadow-md rounded-lg w-[80%] p-5 mt-5 xl:mt-0 xl:p-6 xl:w-[40%] relative">
            @if (session()->has('successs'))
                <div class="absolute top-5 left-0 right-0 flex items-center justify-center w-full p-4 md:w-96 md:p-6"
                    id="alert">
                    <div class="bg-green-300 rounded-lg text-green-700 font-semibold shadow-md p-2 md:p-4 md:text-base">
                        {{ session('successs') }}
                    </div>
                </div>
            @endif
            @csrf
            <h2 class="text-3xl font-bold mb-6 text-center">User Registration</h2>

            <div class="mb-4">
                <label for="fullname" class="block text-gray-700 font-bold mb-2">Full Name</label>
                <input type="text" name="fullname" id="fullname"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" required
                    autocomplete="off">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" required
                    autocomplete="off">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <!-- Hidden input for the value of 2 -->
            <input type="hidden" name="userType" value="2">

            <button type="submit"
                class="bg-adminPrimary text-white px-4 py-2 rounded-md hover:bg-sky-700 focus:outline-none focus:shadow-outline-blue active:bg-green-800 w-full mt-2">
                Register
            </button>
        </form>




    </div>

    <script>
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
