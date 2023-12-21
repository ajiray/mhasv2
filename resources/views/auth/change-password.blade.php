@extends('layouts.app')

@section('content')
    @vite('resources/css/app.css')
    <div class="container">
        <section class=" min-h-screen flex items-center justify-center">
            <div class=" flex rounded-2xl shadow-lg max-w-3xl">
                <div class="sm:w-3/5 px-16 relative pt-5 pb-5 xl:pb-0 xl:pt-0">
                    @if ($errors->has('new_password'))
                        <span
                            class="bg-red-300 rounded-lg text-red-700 font-semibold shadow-md p-2 md:p-4 absolute left-0 right-0 top-4 text-center"
                            id="alert">{{ $errors->first('new_password') }}</span>
                    @endif

                    <img src="{{ asset('/images/logo.png') }}" alt="Logo" class="w-[150px] h-[130px] mx-auto">
                    <h1 class="font-bold text-maroon text-center text-xl">MindScape</h1>
                    <h1 class="font-bold text-black text-center text-xl">Create your new own password</h1>

                    <form method="POST" action="{{ route('password.change') }}" class="space-y-4">
                        @csrf

                        <br>
                        <input id="new_password" type="password"
                            class="form-control @error('new_password') is-invalid @enderror ml-[5px] p-2 rounded-xl border w-full"
                            name="new_password" required autocomplete="email" placeholder="New Password">

                        <br>
                        <input id="new_password_confirmation" type="password"
                            class="form-control ml-[5px] p-2 rounded-xl border w-full" name="new_password_confirmation"
                            required autocomplete="course" placeholder="Confirm New Password">
                        <br>
                        <button class="border bg-maroon rounded-full w-full p-2 text-white hover:bg-red-800"
                            type="submit">{{ __('Submit') }}</button><br>
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
                    }, 4000);
                }
            }, 4000); // 2500 milliseconds (2.5 seconds)
        }

        // Call the fadeOutAlert function for each alert message
        fadeOutAlert("alert");
    </script>
@endsection
