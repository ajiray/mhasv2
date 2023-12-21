@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">
    <div class="container">
        <section class="min-h-screen flex items-center justify-center">
            <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl">
                <div class="sm:w-3/5 px-16 relative p-10">
                    <a href="/"
                        class="flex items-center text-gray-700 hover:text-blue-500 transition duration-300 ease-in-out absolute left-2 top-5">
                        <i class="fas fa-chevron-left fa-lg mr-1"></i>
                        <span class="text-sm">Back</span>
                    </a>
                    <img src="{{ asset('/images/logo.png') }}" alt="Logo" class="w-[150px] h-[130px] mx-auto">
                    <h1 class="font-bold text-maroon text-center text-xl">Login</h1>
                    <br>
                    <div class="absolute top-0 right-0 left-0">
                        @if (session('status'))
                            <div id="alert" class="bg-red-900 text-white p-5 rounded-xl text-center">
                                {{ 'Error Login Credentials' }}
                            </div>

                            <br>
                        @endif
                        @if (session('success'))
                            <div id="alert" class="bg-green-900 text-white p-5 rounded-xl text-center">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="">
                        @csrf

                        <div class="mb-4">
                            <input id="login_identifier" type="text" class="form-control p-2 rounded-xl border w-full"
                                   name="login_identifier" value="{{ old('login_identifier') }}" required
                                   placeholder="Email(Admin) or Student Number">
                        </div>
                        
                        <div class="password-container relative mb-4">
                            <input id="password" type="password" class="form-control p-2 rounded-xl border w-full"
                                name="password" required autocomplete="new-password" placeholder="Password">
                            <span class="toggle-password absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer"
                                onclick="togglePassword()">
                                <img src="{{ asset('/images/show-password.png') }}" alt="Show Password" class="w-6 h-6">
                            </span>
                        </div>
                        <button class="border bg-maroon rounded-2xl w-full text-white py-2"
                            type="submit">{{ __('Login') }}</button>
                        <a href="{{ url('/forget-password') }}"
                            class="text-[13px] hover:underline text-center mt-2 text-maroon block">Forgot password?</a>
                    </form>
                </div>
                <div
                    class="sm:block hidden bg-gradient-to-b from-maroon via-maroon to-yellow w-[480px] h-[500px] rounded-2xl">
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
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            var eyeIcon = document.querySelector(".toggle-password img");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.src = "{{ asset('/images/hide-password.png') }}";
            } else {
                passwordInput.type = "password";
                eyeIcon.src = "{{ asset('/images/show-password.png') }}";
            }
        }

        function fadeOutAlert(alertId) {
            setTimeout(function() {
                var alert = document.getElementById(alertId);
                if (alert) {
                    alert.style.transition = "opacity 1s";
                    alert.style.opacity = 0;
                    setTimeout(function() {
                        alert.style.display = "none";
                    }, 1300);
                }
            }, 2500); // 2500 milliseconds (2.5 seconds)
        }

        // Call the fadeOutAlert function for each alert message
        fadeOutAlert("alert");
    </script>
@endsection
