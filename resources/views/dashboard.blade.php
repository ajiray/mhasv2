@extends('layouts.layout')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap');

        .first {
            font-family: 'Roboto', sans-serif;
            font-size: 6rem;
            text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.5);
        }


        .back {
            background: white;
        }

        @keyframes walkAnimation {
            0% {
                left: -30%;
                /* Starting position off-screen to the left */
            }

            100% {
                left: 100%;
                /* Ending position off-screen to the right */
            }
        }

        .walking-boy {
            width: 30%;
            position: absolute;
            animation: walkAnimation 10s linear infinite;
            /* Adjust the duration as needed */
        }
    </style>

    <div
        class="w-screen h-screen xl:w-full xl:h-[87%] flex flex-row items-center bg-white relative overflow-x-hidden relative">

        <div class="w-full flex flex-col h-full back absolute">
            <h1
                class="text-5xl font-extrabold mb-6 text-slate-800 tracking-wide uppercase text-center animate__animated animate__fadeInDown first mt-56 absolute right-0 left-0 z-20">
                Welcome to MindScape
            </h1>

            <img src="/images/boy.gif" alt="" class="w-[30%] walking-boy mt-56 z-30">
        </div>
    </div>


    <div class="h-full w-full bg-slate-400">
        <h1 class="text-center text-3xl">Upcoming Events</h1>
    </div>
@endsection
