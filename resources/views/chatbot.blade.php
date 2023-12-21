<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        ::-webkit-scrollbar {
            width: 5px;
        }
    </style>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="w-full h-full flex flex-col justify-between">
        <div class="flex items-center justify-center p-1 w-full bg-maroon mt-5 xl:mt-0">
            <div style="width: 95px; height: 75px;" class="hidden xl:block">
                <img src="./images/logo.png" class="w-full h-full rounded-full" alt="Logo">
            </div>
            <div class="text-white font-bold text-2xl ml-2 mt-0 xl:mt-6 p-5 xl:p-0">
                MindScape ChatBot
            </div>
        </div>

        <div id="content-box" class="flex-grow-1 p-1 overflow-y-scroll bg-slate-300 xl:h-full text-white h-[670px]">

        </div>

        <div class="flex justify-center items-center p-2 bg-maroon h-11">
            <div class="pr-2 w-2/4 bg-white bg-opacity-28 rounded-2xl">
                <input id="input"
                    class="text-black h-10 w-full bg-transparent border-0 outline-none pl-2 text-center" type="text"
                    name="input" placeholder="Ask something!">
            </div>

            <div id="button-submit" class="flex items-center justify-center bg-#5c211d rounded-2xl w-12 cursor-pointer">
                <i class="fa-solid fa-paper-plane fa-beat text-white"></i>
            </div>
        </div>
    </div>


    <!-- Move the JavaScript here -->
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#button-submit').on('click', function() {
            var $value = $('#input').val();

            $('#content-box').append(`<div class="mb-2">
                <div class="float-right px-3 py-2 mt-2" style="width: 270px; background: #5c211d; border-radius: 10px; float: right; font-size: 85%">
                    ` + $value + `
                </div>
                <div style="clear: both;"></div>
            </div>`);

            $('#input').val(''); // Clear the input field

            $.ajax({
                type: 'post',
                url: '{{ url('send') }}',
                data: {
                    'input': $value
                },
                success: function(data) {
                    $('#content-box').append(`<div class="flex mb-2">
                        <div class="mr-2" style="width: 45px; height: 45px;">
                            <img src="https://cdn.iconscout.com/icon/free/png-256/free-avatar-370-456322.png?f=webp" width="100%" height="100%" style="border-radius: 50px;">
                        </div>
                        <div class="text-white px-3 py-2" style="width: 270px; background: #13254b; border-radius: 10px; font-size: 85%">
                            ` + data + `
                        </div>
                    </div>`);

                    $('#input').val(''); // Clear the input field
                }
            });
        });
    </script>
</body>

</html>
