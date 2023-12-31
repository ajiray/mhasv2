@extends('layouts.adminlayout')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@700&family=Rubik+Scribble&display=swap');

        .first {
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
            <h1 class="text-center text-8xl text-gray-800 animate__animated animate__fadeInDown first">
                WELCOME TO MINDSCAPE <br>
            </h1>
            <p class="text-center text-xl mt-10 text-gray-700 animate__animated animate__pulse">Discover a world of
                possibilities for your mind and soul</p>
        </div>
        <div class="w-[40%] h-full relative xl:block hidden">
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
@endsection
