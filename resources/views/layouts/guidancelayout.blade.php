<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="icon" href="public/images/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

</head>

<body class="overflow-x-hidden">

    <div class='h-full w-full xl:h-screen xl:w-screen xl:justify-center xl:flex-row xl:items-center'>

        <x-guidancenavbar :notifications="auth()->user()->notifications" :unreadnotifications="auth()
            ->user()
            ->notifications->whereNull('read_at')
            ->count()" :notseen="auth()
            ->user()
            ->notSeenMessagesCount()" />

        <div class="w-full h-full overflow-y-auto">
            @yield('content')
        </div>




    </div>




</body>

</html>
