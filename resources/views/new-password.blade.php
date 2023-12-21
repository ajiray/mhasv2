@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">
    <div class="container">
        <section class=" min-h-screen flex items-center justify-center">
            <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl">
                <div class="sm:w-3/5 px-16 relative p-10">
                    <a href="/login"
                        class="flex items-center text-gray-700 hover:text-blue-500 transition duration-300 ease-in-out absolute left-2 top-5">
                        <i class="fas fa-chevron-left fa-lg mr-1"></i>
                        <span class="text-sm">Back</span>
                    </a>
                    <div class="absolute left-0 right-0 top-0 text-center" id="alert">
                        @if ($errors->any())
                            <div class="col-12">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger bg-red-300 rounded-lg text-red-700 font-semibold shadow-md p-2 md:p-4 md:text-base text-center">{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div class="alert alert-danger bg-red-300 rounded-lg text-red-700 font-semibold shadow-md p-2 md:p-4 md:text-base text-center">{{ 'Password must have at least one uppercase letter, one lowercase letter, and one number.' }}</div>
                        @endif

                        @if (session()->has('success'))
                            <div class="alert alert-success bg-green-300 rounded-lg text-green-700 font-semibold shadow-md p-2 md:p-4 md:text-base text-center">{{ 'success' }}</div>
                        @endif
                    </div>
                    <img src="{{ asset('/images/logo.png') }}" alt="Logo" class="w-[150px] h-[130px] mx-auto">
                    <h1 class="font-bold text-maroon text-center text-xl">MindScape Reset Password</h1>
                    <br><br>

                    <p class="text-center">Fill up the fields to reset your password.</p>
                    <form method="POST" action="{{ route('resetPasswordPost') }}">
                        @csrf
                        <input type="text" name="token" hidden value="{{ $token }}">
                        <div class="text-center space-y-4 mt-2">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror ml-[5px] p-2 rounded-xl border"
                            name="password" required autocomplete="new-password" placeholder="Enter New Password">
                        <br>
                        <input id="password-confirm" type="password" class="form-control ml-[5px] p-2 rounded-xl border"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="Confirm Password">
                        <br>
                        <button class="border bg-maroon rounded-full w-full p-2 text-white hover:bg-red-800"
                            type="submit">{{ __('Reset Password') }}</button><br>
                            </div>
                    </form>
                </div>
                <div
                    class="sm:block hidden bg-gradient-to-b from-maroon via-maroon to-yellow w-[480px] h-[600px] rounded-2xl">
                    <div class="mt-10 text-center flex items-center justify-center">
                        <span class="text-white text-4xl font-bold" style="text-shadow: 0 0 10px #ffffff;">Mind</span>
                        <span class="text-yellow text-4xl font-bold" style="text-shadow: 0 0 10px #ecb222;">Scape</span>
                    </div>
                    <h1 class="text-center text-yellow font-bold text-xl mt-[130px]">University of Perpetual Help
                        System Dalta Las Pinas</h1>
                    <h1 class="text-center text-maroon font-bold text-xl mt-[130px]">Mental Health Awareness System</h1>
                </div>
            </div>
        </section>

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
