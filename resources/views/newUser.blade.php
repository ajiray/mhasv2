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

            <select name="category" id="category" class="border p-2 w-full mb-4" onchange="toggleInputs()">
                <option value="" disabled selected>Select Type of User</option>
                <option value="student">Student</option>
                <option value="counselor">Counselor</option>
                <option value="admin">Admin</option>
            </select>
            <div class="mb-4 hidden" id="funame">
                <label for="fullname" class="block text-gray-700 font-bold mb-2">Full Name</label>
                <input type="text" name="fullname" id="fullname"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" autocomplete="off"
                    required>
            </div>

            <div class="mb-4 hidden" id="mail">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" autocomplete="off"
                    required>
            </div>

            <div class="mb-4 hidden" id="pword">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" required>
            </div>

            <div class="mb-4 hidden" id="fName">
                <label for="firstname" class="block text-gray-700 font-bold mb-2">First Name</label>
                <input type="text" name="firstname" id="firstname"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" autocomplete="off"
                    required>
            </div>
            <div class="mb-4 hidden" id="mName">
                <label for="middlename" class="block text-gray-700 font-bold mb-2">Middle Name</label>
                <input type="text" name="middlename" id="middlename"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" autocomplete="off">
            </div>
            <div class="mb-4 hidden" id="lName">
                <label for="lastname" class="block text-gray-700 font-bold mb-2">Last Name</label>
                <input type="text" name="lastname" id="lastname"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" autocomplete="off"
                    required>
            </div>
            <div class="mb-4 hidden" id="sNum">
                <label for="studnum" class="block text-gray-700 font-bold mb-2">Student Number</label>
                <input type="text" name="studnum" id="studnum"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" autocomplete="off"
                    required>
            </div>
            <div class="mb-4 hidden" id="program">
                <select id="course" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500"
                    name="course" required>
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
                    <option value="BS in Human Resource Development Management">BS in Human Resource Development Management
                    </option>
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
                    <option value="Bachelor in Early Childhood Education">Bachelor in Early Childhood Education</option>
                    <option value="Bachelor of Elementary Education">Bachelor of Elementary Education</option>
                    <option value="Bachelor of Physical Education">Bachelor of Physical Education</option>
                    <option value="Bachelor of Secondary Education">Bachelor of Secondary Education</option>
                    <option value="Bachelor of Special Needs Education">Bachelor of Special Needs Education</option>
                    <option value="Teacher Certificate Program">Teacher Certificate Program</option>
                </select>
            </div>

            <input type="hidden" name="userType" id="userType" value="">

            <button type="submit"
                class="bg-adminPrimary text-white px-4 py-2 rounded-md hover:bg-sky-700 focus:outline-none focus:shadow-outline-blue active:bg-green-800 w-full mt-2 hidden"
                id="register">
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

        function toggleInputs() {
            var category = document.getElementById('category').value;
            var funame = document.getElementById('funame');
            var mail = document.getElementById('mail');
            var pword = document.getElementById('pword');
            var program = document.getElementById('program');
            var mName = document.getElementById('mName');
            var fName = document.getElementById('fName');
            var lName = document.getElementById('lName');
            var sNum = document.getElementById('sNum');
            var register = document.getElementById('register');
            var userType = document.getElementById('userType');

            var fullname = document.getElementById('fullname');
            var password = document.getElementById('password');
            var firstname = document.getElementById('firstname');
            var lastname = document.getElementById('lastname');
            var studnum = document.getElementById('studnum');
            var course = document.getElementById('course');

            if (category === 'counselor' || category === 'admin') {
                funame.style.display = 'block';
                mail.style.display = 'block';
                pword.style.display = 'block';
                program.style.display = 'none';
                fName.style.display = 'none';
                lName.style.display = 'none';
                mName.style.display = 'none';
                sNum.style.display = 'none';
                register.style.display = 'block';
                firstname.removeAttribute('required');
                lastname.removeAttribute('required');
                studnum.removeAttribute('required');
                course.removeAttribute('required');
                fullname.setAttribute('required', 'required');
                password.setAttribute('required', 'required');

                userType.value = category === 'admin' ? 1 : 2;

            } else if (category === 'student') {
                fullname.removeAttribute('required');
                password.removeAttribute('required');
                firstname.setAttribute('required', 'required');
                lastname.setAttribute('required', 'required');
                studnum.setAttribute('required', 'required');
                course.setAttribute('required', 'required');

                funame.style.display = 'none';
                pword.style.display = 'none';
                mail.style.display = 'block';
                program.style.display = 'block';
                fName.style.display = 'block';
                lName.style.display = 'block';
                mName.style.display = 'block';
                sNum.style.display = 'block';
                register.style.display = 'block';
                userType.value = 0;
            }
        }
    </script>
@endsection
