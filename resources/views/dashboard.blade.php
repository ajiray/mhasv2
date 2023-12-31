@extends('layouts.layout')

@section('content')
    <script>
        function openModal(name, date, time, location, description) {
            document.getElementById('modalOverlay').style.display = 'block';
            document.getElementById('eventModal').style.display = 'block';
            document.getElementById('modalTitle').innerText = name;
            document.getElementById('modalText').innerText = Date: $ {
                date
            }\
            nTime: $ {
                time
            }\
            nLocation: $ {
                location
            }\
            nDescription: $ {
                description
            };
        }

        function closeModal() {
            document.getElementById('modalOverlay').style.display = 'none';
            document.getElementById('eventModal').style.display = 'none';
        }

        document.addEventListener("DOMContentLoaded", function() {
            const textElements = document.querySelectorAll('.inspiration-text');

            textElements.forEach((textElement, index) => {
                setTimeout(() => {
                    textElement.classList.add('fade-in');
                }, index * 1000); // Adjust the delay as needed

                setTimeout(() => {
                    textElement.classList.add('fade-out');
                }, index * 1000 + 3000); // Adjust the delay as needed
            });
        });
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@700&family=Rubik+Scribble&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        @keyframes floatAnimation {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .float {
            animation: floatAnimation 2s ease-in-out infinite;
        }

        .glow-background {
            position: relative;
            width: 600px;
            height: 600px;
            top: 50%;
            left: 50%;
            opacity: 40%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            background-color: rgba(255, 255, 0, 0.3);
            /* Yellow color with 0.3 opacity */
            animation: glowAnimation 2s infinite alternate;
        }

        @keyframes glowAnimation {
            from {
                box-shadow: 0 0 10px rgba(255, 255, 0, 0.5);
            }

            to {
                box-shadow: 0 0 20px rgba(255, 255, 0, 0.8), 0 0 30px rgba(255, 255, 0, 0.5);
            }
        }

        .main-container-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            /* Adjust as needed */
        }

        .maincontainer {
            width: 250px;
            height: 320px;
            background: none;
            margin-right: 20px;
            display: flex;
            justify-content: center;

        }

        .thecard {
            position: relative;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 10px;
            transform-style: preserve-3d;
            transition: all 0.8s ease;
        }

        .thecard:hover {
            transform: rotateY(180deg);
        }

        .thefront {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 10px;
            backface-visibility: hidden;
            overflow: hidden;
            background: #89201a;
            color: #fccc0a;
        }

        .theback {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 10px;
            backface-visibility: hidden;
            overflow: hidden;
            background: #ffffff;
            color: #89201a;
            text-align: center;
            transform: rotateY(180deg);
        }

        .thefront h1,
        .theback h1 {
            font-family: 'zilla slab', sans-serif;
            padding: 30px;
            font-weight: bold;
            font-size: 24px;
            text-align: center;
        }

        .thefront p,
        .theback p {
            font-family: 'zilla slab', sans-serif;
            padding: 30px;
            font-weight: normal;
            font-size: 15px;
            text-align: center;
        }

        .names-box {
            position: absolute;
            top: 150px;
            left: 20px;
            background-color: #fccc0a;
            color: #89201a;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .names-box a {
            color: #89201a;
            text-decoration: underline;
            margin: 5px 0;
            display: block;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal {
            display: none;
            position: absolute;
            top: 120%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: white;
            z-index: 1;
        }

        .modal-content {
            text-align: center;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }

        .names-box {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px;
            background-color: #640216;
        }

        .names-box h1 {
            color: #fccc0a;
            font-size: 1.5em;
        }

        .online {
            color: #4CAF50;
            font-weight: bold;
            cursor: pointer;
        }

        .tooltip {
            position: relative;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .tooltip a {
            text-decoration: none;
            /* Remove underline */
            color: #fccc0a;
            /* Set text color to #fccc0a */
        }

        .tooltip:hover {
            opacity: 1;
            background-color: #fccc0a;
            border-radius: 10px;
        }

        .tooltip:hover a {
            color: #640216;
        }

        .profile-picture {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .fade-in-up-rotate {
            opacity: 0;
            font-size: 2em;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            position: absolute;
        }

        .fade-in-up-rotate {
            opacity: 0;
            font-size: 2em;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            position: absolute;
        }

        @keyframes fadeInUpRotate1 {
            0% {
                opacity: 0;
                transform: translateY(0) rotate(0deg) translateX(0);
            }

            50% {
                opacity: 1;
                transform: translateY(-400px) rotate(-20deg) translateX(-200px);
            }

            100% {
                opacity: 1;
                transform: translateY(-400px) rotate(-20deg) translateX(-200px);
            }
        }

        @keyframes fadeInUpRotate2 {
            0% {
                opacity: 0;
                transform: translateY(0) rotate(0deg) translateX(0);
            }

            50% {
                opacity: 1;
                transform: translateY(-300px) rotate(20deg) translateX(50px);
            }

            100% {
                opacity: 1;
                transform: translateY(-300px) rotate(20deg) translateX(50px);
            }
        }

        @keyframes fadeInUpRotate3 {
            0% {
                opacity: 0;
                transform: translateY(0) rotate(0deg) translateX(0);
            }

            50% {
                opacity: 1;
                transform: translateY(-300px) rotate(-10deg) translateX(-330px);
            }

            100% {
                opacity: 1;
                transform: translateY(-300px) rotate(-10deg) translateX(-330px);
            }
        }

        @keyframes fadeInUpRotate4 {
            0% {
                opacity: 0;
                transform: translateY(0) rotate(0deg) translateX(0);
            }

            50% {
                opacity: 1;
                transform: translateY(30px) rotate(15deg) translateX(200px);
            }

            100% {
                opacity: 1;
                transform: translateY(30px) rotate(15deg) translateX(200px);
            }
        }

        @keyframes fadeInUpRotate5 {
            0% {
                opacity: 0;
                transform: translateY(0) rotate(0deg) translateX(0);
            }

            50% {
                opacity: 1;
                transform: translateY(-120px) rotate(15deg) translateX(260px);
            }

            100% {
                opacity: 1;
                transform: translateY(-120px) rotate(15deg) translateX(260px);
            }
        }

        @keyframes fadeInUpRotate6 {
            0% {
                opacity: 0;
                transform: translateY(0) rotate(0deg) translateX(0);
            }

            50% {
                opacity: 1;
                transform: translateY(220px) rotate(15deg) translateX(-125px);
            }

            100% {
                opacity: 1;
                transform: translateY(220px) rotate(15deg) translateX(-125px);
            }
        }

        @keyframes fadeInUpRotate7 {
            0% {
                opacity: 0;
                transform: translateY(0) rotate(0deg) translateX(0);
            }

            50% {
                opacity: 1;
                transform: translateY(150px) rotate(10deg) translateX(-300px);
            }

            100% {
                opacity: 1;
                transform: translateY(150px) rotate(10deg) translateX(-300px);
            }
        }

        @keyframes fadeInUpRotate8 {
            0% {
                opacity: 0;
                transform: translateY(0) rotate(0deg) translateX(0);
            }

            50% {
                opacity: 1;
                transform: translateY(-400px) rotate(15deg) translateX(155px);
            }

            100% {
                opacity: 1;
                transform: translateY(-400px) rotate(15deg) translateX(155px);
            }
        }




        .p1 {
            animation: fadeInUpRotate1 4s linear 0s forwards;
        }

        .p2 {
            animation: fadeInUpRotate2 4s linear 2s forwards;
        }

        .p3 {
            animation: fadeInUpRotate3 4s linear 4s forwards;
        }

        .p4 {
            animation: fadeInUpRotate4 4s linear 6s forwards;
        }

        .p5 {
            animation: fadeInUpRotate5 4s linear 8s forwards;
        }

        .p6 {
            animation: fadeInUpRotate6 4s linear 10s forwards;
        }

        .p7 {
            animation: fadeInUpRotate7 4s linear 12s forwards;
        }

        .p8 {
            animation: fadeInUpRotate8 4s linear 14s forwards;
        }
    </style>

    <div class="w-screen h-screen xl:w-full xl:h-full flex flex-row items-center overflow-x-hidden relative justify-center">
        <div class="w-[40%] h-full items-center justify-center flex flex-col">
            <h1 class="text-center text-8xl text-gray-800 animate__animated animate__fadeInDown">
                WELCOME TO MINDSCAPE <br>
            </h1>
            <p class="text-center text-xl mt-10 text-gray-700 animate__animated animate__pulse">Discover a world of
                possibilities for your mind and soul</p>
        </div>
        <div class="w-[40%] h-full relative">
            <div class="glow-background">
            </div>
            <img src="/images/bg.png" alt="" class="absolute top-40 left-24 float z-40">


            <!-- Manually positioned inspirational messages with cooler styles -->
            <p class="fade-in-up-rotate p1 absolute top-[500px] left-80 text-red-500 text-lg italic tracking-wide">
                Love Yourself
            </p>
            <p class="fade-in-up-rotate p2 absolute top-[500px] left-80 text-blue-500 text-lg italic tracking-wide">Believe
                in
                yourself and all that
                you are</p>
            <p class="fade-in-up-rotate p3 absolute top-[500px] left-80 text-green-500 text-lg tracking-wide">Your only
                limit is
                you</p>
            <p class="fade-in-up-rotate p4 absolute top-[500px] left-80 text-purple-500 text-lg font-bold tracking-wide">
                Embrace
                the journey of
                becoming the best version of yourself</p>
            <p class="fade-in-up-rotate p5 absolute top-[500px] left-80 text-amber-500 text-lg font-bold tracking-wide">
                Success
                is not final, failure
                is not fatal</p>

            <p class="fade-in-up-rotate p6 absolute top-[500px] left-80 text-red-500 text-lg font-bold tracking-wide">
                Your attitude determines your
                direction</p>

            <p class="fade-in-up-rotate p7 absolute top-[500px] left-80 text-emerald-500 text-lg font-bold tracking-wide">
                Every day is a new beginning</p>

            <p class="fade-in-up-rotate p8 absolute top-[500px] left-80 text-rose-500 text-lg font-bold tracking-wide">
                You are capable of more than you
                know</p>




        </div>






    </div>

    <div class="bg-yellow w-full h-full pt-5">
        <div
            class="text-6xl font-extrabold text-slate-800 tracking-wide uppercase text-center animate__animated animate__fadeInDown second mt-6">
            Upcoming Events</div>

        <div class="main-container-wrapper flex flex-wrap justify-center">
            @if (isset($events) && count($events) > 0)
                <!-- Display uploaded events with options to edit or delete -->
                @foreach ($events as $event)
                    <div class="maincontainer mb-4">
                        <div class="thecard">
                            <div class="thefront">
                                <h5 class="p-2 text-center font-bold text-2xl mt-32">{{ $event->name }}</h5>
                            </div>
                            <div class="theback">
                                <p class="card-text">
                                    <strong>Date:</strong> {{ date('M d Y', strtotime($event->date)) }} <br>

                                    <strong>Time:</strong> {{ date('h:i A', strtotime($event->time)) }} <br>
                                    <strong>Location:</strong> {{ $event->location }}
                                </p>
                                <p>{{ $event->description }}</p>
                                <a href="#"
                                    onclick="openModal('{{ $event->name }}', '{{ $event->date }}', '{{ $event->time }}', '{{ $event->location }}', '{{ $event->description }}')">View
                                    Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="maincontainer mb-4">
                    <div class="thecard">
                        <div class="thefront">
                            <h5 class="p-2 text-center font-bold text-2xl mt-32">No Events.</h5>
                        </div>
                        <div class="theback">
                            <p class="card-text">
                                There are no Events yet.
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="modal-overlay" id="modalOverlay"></div>

        <div class="modal" id="eventModal">
            <div class="modal-content" id="eventModalContent">
                <!-- Modal content goes here -->
                <span class="close-btn" onclick="closeModal()">&times;</span>
                <h5 class="modal-title" id="modalTitle"></h5>
                <p class="modal-text" id="modalText"></p>
            </div>
        </div>
    </div>
    <div class="names-box">
        <h1>Available Counselors:</h1>
        @if (isset($counselors) && count($counselors) > 0)
            @foreach ($counselors as $counselor)
                <form action="{{ route('counselors.updateOnlineStatus', $counselor->id) }}" method="POST"
                    id="updateOnlineStatus{{ $counselor->id }}">
                    @csrf
                    @method('PATCH')
                    <div class="tooltip">
                        <img src="{{ asset('images/defaultuser.png') }}" alt="Profile Picture" class="profile-picture">
                        <a href="{{ route('chatcounselor', ['user_id' => $counselor->id]) }}"
                            class="{{ $counselor->online ? 'online' : '' }}">
                            {{ $counselor->name }}
                        </a>
                    </div>
                </form>
            @endforeach
        @else
            <p class="text-perpetualyellow">No counselors available.</p>
        @endif
    </div>


@endsection
