<!-- resources/views/navbar.blade.php -->
<!DOCTYPE html>
<html lang="en" data-csrf="{{ csrf_token() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @vite('resources/css/app.css')


    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .active p {
            display: none;
        }

        .active i {
            font-size: 2em;
            animation: float 2s ease-in-out infinite;
            box-shadow: 0 40px 15px rgba(0, 0, 0, 0.4);
            background: linear-gradient(to top right, #e6e6e6, #ecb222);
            -webkit-background-clip: text;
            color: transparent;
        }

        .active {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;

        }
    </style>
</head>

<body>
    <nav class="bg-adminPrimary flex items-center justify-between xl:w-full xl:bg-adminPrimary">
        <div class="w-60 h-auto bg-white absolute top-24 z-10 right-10 rounded-md border border-gray-300 hidden"
            id="logout">
            <a href="/profile"
                class="flex justify-start items-center w-full space-x-1 p-2 border-b border-gray-300 hover:bg-slate-200">
                <i class="fa-solid fa-id-card fa-md ml-2 bg-blue-500 text-white rounded-full p-2"></i>
                <p class="text-black text-sm">Profile</p>
            </a>

            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="flex justify-start items-center w-full space-x-1 p-2 hover:bg-slate-200">
                <i class="fa-solid fa-right-from-bracket fa-md ml-2 bg-green-500 text-white rounded-full p-2"></i>
                <p class="">Log out</p>
            </a>
        </div>


        <!-- Logo (xl) -->
        <div class="text-center xl:flex flex-col hidden p-5 ml-5">
            <span class="text-white text-4xl font-bold" style="text-shadow: 0 0 10px #ffffff;">Mind</span>
            <span class="text-yellow text-4xl font-bold" style="text-shadow: 0 0 10px #ecb222;">Scape</span>
        </div>

        <!-- xl Menu -->

        <div class="flex h-full hidden xl:flex">
            <div class="flex space-x-16 justify-center items-center px-20">
                <div id="home" class="@if (request()->is('admindashboard')) active @endif">
                    <a href="/admindashboard">
                        <div class="flex gap-2 items-center">
                            <i class="fa-solid fa-house fa-md text-accent"></i>
                            <p class="text-accent text-sm">Home</p>
                        </div>
                    </a>
                </div>
                <div id="adminappointment" class="@if (request()->is('adminappointment')) active @endif">
                    <a href="/adminappointment">
                        <div class="flex gap-2 items-center">
                            <i class="fa-solid fa-calendar-check fa-md text-accent"></i>
                            <p class="text-accent text-sm">Appointment</p>
                        </div>
                    </a>
                </div>

                <div id="newUser" class="@if (request()->is('newUser')) active @endif">
                    <a href="/newUser">
                        <div class="flex gap-2 items-center">
                            <i class="fa-solid fa-user fa-md text-accent"></i>
                            <p class="text-accent text-sm">Register</p>
                        </div>
                    </a>
                </div>




                <div id="adminresources" class="@if (request()->is('adminresources')) active @endif">
                    <a href="/adminresources">
                        <div class="flex gap-2 items-center">
                            <i class="fa-solid fa-download fa-md text-accent"></i>
                            <p class="text-accent text-sm">Resources</p>
                        </div>
                    </a>
                </div>

                <div id="counselingrecords" class="@if (request()->is('counselingrecords')) active @endif">
                    <a href="/counselingrecords">
                        <div class="flex gap-2 items-center">
                            <i class="fa-solid fa-clipboard fa-md text-accent"></i>
                            <p class="text-accent text-sm">CounselingRecords</p>
                        </div>
                    </a>
                </div>

                <div id="home" class="@if (request()->is('showrecordings')) active @endif">
                    <a href="/showrecordings">
                        <div class="flex gap-2 items-center">
                            <i class="fa-solid fa-video fa-md text-accent"></i>
                            <p class="text-accent text-sm">ScreenRecordings</p>
                        </div>
                    </a>
                </div>

                <div id="home" class="@if (request()->is('addstudents')) active @endif">
                    <a href="/addstudents">
                        <div class="flex gap-2 items-center">
                            <i class="fa-solid fa-video fa-md text-accent"></i>
                            <p class="text-accent text-sm">addstudent</p>
                        </div>
                    </a>
                </div>

            </div>


        </div>

        <div class="hidden xl:flex mr-10 justify-center items-center space-x-5">
            <div id="message" class="relative">
                <a href="/message">
                    <i class="fa-solid fa-envelope fa-lg text-accent"></i>
                </a>
                <span id="notificationCount"
                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-4 h-4 text-xs flex items-center justify-center cursor-pointer"
                    onclick="toggleNotifications(event)">
                    {{ $notseen }}
                </span>
            </div>

            <div class="relative">
                <i class="fa-solid fa-bell fa-lg text-accent cursor-pointer" onclick="toggleNotifications(event)"></i>
                <span id="notificationCount"
                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-4 h-4 text-xs flex items-center justify-center cursor-pointer"
                    onclick="toggleNotifications(event)">
                    {{ $unreadnotifications }}
                </span>



                <!-- Notifications Container -->
                <div id="notificationsContainer"
                    class="hidden absolute w-[390px] right-[-175px] md:top-0 md:right-0 md:mt-8 bg-white border border-gray-200 rounded-md shadow-md max-w-sm overflow-hidden md:w-96 z-10">
                    <div class="p-4">
                        @php
                            $newNotifications = $notifications->filter(function ($notification) {
                                return \Carbon\Carbon::parse($notification->data['timestamp'])->diffInMinutes() < 21;
                            });
                            $earlierNotifications = $notifications->filter(function ($notification) {
                                return \Carbon\Carbon::parse($notification->data['timestamp'])->diffInMinutes() >= 21;
                            });
                        @endphp

                        @if ($newNotifications->count() > 0)
                            <p class="font-bold text-maroon text-lg">New</p>
                            @foreach ($newNotifications as $notification)
                                <div class="mb-2 @if (!$notification->read_at) unread @endif">
                                    {{ $notification->data['message'] }}
                                    <p class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($notification->data['timestamp'])->diffForHumans() }}
                                    </p>
                                </div>
                                <hr class="my-2">
                            @endforeach
                        @endif

                        @if ($earlierNotifications->count() > 0)
                            <p class="font-bold text-maroon text-lg">Earlier</p>
                            @foreach ($earlierNotifications as $notification)
                                <div class="mb-2 @if (!$notification->read_at) unread @endif">
                                    {{ $notification->data['message'] }}
                                    <p class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($notification->data['timestamp'])->diffForHumans() }}
                                    </p>
                                </div>
                                <hr class="my-2">
                            @endforeach
                        @endif

                        @if ($newNotifications->isEmpty() && $earlierNotifications->isEmpty())
                            <p class="text-gray-500">No notifications</p>
                        @endif
                    </div>
                </div>


            </div>
            <img src="/images/profileM.png" alt="profile pic"
                class="w-24 h-24 rounded-full object-cover border-2 border-adminPrimary cursor-pointer relative"
                id="profile" onclick="showProfile(event)">
            <i class="fa-solid fa-chevron-down absolute text-black fa-md right-8 top-20 bg-slate-300 rounded-full px-1 py-1 cursor-pointer"
                onclick="showProfile(event)"></i>

        </div>

        <!-- Burger Menu -->
        <x-burger />

        <!-- Logo (mobile) -->
        <div class=" text-center flex py-4 items-center justify-center xl:hidden">
            <span class="text-white text-4xl font-bold" style="text-shadow: 0 0 2px #ffffff;">Mind</span>
            <span class="text-yellow text-4xl font-bold" style="text-shadow: 0 0 2px #ecb222;">Scape</span>
        </div>


        <!-- Settings Icon (mobile) -->

        <i class="fa-solid fa-gear fa-lg text-white mr-3 xl:hidden" onclick="toggleSettings()"></i>



        <div id="settings"
            class="hidden fixed top-10 right-3 w-48 h-32 bg-white border border-gray-300 rounded-lg shadow-md z-50 flex justify-center items-center">
            <button class="material-symbols-outlined absolute top-2 right-4 text-gray-600" onclick="toggleSettings()">
                Close
            </button>
            <button class="mx-4 my-2 px-4 py-2 bg-adminPrimary text-white rounded hover:bg-red-700 w-full"
                href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>






    </nav>
    <script src="{{ asset('js/notification.js') }}" defer></script>
</body>

</html>
