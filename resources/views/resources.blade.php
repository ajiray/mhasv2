@extends('layouts.layout')
<!DOCTYPE html>
<html lang="en" data-csrf="{{ csrf_token() }}">

<head>
    <title></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/resources.js') }}" defer></script>
</head>

<body>

    @section('content')
        <div class="justify-center w-full flex animate__animated animate__bounceInDown">
            <div
                class="flex rounded-lg shadow-md justify-between items-center bg-maroon flex-col mt-10 w-[40%] space-y-2 pt-5 pb-5 xl:pt-0 xl:pb-0 xl:space-y-0 xl:flex-row xl:h-16 xl:w-full xl:ml-5 xl:mr-5 xl:mt-10 xl:p-6">
                <button id="pdfButton" class="bg-maroon-light text-gray-500 w-full xl:px-4 py-2 xl:rounded-md font-bold"
                    data-category="pdf" onclick="filterClicked('white', 'black', this, 'line1', 'PDF')">PDF</button>
                <div class="hidden xl:flex">
                    <div class="line1 relative h-1 w-32 bg-gray-500"></div>
                    <div class="line2 relative h-1 w-32 bg-gray-500"></div>
                </div>
                <button id="videoButton" class="bg-maroon-light text-gray-500 w-full px-4 py-2 xl:rounded-md font-bold"
                    data-category="video" onclick="filterClicked('white', 'black', this, 'line2', 'Videos')">Videos</button>
                <div class="hidden xl:flex">
                    <div class="line2 relative h-1 w-32 bg-gray-500"></div>
                    <div class="line3 relative h-1 w-32 bg-gray-500"></div>
                </div>
                <button id="infoButton" class="bg-maroon-light text-gray-500 w-full px-4 py-2 xl:rounded-md font-bold"
                    data-category="infographic"
                    onclick="filterClicked('white', 'black', this, 'line3', 'Info')">Infographics</button>
                <div class="hidden xl:flex">
                    <div class="line3 relative h-1 w-32 bg-gray-500"></div>
                    <div class="line4 relative h-1 w-32 bg-gray-500"></div>
                </div>
                <button id="eBookButton" class="bg-maroon-light text-gray-500 w-full px-4 py-2 xl:rounded-md font-bold"
                    data-category="ebook" onclick="filterClicked('white', 'black', this, 'line4', 'book')">Ebooks</button>
            </div>

        </div>

        <div id="resourceContent" class="mt-5 xl:ml-10">

        </div>
    @endsection

</body>

</html>
