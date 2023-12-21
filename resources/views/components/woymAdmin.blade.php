<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="public/css/output.css">
</head>

<body>
    <div
        class="mt-10 sm:mt-20 md:mt-10 xl:mt-5 px-3 py-3 sm:px-5 sm:py-5 md:px-5 md:py-5 xl:px-5 xl:py-5 rounded-lg shadow-lg border-2 border-gray-300 bg-white relative">
        <form action="/create-post-admin" method="POST">
            @csrf
            <div class="flex flex-col sm:flex-row sm:space-x-3 md:flex-row md:space-x-3 items-center">
                <input type="text" name="body" id="body" placeholder="What's on your mind?" maxlength="200"
                    autocomplete="off" required
                    class="py-1 px-2 sm:py-2 sm:px-3 w-64 sm:w-80 md:w-96 lg:w-[700px] rounded-lg font-semibold border-2 border-gray-300"
                    onkeypress="preventEnterSubmit(event)">

                <!-- Add the checkbox for announcement posting -->
                <div id="optionPost"
                    class="space-y-3 flex-col absolute right-0 h-full w-full justify-center flex items-center hidden bg-white border border-gray-300 shadow-lg rounded-lg animate__animated xl:space-x-5 xl:space-y-0 xl:flex-row">

                    <button type="button" class="material-symbols-outlined absolute top-0 right-0 text-gray-600"
                        onclick="closeOptions(event)">
                        Close
                    </button>
                    <button onclick="postAnnouncement()"
                        class="py-2 px-4 @if (auth()->user()->is_admin == 1) bg-adminPrimary hover:bg-sky-800 text-adminSecondary @else bg-guidancePrimary hover:bg-orange-700 text-guidanceSecondary @endif
                        font-semibold font-semibold rounded-full">POST
                        AS
                        ANNOUNCEMENT
                    </button>
                    <button onclick="postNormally()"
                        class="py-2 px-4 @if (auth()->user()->is_admin == 1) bg-adminPrimary hover:bg-sky-800 text-adminSecondary @else bg-guidancePrimary hover:bg-orange-700 text-guidanceSecondary @endif
                        font-semibold font-semibold rounded-full">POST
                        NORMALLY</button>
                </div>

                <div class="flex items-center mt-3 sm:mt-0 md:mt-0 xl:mt-0 hidden">
                    <input type="checkbox" name="announcement" id="announcement" class="mr-2">

                </div>

                <button type="button" onclick="toggleOptions()"
                    class="w-[50%] py-2 sm:py-2 sm:w-[30%] md:py-2 md:w-[20%] xl:py-2 xl:w-[20%] mt-3 sm:mt-0 md:mt-0 xl:mt-0 rounded-lg
    @if (auth()->user()->is_admin == 1) bg-adminPrimary hover:bg-sky-800 text-adminSecondary @else bg-guidancePrimary hover:bg-orange-700 text-guidanceSecondary @endif
    font-semibold">
                    <i class="fa-solid fa-paper-plane fa-lg"></i>
                </button>

            </div>
        </form>
    </div>
    <script>
        function toggleOptions(event) {
            var optionPost = document.getElementById("optionPost");
            var inputField = document.getElementById("body");

            // Check if the input field is empty
            if (inputField.value.trim() === "") {
                // Don't show the pop-up if the input is empty
                return;
            }

            // Toggle the visibility of the pop-up
            optionPost.classList.toggle("hidden");
            optionPost.classList.add("animate__fadeInUp");

            // Stop event propagation

        }

        function closeOptions(event) {
            var optionPost = document.getElementById("optionPost");

            // Add the slide-out animation class
            optionPost.classList.add("animate__fadeOutDown");

            // Remove the slide-in animation class
            optionPost.classList.remove("animate__fadeInUp");

            // After the animation is complete, hide the options and reset classes
            setTimeout(function() {
                optionPost.classList.add("hidden");
                optionPost.classList.remove("animate__fadeOutDown");
            }, 800); // Adjust the timeout based on your animation duration

            // Stop event propagation

        }

        function preventEnterSubmit(event) {
            // Prevent form submission on Enter key press
            if (event.key === "Enter") {
                event.preventDefault();
            }
        }

        function postAnnouncement() {
            document.getElementById("announcement").checked = true;
            document.forms[0].submit();
        }

        function postNormally() {
            document.getElementById("announcement").checked = false;
            document.forms[0].submit();
        }
    </script>
</body>

</html>
