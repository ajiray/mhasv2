@extends('layouts.layout')

@section('content')
    <div
        class="w-screen h-screen xl:h-full xl:w-full bg-gradient-to-b from-slate-200 via-slate-100 to-slate-300 flex flex-col justify-center space-y-10 items-center xl:space-y-0 xl:flex-row xl:justify-center xl:items-center xl:space-x-28 overflow-hidden">
        <a href="/chatbot"
            class="bg-gradient-to-b from-teal-700 to-emerald-600 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:scale-105 w-[80%] xl:w-[40%] xl:h-[50%] flex justify-center items-center animate__animated animate__backInLeft">
            <div class="flex flex-col items-center">
                <i class="fa-solid fa-robot fa-6x text-gray-300"></i>
                <p class="text-gray-300 text-xl mt-4">MindBot</p>
                <p class="text-gray-300 text-sm mt-4">Click to interact with MindBot, our friendly chatbot!</p>
            </div>
        </a>
        <a href="/message"
            class="bg-gradient-to-b from-blue-900 to-indigo-500 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:scale-105 w-[80%] xl:w-[40%] xl:h-[50%] flex justify-center items-center animate__animated animate__backInRight">
            <div class="flex flex-col items-center">
                <i class="fa-solid fa-envelope fa-6x text-gray-200"></i>
                <p class="text-gray-200 text-xl mt-4">Message</p>
                <p class="text-gray-200 text-sm mt-4">Click to access your messages</p>
            </div>
        </a>
    </div>
@endsection
