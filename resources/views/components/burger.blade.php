<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    @vite('resources/css/app.css')

</head>


<body>
    <button class="material-symbols-outlined text-white ml-2 xl:hidden" onclick="toggleMenu()">
        menu
    </button>

    <div id="mobileMenu"
        class="fixed flex justify-center items-center top-0 left-0 h-screen w-screen bg-white z-50 transition hidden">

        <button class="material-symbols-outlined absolute top-4 right-4 text-gray-600" onclick="toggleMenu()">
            Close
        </button>

        <div class="flex flex-col gap-y-16 text-lg md:text-3xl md:gap-y-20">
            <a href="/dashboard">
                <div class="flex gap-2 items-center">
                    <i class="fa-solid fa-house fa-l text-maroon"></i>
                    <p class="text-maroon">Home</p>
                </div>
            </a>
            <a href="/wall">
                <div class="flex gap-2 items-center">
                    <i class="fa-solid fa-newspaper fa-l text-maroon"></i>
                    <p class="text-maroon">Freedom Wall</p>
                </div>
            </a>
            <a href="/appointment">
                <div class="flex gap-2 items-center">
                    <i class="fa-solid fa-calendar-check fa-l text-maroon"></i>
                    <p class="text-maroon">Appointment</p>
                </div>
            </a>

            <a href="/messageOption">
                <div class="flex gap-2 items-center">
                    <i class="fa-solid fa-envelope fa-l text-maroon"></i>
                    <p class="text-maroon">Chat</p>
                </div>
            </a>

            <a href="/profile">
                <div class="flex gap-2 items-center">
                    <i class="fa-solid fa-id-card fa-l text-maroon"></i>
                    <p class="text-maroon">Profile</p>
                </div>
            </a>
            <a href="/resources">
                <div class="flex gap-2 items-center">
                    <i class="fa-solid fa-download fa-l text-maroon"></i>
                    <p class="text-maroon">Resources</p>
                </div>
            </a>

            <a href="/videocall">
                <div class="flex gap-2 items-center">
                    <i class="fa-solid fa-video fa-l text-maroon"></i>
                    <p class="text-maroon">Video Call</p>
                </div>
            </a>
        </div>
    </div>

    <script>
        function toggleMenu() {

            var mobileMenu = document.getElementById("mobileMenu");
            mobileMenu.classList.toggle("hidden"); // Toggle the 'hidden' class to show/hide the menu
        }
    </script>
</body>

</html>
