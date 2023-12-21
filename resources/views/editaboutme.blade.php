@extends('layouts.layout')


@section('content')
    <div>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Update About Me</title>
            @vite('resources/css/app.css')
        </head>

        <body>
            <form method="POST" action="{{ route('edit_aboutme') }}" enctype="multipart/form-data">
                @csrf
                <!-- Your form content here -->
                <div class="w-[900px] h-44 bg-customRed rounded-2xl text-2xl text-white mx-auto mt-20">
                    <div class="flex items-center justify-center">
                        <div class="inputBox">
                            <label>About Me </label>
                            <input type="text" name="aboutme" id="about" class="box text-black" required>
                        </div>
                        <button type="submit"
                            class="bg-lightpink hover:bg-customRed text-white py-2 px-4 rounded-md cursor-pointer transition duration-300 mt-7">Save</button>
                        <a href="/profile"
                            class="bg-lightpink hover:bg-customRed text-white py-2 px-4 rounded-md cursor-pointer transition duration-300 mt-7">Go
                            Back</a><br>
                    </div>
                </div>
            </form>

    </div>
    </body>

    </html>
    </div>
@endsection
