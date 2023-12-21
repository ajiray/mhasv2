@extends('layouts.layout')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Profile</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }


        .card {
            background-color: #f2f8f9;
            border-radius: 20px;
        }

        @media only screen and (max-width: 768px) {
            .card1 {
                padding: 30px 16px;
            }

            .card1 .small {
                margin-left: 0;
            }
        }

        @media only screen and (max-width: 480px) {
            .card1 {
                padding: 20px 16px;
            }
        }
    </style>
</head>

<body>
    <div class="card1 mx-auto mt-[100px] md:mt-56 w-full max-w-[900px]">
        <form method="POST" action="{{ route('update_profile') }}" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col items-center bg-blue-200 rounded-xl">
                <div class="inputBox mt-4 p-6 px-2 py-2">
                    <span style="font-weight: bold;">UPDATE YOUR PICTURE:</span>
                    <input type="file" name="avatar" id="avatarName" accept="image/jpg, image/jpeg, image/png" class="box">
                </div>
                <button type="submit"
                    class="bg-lightpink hover:bg-customRed w-[200px] md:w-[200px] text-white py-2 p-10 px-4 rounded-md cursor-pointer transition duration-300 mt-7">Update
                    Profile</button>
                <a href="/profile"
                    class="bg-lightpink hover:bg-customRed w-[200px] md:w-[200px] text-center p-2 text-white rounded-md cursor-pointer transition duration-300 mt-7">Go
                    Back</a><br>
            </div>
        </form>
    </div>
</body>

</html>
@endsection
