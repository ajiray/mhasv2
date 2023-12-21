@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @vite('resources/css/app.css')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .gradient {
            background-image: radial-gradient(circle farthest-corner at 10% 20%, rgba(147, 67, 67, 1) 0%, rgba(111, 27, 27, 1) 90%);
        }
        }
    </style>


    <div class="flex w-screen h-screen items-center justify-center overflow-hidden p-4">

        @if (session('registration_success'))
            <div class="absolute right-0 left-1/2 transform -translate-x-1/2 top-10 flex items-center justify-center w-full p-4 md:w-96 md:p-6"
                id="alert">
                <div class="bg-green-300 rounded-lg text-green-700 font-semibold shadow-md p-2 md:p-4 md:text-base">
                    {{ session('registration_success') }}
                </div>
            </div>
        @endif
        @if (session('registration_failed'))
            <div class="absolute right-0 left-1/2 transform -translate-x-1/2 top-10  flex items-center justify-center w-full p-4 md:w-96 md:p-6"
                id="alert">
                <div class="bg-red-300 rounded-lg text-red-700 font-semibold shadow-md p-2 md:p-4 md:text-base">
                    {{ session('registration_failed') }}
                </div>
            </div>
        @endif

        <div class="bg-gray-100 flex rounded-2xl shadow-lg w-full sm:max-w-3xl relative">
            <i class="fa-solid fa-circle-info fa-lg absolute right-3 top-5 text-white cursor-pointer"
                onclick="toggleInfo()"></i>

            <div class="w-full h-full p-8 gradient rounded-lg shadow-md hidden absolute right-0 left-0 animate__animated z-10"
                id="info">
                <button class="material-symbols-outlined absolute top-4 right-4 text-gray-600" onclick="closeInfo()">
                    <i class="fa-solid fa-x fa-lg text-white"></i>
                </button>

                <h1 class="text-3xl font-bold text-white mb-4 text-center">Instructions</h1>

                <ol class="list-decimal pl-4 text-white font-medium text-2xl tracking-widest">
                    <li class="mb-2">Complete the registration form with all your details.</li>
                    <li class="mb-2">Mindscape will assess your eligibility and review your registration.</li>
                    <li class="mb-2">Once approved, Mindscape will send you a temporary password via email.</li>
                    <li>Log in using the provided temporary password and proceed to change it once successfully logged in.
                    </li>
                </ol>

            </div>
            <div class="w-full sm:w-[50%] px-16 relative">


                <a href="/"
                    class="flex items-center text-gray-700 hover:text-blue-500 transition duration-300 ease-in-out absolute left-2 top-5 no-underline">
                    <i class="fas fa-chevron-left fa-lg mr-1"></i>
                    <span class="text-sm">Back</span>
                </a>
                <h1 class="font-bold text-maroon text-center text-xl mt-3">SIGN UP</h1>

                <form method="POST" action="{{ route('register') }}" class="flex flex-col">
                    @csrf
                    <input id="name" type="text"
                        class="@error('name') is-invalid @enderror ml-[5px] p-2 px-2 rounded-xl border mt-1" name="name"
                        value="{{ old('name') }}" required autofocus placeholder="Full Name" autocomplete="off">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <input id="email" type="email"
                        class="@error('email') is-invalid @enderror ml-[5px] p-2 rounded-xl border" name="email"
                        value="{{ old('email') }}" required autocomplete="off" placeholder="Email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <input id="student_number" type="text" class="ml-[5px] p-2 rounded-xl border" name="student_number"
                        required autocomplete="off" placeholder="Student Number">
                    <br>
                    <select id="course" class="ml-[5px] p-2 rounded-xl border" name="course" required>
                        <option value="" disabled selected>Select a Program</option>
                        <option value="BS in Architecture">BS in Architecture</option>
                        <option value="AB in Communication">AB in Communication</option>
                        <option value="AB in Multimedia Arts">AB in Multimedia Arts</option>
                        <option value="AB in Political Science">AB in Political Science</option>
                        <option value="AB in Psychology">AB in Psychology</option>
                        <option value="BS in Psychology">BS in Psychology</option>
                        <option value="Aircraft Maintenance Technology">Aircraft Maintenance Technology</option>
                        <option value="Aviation Electronics Technology">Aviation Electronics Technology</option>
                        <option value="BS in Aircraft Maintenance Technology">BS in Aircraft Maintenance Technology</option>
                        <option value="BS in Aviation Electronics Technology">BS in Aviation Electronics Technology</option>
                        <option value="BS in Accountancy">BS in Accountancy</option>
                        <option value="BS in Business Administration Major in Human Resource Management">BS in Business
                            Administration Major in Human Resource Management</option>
                        <option value="BS in Business Administration Major in Marketing Management">BS in Business
                            Administration Major in Marketing Management</option>
                        <option value="BS in Entrepreneurship">BS in Entrepreneurship</option>
                        <option value="BS in Criminology">BS in Criminology</option>
                        <option value="BS in Aeronautical Engineering">BS in Aeronautical Engineering</option>
                        <option value="BS in Civil Engineering">BS in Civil Engineering</option>
                        <option value="BS in Computer Engineering">BS in Computer Engineering</option>
                        <option value="BS in Electrical Engineering">BS in Electrical Engineering</option>
                        <option value="BS in Electronics Engineering">BS in Electronics Engineering</option>
                        <option value="BS in Industrial Engineering">BS in Industrial Engineering</option>
                        <option value="BS in Mechanical Engineering">BS in Mechanical Engineering</option>
                        <option value="BS in Hospotality Management">BS in Hospotality Management</option>
                        <option value="BS in Human Resource Development Management">BS in Human Resource Development
                            Management</option>
                        <option value="BS in Marketing Management">BS in Marketing Management</option>
                        <option value="BS in Computer Science">BS in Computer Science</option>
                        <option value="BS in Information Technology">BS in Information Technology</option>
                        <option value="BS in Tourism Management">BS in Tourism Management</option>
                        <option value="BS in Marine Engineering">BS in Marine Engineering</option>
                        <option value="BS in Marine Transportation">BS in Marine Transportation</option>
                        <option value="BS in Naval Architecture and Marine Engineering">BS in Naval Architecture and Marine
                            Engineering</option>
                        <option value="BS in Medical Technology">BS in Medical Technology</option>
                        <option value="BS in Nursing">BS in Nursing</option>
                        <option value="BS in Occupational Therapy">BS in Occupational Therapy</option>
                        <option value="BS in Pharmacy">BS in Pharmacy</option>
                        <option value="BS in Physical Therapy">BS in Physical Therapy</option>
                        <option value="BS in Radiologic Technology">BS in Radiologic Technology</option>
                        <option value="BS in Respiratory Therapy">BS in Respiratory Therapy</option>
                        <option value="Doctor of Dental Medicine">Doctor of Dental Medicine</option>
                        <option value="Bachelor in Early Childhood Education">Bachelor in Early Childhood Education
                        </option>
                        <option value="Bachelor of Elementary Education">Bachelor of Elementary Education</option>
                        <option value="Bachelor of Physical Education">Bachelor of Physical Education</option>
                        <option value="Bachelor of Secondary Education">Bachelor of Secondary Education</option>
                        <option value="Bachelor of Special Needs Education">Bachelor of Special Needs Education</option>
                        <option value="Teacher Certificate Program">Teacher Certificate Program</option>
                    </select>

                    <br>

                    <label for="birthday" class="ml-2">Birthday</label>
                    <input id="birthday" type="date" class="ml-[5px] p-2 rounded-xl border" name="birthday" required
                        autocomplete="off">


                    <br>
                    <button class="border bg-maroon rounded-full text-white font-medium text-md w-full p-2"
                        type="submit">{{ __('Register') }}</button><br>

                    <div class="flex items-center w-full">
                        <input type="checkbox" id="agreeTerms" name="agreeTerms"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" required>
                        <p for="agreeTerms" class="ml-2 text-sm text-gray-700">I agree to the <a href="/terms"
                                class="ml-1 text-sm text-indigo-600 hover:underline">Terms and Conditions</a></p>

                    </div>
                </form>
            </div>
            <div class="sm:block hidden bg-gradient-to-b from-maroon via-maroon to-yellow w-[480px] h-[550px] rounded-2xl">

                <div class="mt-10 text-center flex items-center justify-center">
                    <span class="text-white text-4xl font-bold" style="text-shadow: 0 0 10px #ffffff;">Mind</span>
                    <span class="text-yellow text-4xl font-bold" style="text-shadow: 0 0 10px #ecb222;">Scape</span>
                </div>
                <h1 class="text-center text-yellow font-bold text-xl mt-[130px]">University of Perpetual Help
                    System Dalta Las Pinas</h1>
                <h1 class="text-center text-maroon font-bold text-xl mt-[130px]">Mental Health Awareness System</h1>
            </div>


        </div>



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

        function toggleInfo(event) {

            var mobileInfo = document.getElementById("info");
            mobileInfo.classList.toggle("hidden");
            mobileInfo.classList.add("animate__fadeInUp");
        }

        function closeInfo(event) {
            var mobileInfo = document.getElementById("info");

            // Add the slide-out animation class
            mobileInfo.classList.add("animate__fadeOutDown");

            // Remove the slide-in animation class
            mobileInfo.classList.remove("animate__fadeInUp");

            // After the animation is complete, hide the options and reset classes
            setTimeout(function() {
                mobileInfo.classList.add("hidden");
                mobileInfo.classList.remove("animate__fadeOutDown");
            }, 800); // Adjust the timeout based on your animation duration

            // Stop event propagation

        }
    </script>
@endsection
