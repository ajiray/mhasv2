@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">

    <div class="container">
        <section class="min-h-screen flex items-center justify-center">
            <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl">
                <div class="sm:w-3/5 px-16 relative">
                    <a href="/login"
                        class="flex items-center text-gray-700 hover:text-blue-500 transition duration-300 ease-in-out absolute left-2 top-5">
                        <i class="fas fa-chevron-left fa-lg mr-1"></i>
                        <span class="text-sm">Back</span>
                    </a>
                    <img src="{{ asset('/images/logo.png') }}" alt="Logo" class="w-[150px] h-[130px] mx-auto">
                    <h1 class="font-bold text-maroon text-center text-xl">MindScape Reset Password</h1>
                    <br><br>
                    <div class="absolute top-0 right-0 left-0">
                        @if ($errors->any())
                            <div class="col-12">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger bg-red-300 rounded-lg text-red-700 font-semibold shadow-md p-2 md:p-4 md:text-base text-center" id="alert">{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div class="alert alert-danger bg-green-300 rounded-lg text-green-700 font-semibold shadow-md p-2 md:p-4 md:text-base" id="alert">{{ 'error' }}</div>
                        @endif

                        @if (session()->has('success'))
                            <div class="alert alert-success text-center bg-green-300 rounded-lg text-green-700 font-semibold shadow-md p-2 md:p-4 md:text-base" id="alert">
                                {{ 'We have successfully sent the link to your email account.' }}</div>
                        @endif
                    </div>
                    <p class="text-center">We will send a link to your email, use that link to reset your password.</p>
                    <form method="POST" action="{{ route('forget.password.post') }}">
                        @csrf
                        <div class="mr-auto ml-auto text-center mt-2">
                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror ml-[5px] p-2 rounded-xl border"
                            name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                            </div>
                        <br>
                        <br>
                        <button class=" border bg-maroon rounded-full text-white p-2 w-full hover:bg-red-800"
                            type="submit">{{ __('Send Email Link') }}</button><br>
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
        // Function to automatically fade out alert messages after 3 seconds
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
