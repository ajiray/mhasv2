@extends('layouts.layout')

@section('content')
    <style>
        .gradient {
            background-image: linear-gradient(55deg, rgba(208, 208, 208, 0.03) 0%, rgba(208, 208, 208, 0.03) 20%, rgba(55, 55, 55, 0.03) 20%, rgba(55, 55, 55, 0.03) 40%, rgba(81, 81, 81, 0.03) 40%, rgba(81, 81, 81, 0.03) 60%, rgba(208, 208, 208, 0.03) 60%, rgba(208, 208, 208, 0.03) 80%, rgba(191, 191, 191, 0.03) 80%, rgba(191, 191, 191, 0.03) 100%), linear-gradient(291deg, rgba(190, 190, 190, 0.02) 0%, rgba(190, 190, 190, 0.02) 14.286%, rgba(105, 105, 105, 0.02) 14.286%, rgba(105, 105, 105, 0.02) 28.572%, rgba(230, 230, 230, 0.02) 28.572%, rgba(230, 230, 230, 0.02) 42.858%, rgba(216, 216, 216, 0.02) 42.858%, rgba(216, 216, 216, 0.02) 57.144%, rgba(181, 181, 181, 0.02) 57.144%, rgba(181, 181, 181, 0.02) 71.42999999999999%, rgba(129, 129, 129, 0.02) 71.43%, rgba(129, 129, 129, 0.02) 85.71600000000001%, rgba(75, 75, 75, 0.02) 85.716%, rgba(75, 75, 75, 0.02) 100.002%), linear-gradient(32deg, rgba(212, 212, 212, 0.03) 0%, rgba(212, 212, 212, 0.03) 12.5%, rgba(223, 223, 223, 0.03) 12.5%, rgba(223, 223, 223, 0.03) 25%, rgba(11, 11, 11, 0.03) 25%, rgba(11, 11, 11, 0.03) 37.5%, rgba(86, 86, 86, 0.03) 37.5%, rgba(86, 86, 86, 0.03) 50%, rgba(106, 106, 106, 0.03) 50%, rgba(106, 106, 106, 0.03) 62.5%, rgba(220, 220, 220, 0.03) 62.5%, rgba(220, 220, 220, 0.03) 75%, rgba(91, 91, 91, 0.03) 75%, rgba(91, 91, 91, 0.03) 87.5%, rgba(216, 216, 216, 0.03) 87.5%, rgba(216, 216, 216, 0.03) 100%), linear-gradient(312deg, rgba(113, 113, 113, 0.01) 0%, rgba(113, 113, 113, 0.01) 14.286%, rgba(54, 54, 54, 0.01) 14.286%, rgba(54, 54, 54, 0.01) 28.572%, rgba(166, 166, 166, 0.01) 28.572%, rgba(166, 166, 166, 0.01) 42.858%, rgba(226, 226, 226, 0.01) 42.858%, rgba(226, 226, 226, 0.01) 57.144%, rgba(109, 109, 109, 0.01) 57.144%, rgba(109, 109, 109, 0.01) 71.42999999999999%, rgba(239, 239, 239, 0.01) 71.43%, rgba(239, 239, 239, 0.01) 85.71600000000001%, rgba(54, 54, 54, 0.01) 85.716%, rgba(54, 54, 54, 0.01) 100.002%), linear-gradient(22deg, rgba(77, 77, 77, 0.03) 0%, rgba(77, 77, 77, 0.03) 20%, rgba(235, 235, 235, 0.03) 20%, rgba(235, 235, 235, 0.03) 40%, rgba(215, 215, 215, 0.03) 40%, rgba(215, 215, 215, 0.03) 60%, rgba(181, 181, 181, 0.03) 60%, rgba(181, 181, 181, 0.03) 80%, rgba(193, 193, 193, 0.03) 80%, rgba(193, 193, 193, 0.03) 100%), linear-gradient(80deg, rgba(139, 139, 139, 0.02) 0%, rgba(139, 139, 139, 0.02) 14.286%, rgba(114, 114, 114, 0.02) 14.286%, rgba(114, 114, 114, 0.02) 28.572%, rgba(240, 240, 240, 0.02) 28.572%, rgba(240, 240, 240, 0.02) 42.858%, rgba(221, 221, 221, 0.02) 42.858%, rgba(221, 221, 221, 0.02) 57.144%, rgba(74, 74, 74, 0.02) 57.144%, rgba(74, 74, 74, 0.02) 71.42999999999999%, rgba(201, 201, 201, 0.02) 71.43%, rgba(201, 201, 201, 0.02) 85.71600000000001%, rgba(187, 187, 187, 0.02) 85.716%, rgba(187, 187, 187, 0.02) 100.002%), linear-gradient(257deg, rgba(72, 72, 72, 0.03) 0%, rgba(72, 72, 72, 0.03) 16.667%, rgba(138, 138, 138, 0.03) 16.667%, rgba(138, 138, 138, 0.03) 33.334%, rgba(54, 54, 54, 0.03) 33.334%, rgba(54, 54, 54, 0.03) 50.001000000000005%, rgba(161, 161, 161, 0.03) 50.001%, rgba(161, 161, 161, 0.03) 66.668%, rgba(17, 17, 17, 0.03) 66.668%, rgba(17, 17, 17, 0.03) 83.33500000000001%, rgba(230, 230, 230, 0.03) 83.335%, rgba(230, 230, 230, 0.03) 100.002%), linear-gradient(47deg, rgba(191, 191, 191, 0.01) 0%, rgba(191, 191, 191, 0.01) 16.667%, rgba(27, 27, 27, 0.01) 16.667%, rgba(27, 27, 27, 0.01) 33.334%, rgba(66, 66, 66, 0.01) 33.334%, rgba(66, 66, 66, 0.01) 50.001000000000005%, rgba(36, 36, 36, 0.01) 50.001%, rgba(36, 36, 36, 0.01) 66.668%, rgba(230, 230, 230, 0.01) 66.668%, rgba(230, 230, 230, 0.01) 83.33500000000001%, rgba(93, 93, 93, 0.01) 83.335%, rgba(93, 93, 93, 0.01) 100.002%), linear-gradient(90deg, #ffffff, #ffffff);
        }
    </style>
    <script>
        function confirmDeletePost(appointmentId) {
            if (confirm('Are you sure you want to cancel this appointment?')) {
                document.getElementById('delete-form-' + appointmentId).submit();
            } else {
                // Prevent form submission if the user cancels
                event.preventDefault(); // Add this line to prevent the default form submission
            }
        }

        function confirmUnderstand(appointmentId) {
            if (confirm('We encourage you to choose another suitable time.')) {
                document.getElementById('understand-form-' + appointmentId).submit();
            } else {
                // Prevent form submission if the user cancels
                event.preventDefault(); // Add this line to prevent the default form submission
            }
        }
        function confirmResched(appointmentId) {
            if (confirm('Are you sure you want to Resched this Appointment?')) {
                document.getElementById('reschedStudent-form-' + appointmentId).submit();
            } else {
                // Prevent form submission if the user cancels
                event.preventDefault(); // Add this line to prevent the default form submission
            }
        }

        function fadeOutAlert(alertId) {
            setTimeout(function() {
                var alert = document.getElementById(alertId);
                if (alert) {
                    alert.style.transition = "opacity 1s";
                    alert.style.opacity = 0;
                    setTimeout(function() {
                        alert.style.visibility = "hidden";
                    }, 1000);
                }
            }, 3000);
        }
        fadeOutAlert("alert");
    </script>


    <div class="flex justify-center items-center h-full relative ">

        <div
            class="flex flex-col md:flex-row sm:space-x-0 md:space-x-10 lg:space-x-10 w-full justify-center items-center h-full pb-10 pt-10">
            <!-- Alert Message -->
            <div class="absolute top-2 left-1/2 transform -translate-x-1/2 text-center">
                @if (session()->has('success'))
                    <div id="alert" class="bg-green-300 p-3 rounded-lg text-green-700 font-semibold shadow-md">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session()->has('delete'))
                    <div id="alert" class="bg-red-300 p-3 rounded-lg text-red-700 font-semibold shadow-md">
                        {{ session('delete') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div id="alert" class="bg-red-300 p-3 rounded-lg text-red-700 font-semibold shadow-md">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session()->has('understand'))
                    <div id="alert" class="bg-green-300 p-3 rounded-lg text-green-700 font-semibold shadow-md">
                        {{ session('understand') }}
                    </div>
                @endif

                @if (session()->has('one'))
                    <div id="alert" class="bg-red-300 p-3 rounded-lg text-red-700 font-semibold shadow-md">
                        {{ session('one') }}
                    </div>
                @endif
            </div>


            <!-- Left Column: Booking Form -->
            <div class="w-[80%] sm:w-[65%] md:w-[50%] lg:w-[40%] xl:w-[35%] mx-auto p-6 bg-white rounded shadow-md">
                <div class="border-b-2 border-black pb-4 mb-6">
                    <h2 class="text-4xl font-bold text-black text-center">Book Your Appointment</h2>
                </div>
                <form action="/book-appointment" method="POST" class="space-y-6">
                    @csrf

                    <div class="mb-6">
                        <label for="appointment_date" class="block text-gray-600">Appointment Date:</label>
                        <input type="date" name="appointment_date" id="appointment_date" min="<?php echo date('Y-m-d'); ?>"
                            class="w-full border border-gray-300 p-3 rounded focus:outline-none focus:ring focus:border-blue-500"
                            required>
                    </div>

                   <div class="mb-6">
                        <label for="appointment_time" class="block text-gray-600">Appointment Time:</label>
                        <select name="appointment_time" id="appointment_time"
                            class="w-full border border-gray-300 p-3 rounded focus:outline-none focus:ring focus:border-blue-500"
                            required>
                            <!-- JavaScript will populate the options here -->
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-600">Select Appointment Type:</label>
                        <div class="flex space-x-4">
                            <label for="online" class="flex items-center">
                                <input type="radio" name="appointment_type" id="online" value="Online" class="mr-2"
                                    required>
                                Online
                            </label>
                            <label for="onsite" class="flex items-center">
                                <input type="radio" name="appointment_type" id="onsite" value="Onsite" class="mr-2"
                                    required>
                                Onsite
                            </label>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="appointment_reason" class="block text-gray-600">Reason:</label>
                        <select name="appointment_reason" id="appointment_reason"
                            class="w-full border border-gray-300 p-3 rounded focus:outline-none focus:ring focus:border-blue-500"
                            onchange="handleReasonChange()" required>
                            <option value="" disabled selected>Select a reason</option>
                            <option value="Emotional Support">Emotional Support</option>
                            <option value="Academic Advising">Academic Advising</option>
                            <option value="Special Needs and Accommodations">Special Needs and Accommodations</option>
                            <option value="Extracurricular Activities">Extracurricular Activities</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div id="otherReasonContainer" class="mb-6" style="display: none;">
                        <label for="other_reason" class="block text-gray-600">Other Reason:</label>
                        <input type="text" name="other_reason" id="other_reason"
                            class="w-full border border-gray-300 p-3 rounded focus:outline-none focus:ring focus:border-blue-500">
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-500 text-white py-3 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
                        Book
                    </button>
                </form>
            </div>


            <!-- Right Column: Pending Appointments -->
            <div
                class="w-[80%] sm:w-[65%] md:w-[50%] lg:w-[40%] xl:w-[35%] p-4 gradient rounded shadow-md h-[70%] md:h-[70%] lg:h-[70%] overflow-y-auto mt-8 md:mt-0">
                <div class="border-b-2 border-black pb-4 mb-6">
                    <h2 class="text-4xl font-bold text-black text-center">Appointment</h2>
                </div>
                <ul class="space-y-4">
                    @foreach ($appointments as $appointment)
                        @auth
                            @if (auth()->user()->id === $appointment->user->id)
                                @php
                                    $currentDateTime = \Carbon\Carbon::now();
                                    $meetingDateTime = \Carbon\Carbon::parse($appointment->date . ' ' . $appointment->time);
                                    $timeDiff = $currentDateTime->diff($meetingDateTime);
                                    $daysLeft = $timeDiff->days;
                                    $hoursLeft = $timeDiff->h;
                                    $minutesLeft = $timeDiff->i;
                                    $secondsLeft = $timeDiff->s;
                                    $daysLabel = $daysLeft === 1 ? 'day' : 'days';
                                    $hoursLabel = $hoursLeft === 1 ? 'hour' : 'hours';
                                    $minutesLabel = $minutesLeft === 1 ? 'minute' : 'minutes';
                                    $secondsLabel = $secondsLeft === 1 ? 'second' : 'seconds';
                                @endphp

                                <div class="mb-4 bg-gray-100 border border-gray-300 rounded p-4">
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-lg font-semibold">{{ $appointment->reason }}</h3>
                                        @if ($appointment->status === 'approved')
                                            <form action="/reschedStudent/{{ $appointment->id }}" method="POST"
                                                id="reschedStudent-form-{{ $appointment->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="confirmResched({{ $appointment->id }})"><i
                                                        class="fa-regular fa-calendar fa-xl cursor-pointer"></i></button>
                                            </form>
                                        @endif
                                    </div>
                                    @if ($currentDateTime > $meetingDateTime && $appointment->status === 'approved')
                                        <p class="text-gray-600 font-bold">Meeting should start now</p>
                                        <form action="/contactCounselor/{{ $appointment->id }}" method="POST">
                                            @csrf
                                            <button
                                                class="text-amber-600 bg-amber-200 px-4 py-2 rounded-xl hover:bg-amber-300 font-semibold hover:text-white hover:no-underline mt-2 w-full">
                                                Contact Counselor
                                            </button>
                                        </form>
                                    @else
                                        <p class="text-gray-600">Date:
                                            {{ \Carbon\Carbon::parse($appointment->date)->format('F j, Y') }}</p>
                                        <p class="text-gray-600">Time:
                                            {{ \Carbon\Carbon::parse($appointment->time)->format('h:i:s A') }}</p>
                                        <p class="text-gray-600">Type: {{ $appointment->type }}</p>

                                        <p class="text-gray-600">Counselor:
                                            @if ($appointment->counselor)
                                                {{ $appointment->counselor->name }}
                                            @else
                                                Not yet assigned
                                            @endif
                                        </p>



                                        @if ($appointment->status === 'waiting for approval')
                                            <p class="text-gray-600">
                                                <span class="text-gray-600">Status:</span>
                                                <span style="color: orange">
                                                    {{ $appointment->status }}
                                                </span>
                                            </p>
                                        @elseif ($appointment->status === 'approved')
                                            <p class="text-gray-600">
                                                <span class="text-gray-600">Status:</span>
                                                <span style="color: green">
                                                    {{ $appointment->status }}
                                                </span>
                                            </p>
                                        @else
                                            <p class="text-gray-600">
                                                <span class="text-gray-600">Status:</span>
                                                <span style="color: red">
                                                    {{ $appointment->status }}
                                                </span>
                                            </p>

                                            <button onclick="confirmUnderstand('{{ $appointment->id }}')"
                                                class="text-amber-700 px-4 py-2 rounded-xl bg-amber-100 hover:bg-amber-200 font-semibold hover:text-white hover:no-underline mt-2 w-full">
                                                I understand
                                            </button>
                                            <form id="understand-form-{{ $appointment->id }}"
                                                action="/understand-appointment/{{ $appointment->id }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif

                                        @if ($appointment->status === 'approved')
                                            <p class="text-gray-600">
                                                Meeting starts in
                                                @if ($daysLeft > 0)
                                                    {{ $daysLeft }} {{ $daysLabel }},
                                                @endif
                                                @if ($hoursLeft > 0)
                                                    {{ $hoursLeft }} {{ $hoursLabel }},
                                                @endif
                                                @if ($minutesLeft > 0)
                                                    {{ $minutesLeft }} {{ $minutesLabel }},
                                                @endif
                                                @if ($secondsLeft > 0)
                                                    {{ $secondsLeft }} {{ $secondsLabel }}
                                                @endif
                                            </p>
                                        @endif
                                        @if ($appointment->status === 'waiting for approval')
                                            <button onclick="confirmDeletePost('{{ $appointment->id }}')"
                                                class="text-red-700 px-4 py-2 rounded-xl bg-red-100 hover:bg-red-200 font-semibold hover:text-white hover:no-underline mt-2 w-full">
                                                Cancel
                                            </button>
                                            <form id="delete-form-{{ $appointment->id }}"
                                                action="/cancel-appointment/{{ $appointment->id }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            @endif
                        @endauth
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <script>
        function handleReasonChange() {
            var select = document.getElementById('appointment_reason');
            var otherReasonContainer = document.getElementById('otherReasonContainer');
            var otherReasonInput = document.getElementById('other_reason');

            if (select.value === 'Other') {
                otherReasonContainer.style.display = 'block';
                otherReasonInput.required = true;
            } else {
                otherReasonContainer.style.display = 'none';
                otherReasonInput.required = false;
            }
        }
        
        document.addEventListener("DOMContentLoaded", function() {
            // Example: List of booked times from the database
            const bookedTimes = @json($bookedTimes);
            const numberOfCounselors = @json($numberOfCounselors);

            // Function to populate the dropdown with available times
            function populateDropdown() {
                const dropdown = document.getElementById("appointment_time");
                const dateInput = document.getElementById("appointment_date");
                const selectedDate = dateInput.value;

                for (let hour = 8; hour <= 16; hour++) { // Updated to limit until 4:30 PM
                    for (let minute of ["00", "30"]) {
                        const time = `${hour.toString().padStart(2, '0')}:${minute}:00`;
                        const datetime = `${selectedDate} ${time}`;

                        // Skip lunchtime options (12 PM to 1 PM)
                        if (hour === 12 && minute === "00") continue;
                        if (hour === 12 && minute === "30") continue;

                        const option = document.createElement("option");
                        option.value = time;
                        option.text = `${hour > 12 ? hour - 12 : hour}:${minute} ${hour >= 12 ? 'PM' : 'AM'}`;

                        // Disable the option if it's booked
                        const bookedCount = bookedTimes.filter(bookedTime => bookedTime === datetime).length;
                        if (bookedCount >= numberOfCounselors) {
                            option.disabled = true;
                        }

                        dropdown.add(option);
                    }
                }
            }

            // Call the function to populate the dropdown
            populateDropdown();

            // Add an event listener to the date input to repopulate the dropdown when the date changes
            document.getElementById("appointment_date").addEventListener("change", function() {
                // Remove existing options
                const dropdown = document.getElementById("appointment_time");
                while (dropdown.options.length > 0) {
                    dropdown.remove(0);
                }

                // Repopulate the dropdown
                populateDropdown();
            });
        });
    </script>
@endsection
