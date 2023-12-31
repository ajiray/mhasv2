<!DOCTYPE html>
<html class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to MindScape</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/app.css')
    <link rel="icon" href="public/images/logo.ico" type="image/x-icon">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:wght@100&family=Montserrat:ital,wght@0,500;1,400&family=Roboto+Slab&display=swap"
        rel="stylesheet">

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

        .floating-element {
            animation: float 2s ease-in-out infinite;
        }

        .gradient {
            background-image: radial-gradient(circle farthest-corner at 10% 20%, rgba(147, 67, 67, 1) 0%, rgba(111, 27, 27, 1) 90%);
        }

        #scrollArrow {
            transition: opacity 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            /* Set a higher z-index if needed */
            background-color: #800000;
            /* Adjust background color as needed */
            animation: fadeIn 1s ease-out;
            transition: opacity 0.3s ease-in-out;
        }

        .section-content {
            margin-top: 200px;
        }
    </style>
</head>

<body class="overflow-x-hidden w-full flex flex-col justify-center">

    <!--Header-->
    <header>
        <nav class="container flex items-center py-4 bg-maroon max-w-full fixed">
            <div class="py-1 flex items-center w-full">
                <img src="/images/perpslogo.png" alt="" class="w-[70px] h-[100px] mr-4">
                <div class="flex flex-col">
                    <h1 class="font-roboto font-bold text-perpetualyellow text-[20px] mt-0">UNIVERSITY OF</h1>
                    <h1 class="font-roboto font-bold text-perpetualyellow text-[30px] mt-[-10px]">PERPETUAL HELP</h1>
                    <h1 class="font-roboto font-bold text-perpetualyellow text-[20px] mt-[-10px]">SYSTEM DALTA LAS PINAS
                        CAMPUS</h1>
                </div>
            </div>


            <ul class="hidden sm:flex flex-1 justify-end items-center gap-12 text-white uppercase text-xs mr-10"
                id="menuList">
                <li class="cursor-pointer dark:hover:text-yellow"><a href="#features">Features</a></li>
                <li class="cursor-pointer dark:hover:text-yellow"><a href="#about">About</a></li>
                <li class="cursor-pointer dark:hover:text-yellow"><a href="#contact">Contact</a></li>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="font-semibold bg-perpetualyellow text-maroon rounded-md px-7 py-3 uppercase dark:hover:text-white ">Login</a>

                    @endauth
                @endif
            </ul>
            <div class="flex sm:hidden flex-1 justify-end relative">
                <div class="flex items-center" id="menuIcon" onclick="toggleMenu()">
                    <!-- Use the Font Awesome icon for the menu -->
                    <i class="text-2xl fas fa-bars cursor-pointer"></i>
                </div>
                <ul class="hidden absolute top-6 left-35 bg-maroon text-white rounded-md border border-gray-200 mt-1 p-2 z-50"
                    id="mobileMenu">

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="font-semibold bg-white text-maroon mt-4 rounded-md px-4 py-1 uppercase">Log in</a>

                        @endauth
                    @endif
                </ul>
            </div>
        </nav>
    </header>

    <script>
        function toggleMenu() {
            var mobileMenu = document.getElementById("mobileMenu");
            mobileMenu.classList.toggle("hidden"); // Toggle the 'hidden' class to show/hide the menu
        }
    </script>
    <!-- Hero -->
    <section class="relative section-content">
        <div class="container flex flex-col-reverse lg:flex-row items-center gap-12 mt-14 lg:mt-28">
            <!-- Content -->
            <div class="flex flex-1 flex-col items-center lg:items-start floating-element" data-aos="zoom-in">
                <h2
                    class="text-maroon text-3xl md:text-4 lg:text-5xl text-center lg:text-left mb-6 font-roboto font-bold">
                    MindScape
                </h2>
                <p class="text-black text-lg text-center lg:text-left mb-6">
                    A Mental Health Awareness System for the students of the University of Perpetual Help System Dalta
                    Las Pinas Campus
                </p>
                <div class="flex justify-center flex-wrap gap-6">
                    <a href="https://web.facebook.com/perpetual.lp" target="_blank"
                        class="font-semibold bg-maroon text-white rounded-md px-7 py-3 uppercase hover:text-white">Facebook</a>
                    <a href="https://www.instagram.com/universityofperpetualhelp/" target="_blank"
                        class="font-semibold bg-maroon text-white rounded-md px-7 py-3 uppercase hover:text-white">Instagram</a>
                </div>
            </div>
            <!-- Image -->
            <div class="flex justify-center flex-1 mb-10 md:mb-16 lg:mb-0 z-10" data-aos="fade-left">
                <img class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-[1300px] md:h-full rounded-md" src="./images/mental.png"
                    alt="">
            </div>
        </div>
        <!--Rounded Rectangle-->
        <div
            class="hidden xl:block overflow:hidden bg-maroon rounded-l-full absolute h-80 w-[40%] top-22 right-0 lg:-bottom-28 right-0">
        </div>
    </section>
    <!-- Features -->
    <section class="bg-gray py-20 lg:mt-60 section-content" id="features">
        <!-- Heading -->
        <div class="sm:3/4 lg:w-5/12 mx-auto px-2 mt-28">
            <h1 class="text-3xl text-center text-maroon font-roboto font-bold">Features</h1>
            <p class="text-center text-black mt-4">
                Mindscape is an online platform for the University of Perpetual Help System Dalta Las Pinas Campus
                College Students to help them be aware of their
                mental health. And it offers a lot of features that will surely help the college students.
            </p>
        </div>
        <!-- Feature 1 -->
        <div class="relative mt-20 lg:mt-24">
            <div class="container flex flex-col lg:flex-row items-center justify-center gap-x-24">
                <!-- Image -->
                <div class="flex flex-1 justify-center z-10 mb-10- lg:mb-0" data-aos="fade-right">
                    <img class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-[1300px] md:h-full rounded-md"
                        src="./images/videocall.jpg" alt="">
                </div>
                <!-- Content -->
                <div class="flex flex-1 flex-col items-center lg:items-start floating-element">
                    <h1 class="text-3xl text-maroon mt-10 xl:mt-0 font-roboto font-bold">Video Call</h1>
                    <p class="text-black my-4 text-center lg:text-left sm:w-3/4 lg:w-full">
                        Have a one on one session with the schools psychologist/counselor to help you with your mental
                        health issues.
                    </p>
                </div>
            </div>
            <!-- Rounded Rectangle -->
            <div
                class="hidden xl:block overflow:hidden bg-maroon rounded-r-full absolute h-80 w-[40%] -bottom-24 left-0">
            </div>
        </div>
        <!-- Feature 2 -->
        <div class="relative mt-20 lg:mt-52">
            <div class="container flex flex-col lg:flex-row-reverse items-center justify-center gap-x-24">
                <!-- Image -->
                <div class="flex flex-1 justify-center z-10 mb-10- lg:mb-0" data-aos="fade-left">
                    <img class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-[1300px] md:h-full rounded-md"
                        src="./images/appointment.jpg" alt="">
                </div>
                <!-- Content -->
                <div class="flex flex-1 flex-col items-center lg:items-start floating-element">
                    <h1 class="text-3xl text-maroon mt-10 xl:mt-0 font-roboto font-bold">Book Appointments</h1>
                    <p class="text-black my-4 text-center lg:text-left sm:w-3/4 lg:w-full">
                        Easily book an appointment with the available psychologist/counselor.
                    </p>
                </div>
            </div>
            <!-- Rounded Rectangle -->
            <div
                class="hidden xl:block overflow:hidden bg-maroon rounded-l-full absolute h-80 w-[40%]  -bottom-24 right-0">
            </div>
        </div>
        <!-- Feature 3 -->
        <div class="relative mt-20 lg:mt-52">
            <div class="container flex flex-col lg:flex-row items-center justify-center gap-x-24">
                <!-- Image -->
                <div class="flex flex-1 justify-center z-10 mb-10- lg:mb-0" data-aos="fade-right">
                    <img class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-[1300px] md:h-full rounded-md"
                        src="./images/chatbot.jpg" alt="">
                </div>
                <!-- Content -->
                <div class="flex flex-1 flex-col items-center lg:items-start floating-element">
                    <h1 class="text-3xl text-maroon mt-10 xl:mt-0 font-roboto font-bold">AI Chatbot</h1>
                    <p class="text-black my-4 text-center lg:text-left sm:w-3/4 lg:w-full">
                        If the psychologist/counselor is not available, you can ask our AI Chatbot about concerns in
                        mental health.
                    </p>
                </div>
            </div>
            <!-- Rounded Rectangle -->
            <div
                class="hidden xl:block overflow:hidden bg-maroon rounded-r-full absolute h-80 w-[40%]  -bottom-24 left-0">
            </div>
        </div>

        <!-- Feature 4 -->
        <div class="relative mt-20 lg:mt-52">
            <div class="container flex flex-col lg:flex-row-reverse items-center justify-center gap-x-24">
                <!-- Image -->
                <div class="flex flex-1 justify-center z-10 mb-10- lg:mb-0" data-aos="fade-left">
                    <img class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-[1300px] md:h-full rounded-md"
                        src="./images/live.png" alt="">
                </div>
                <!-- Content -->
                <div class="flex flex-1 flex-col items-center lg:items-start floating-element">
                    <h1 class="text-3xl text-maroon mt-10 xl:mt-0 font-roboto font-bold">Live Messaging</h1>
                    <p class="text-black my-4 text-center lg:text-left sm:w-3/4 lg:w-full">
                        Easily send and receive messages with users in the system.
                    </p>
                </div>
            </div>
            <!-- Rounded Rectangle -->
            <div
                class="hidden xl:block overflow:hidden bg-maroon rounded-l-full absolute h-80 w-[40%] -bottom-36 right-0">
            </div>
        </div>
        <!-- Feature 5 -->
        <div class="relative mt-20 lg:mt-52">
            <div class="container flex flex-col lg:flex-row items-center justify-center gap-x-24">
                <!-- Image -->
                <div class="flex flex-1 justify-center z-10 mb-10- lg:mb-0" data-aos="fade-right">
                    <img class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-[1300px] md:h-full rounded-md"
                        src="./images/freedom.jpg" alt="">
                </div>
                <!-- Content -->
                <div class="flex flex-1 flex-col items-center lg:items-start floating-element">
                    <h1 class="text-3xl text-maroon mt-10 xl:mt-0 font-roboto font-bold">Freedom Wall</h1>
                    <p class="text-black my-4 text-center lg:text-left sm:w-3/4 lg:w-full">
                        Students have the freedom to post anything on their minds, with an option to post it
                        anonymously.
                    </p>
                </div>
            </div>
            <!-- Rounded Rectangle -->
            <div
                class="hidden xl:block overflow:hidden bg-maroon rounded-r-full absolute h-80 w-[40%]  -bottom-24 left-0">
            </div>
        </div>
        <!-- Feature 6 -->
        <div class="relative mt-20 lg:mt-52">
            <div class="container flex flex-col lg:flex-row-reverse items-center justify-center gap-x-24">
                <!-- Image -->
                <div class="flex flex-1 justify-center z-10 mb-10- lg:mb-0" data-aos="fade-left">
                    <img class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-[1300px] md:h-full rounded-md"
                        src="./images/resources.png" alt="">
                </div>
                <!-- Content -->
                <div class="flex flex-1 flex-col items-center lg:items-start floating-element">
                    <h1 class="text-3xl text-maroon mt-10 xl:mt-0 font-roboto font-bold">Mental Health Resources</h1>
                    <p class="text-black my-4 text-center lg:text-left sm:w-3/4 lg:w-full">
                        Browse through different resources about mental health.
                    </p>
                </div>
            </div>
            <!-- Rounded Rectangle -->
            <div
                class="hidden lg:block overflow:hidden bg-maroon rounded-l-full absolute h-80 w-[40%]  -bottom-24 right-0">
            </div>
        </div>
    </section>
    <!-- About -->
    <section class="h-[1000px] xl:h-[600px] bg-pink w-full flex justify-center items-center section-content"
        id="about">

        <div class="flex-col container mx-auto flex items-center justify-between xl:p-8 xl:flex-row mt-36">
            <!-- About Text -->
            <div class="w-full xl:w-1/2" data-aos="zoom-out-right">
                <h2 class="text-4xl font-bold text-gray-800 mb-4 font-roboto">About MindScape</h2>
                <p class="text-gray-800 leading-loose">
                    Welcome to MindScape, a groundbreaking mental health awareness system designed for the Perpetual
                    Help System Dalta community. At MindScape, we believe in fostering a supportive environment and
                    promoting mental well-being among students, faculty, and staff.
                </p>
                <p class="text-gray-800 leading-loose">
                    Our mission is to provide resources, guidance, and a sense of community for individuals navigating
                    the complexities of mental health. MindScape offers a range of tools and information to help you on
                    your journey to mental well-being.
                </p>
            </div>
            <!-- About GIF -->
            <div class="w-full xl:w-1/2">
                <!-- Placeholder for GIF -->
                <img src="./images/about.gif" alt="MindScape in action" class="w-full max-w-md max-h-full mx-auto">
            </div>
        </div>
    </section>


    <section class="py-20 w-full h-[1000px] flex items-center justify-center relative section-content" id="contact">
        @if (session()->has('success'))
            <div class="absolute top-10 left-0 right-0 flex items-center justify-center w-full p-4 md:w-96 md:p-6"
                id="alert">
                <div class="bg-green-300 rounded-lg text-green-700 font-semibold shadow-md p-2 md:p-4 md:text-base">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="gradient xl:w-[60%] xl:h-[60%] rounded-2xl flex items-center shadow-lg flex-col xl:flex-row p-5 w-[70%]"
            data-aos="fade-up">
            <div class="xl:w-[40%] h-full flex flex-col justify-center items-center space-y-5 xl:space-y-0">

                <div class="w-full flex flex-col space-y-2 items-center justify-center h-full">
                    <i class="fas fa-map-marker-alt fa-2x text-yellow"></i>
                    <h1 class="text-gray-100 text-lg font-semibold">Address</h1>
                    <p class="text-gray-100">Blk 5 Lot 2 Las Pinas</p>
                </div>
                <div class="w-full flex flex-col space-y-2 items-center justify-center h-full">
                    <i class="fas fa-phone-alt fa-2x text-yellow"></i>
                    <h1 class="text-gray-100 text-lg font-semibold">Phone</h1>
                    <p class="text-gray-100">+639190005789</p>
                </div>
                <div class="w-full flex flex-col space-y-2 items-center justify-center h-full">
                    <i class="fas fa-envelope fa-2x text-yellow"></i>
                    <h1 class="text-gray-100 text-lg font-semibold">Email</h1>
                    <p class="text-gray-100">mindscapementalhealth331@gmail.com</p>
                </div>
            </div>

            <div class="grow w-full h-full p-8 relative overflow-hidden space-y-5">
                <div class="hidden border-l-2 border-gray-100 h-[80%] absolute left-0 top-12 xl:block"></div>
                <h1 class="text-yellow text-3xl font-bold text-center xl:text-left">Send us a message</h1>
                <form action="/contactUs" method="POST" class="flex flex-col space-y-4">
                    @csrf
                    <div class="flex flex-col space-y-2">
                        <input type="text" id="name" name="name" placeholder="Your Name"
                            class="border-2 rounded-md px-4 py-2 focus:outline-none focus:border-yellow transition duration-300"
                            required autocomplete="off">
                    </div>
                    <div class="flex flex-col space-y-2">

                        <input type="email" id="email" name="email" placeholder="Your Email"
                            class="border-2  rounded-md px-4 py-2 focus:outline-none focus:border-yellow transition duration-300"
                            required autocomplete="off">
                    </div>
                    <div class="flex flex-col space-y-2">

                        <textarea id="message" name="message" placeholder="Your Message"
                            class="border-2  rounded-md px-4 py-2 h-24 focus:outline-none focus:border-yellow transition duration-300" required
                            autocomplete="off"></textarea>
                    </div>
                    <button type="submit"
                        class="bg-yellow text-black font-semibold py-2 px-4 rounded hover:bg-amber-500 transition duration-300 xl:w-44 w-full">Send</button>
                </form>
            </div>

        </div>
    </section>


    <footer class="py-8 w-full bg-dark">
        <div class="container flex flex-col md:flex-row items-center">
            <div class="flex flex-1 flex-wrap items-center justify-center md:justify-start gap-12">
                <img class="w-[90px] h-[70px]" src="./images/logo.png" alt="MindScape Logo">
                <div>
                    <p class="text-yellow text-2xl ml-[-50px] font-bold">MindScape</p>
                </div>
                <ul class="flex text-white uppercase gap-12 text-xs">
                    <li class="cursor-pointer"><a href="#features">Features</a></li>
                    <li class="cursor-pointer"><a href="#about">About</a></li>
                    <li class="cursor-pointer"><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="flex gap-10 mt-12 md:mt-0">
                <a href="https://web.facebook.com/perpetual.lp" target="_blank">
                    <i class="text-2xl text-white fa-brands fa-facebook-square cursor-pointer"></i>
                </a>
                <a href="https://twitter.com/PerpetualLP" target="_blank">
                    <i class="text-2xl text-white fa-brands fa-twitter-square cursor-pointer"></i>
                </a>
            </div>
        </div>
    </footer>

</body>
<div id="scrollArrowContainer"
    class="fixed bottom-8 right-8 cursor-pointer opacity-0 transition-opacity duration-300 hidden md:block z-50">
    <div class="bg-maroon p-2 rounded-xl">
        <i class="text-3xl text-white fas fa-chevron-up"></i>
    </div>
</div>
<script>
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        useClassNames: true,
        initClassName: false,
        animatedClassName: 'animated',
        selector: '*[data-aos]',
    });

    function fadeOutAlert(alertId) {
        setTimeout(function() {
            var alert = document.getElementById(alertId);
            if (alert) {
                alert.style.transition = "opacity 1s";
                alert.style.opacity = 0;
                setTimeout(function() {
                    alert.style.display = "none";
                }, 1000);
            }
        }, 5000); // 2500 milliseconds (2.5 seconds)
    }

    // Call the fadeOutAlert function for each alert message
    fadeOutAlert("alert");

    document.addEventListener("DOMContentLoaded", function() {
        var scrollArrowContainer = document.getElementById("scrollArrowContainer");

        function toggleScrollArrow() {
            if (document.body.scrollTop > window.innerHeight / 2 || document.documentElement.scrollTop > window
                .innerHeight / 2) {
                scrollArrowContainer.style.opacity = "1";
            } else {
                scrollArrowContainer.style.opacity = "0";
            }
        }

        window.onscroll = function() {
            toggleScrollArrow();
        };

        scrollArrowContainer.addEventListener("click", function() {
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        });
    });
</script>

</html>
