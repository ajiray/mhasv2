@extends('layouts.layout')


@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile</title>
        <script>
            function confirmDeletePost(postId) {
                if (confirm('Are you sure you want to delete this post?')) {
                    document.getElementById('delete-form-' + postId).submit();
                }
            }
        </script>
        @vite('resources/css/app.css')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100&display=swap" rel="stylesheet">
    </head>
    <style>
        .card .small {
            font-size: 20px;
            margin-left: auto;
            margin-right: auto;
        }

        .card p {
            font-size: 12px;
        }

        .go-corner {
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            width: 32px;
            height: 32px;
            overflow: hidden;
            top: 0;
            right: 0;
            background-color: #E2A3A3;
            border-radius: 0 4px 0 32px;
        }

        .card1 {
            display: block;
            position: relative;
            max-width: 700px;
            background-color: #f2f8f9;
            border-radius: 20px;
            padding: 50px 24px;
            margin: 12px;
            text-decoration: none;
            z-index: 0;
            overflow: hidden;
            margin-left: auto;
            margin-right: auto;
        }

        .card1:before {
            content: "";
            position: absolute;
            z-index: -1;
            top: -16px;
            right: -16px;
            background: #E2A3A3;
            height: 32px;
            width: 32px;
            border-radius: 32px;
            transform: scale(1);
            transform-origin: center;
            transition: transform 0.25s ease-out;
        }

        .card1:hover:before {
            transform: scale(50);
        }

        .card1:hover p {
            transition: all 0.3s ease-out;
            color: rgba(255, 255, 255, 0.8);
        }

        .card1:hover h3 {
            transition: all 0.3s ease-out;
            color: #fff;
        }

        .card1:hover h1 {
            transition: all 0.3s ease-out;
            color: #fff;
        }

        .card1:hover button {
            transition: all 0.3s ease-out;
            color: #fff;
        }

        .card1:hover .small {
            transition: all 0.3s ease-out;
            color: #fff;
        }

        .card1 .small {
            margin-left: 50px;
        }

        .card {
            animation: floating 2s ease-in-out infinite;
            /* Adjust the duration and timing function as needed */

        }

        @keyframes floating {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(10px);
            }

            100% {
                transform: translateY(0);
            }
        }

        #h11 {
            font-family: 'Kanit', sans-serif;

        }
    </style>

    <body>
        <section class="relative">
            <!-- Whole Screen -->
            <div class="w-full md:h-auto bg-white">
                <!-- Red Above -->
                <div class="w-full h-72 absolute bg-red-900 flex items-center justify-center">
                    <div>
                        <span class="text-white text-4xl font-bold">Mind</span><span
                            class="text-yellow text-4xl font-bold">Scape </span>
                        <span class="text-white text-4xl font-bold">Profile</span>
                    </div>
                </div>
                <!-- Profile Picture -->
                <div
                    class="w-[200px] h-[200px] bg-lightpink rounded-full flex items-center justify-center absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 mt-72">
                    <img src="public/storage/app/public/users-avatar/{{ Auth::user()->avatar }}" alt="User Image"
                        class="w-[200px] h-[200px] rounded-full" />
                </div>

                <div id="h11"
                    class="absolute flex items-center justify-center top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 mt-[410px] text-xl md:text-3xl font-bold">
                    {{ Auth::user()->name }}
                </div>
                <!-- Change Photo Button -->
                <div
                    class="absolute mt-[460px] flex items-center justify-center top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                    <div class="inputBox">
                        <a href="{{ url('/update-profile-photo') }}"><button type="button"
                                class="bg-lightpink hover:bg-customRed text-white py-2 px-4 rounded-md cursor-pointer transition duration-300">Change
                                photo</button></a>
                    </div>
                </div>
            </div>
        </section>

    </body>


    </html>
@endsection
