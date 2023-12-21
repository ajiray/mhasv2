@extends('layouts.adminlayout')

@section('content')
    <script>
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
            }, 2500);
        }
        fadeOutAlert("alert");
    </script>
    <script src="{{ asset('js/resources.js') }}" defer></script>

    <div class="absolute top-2 w-96 text-center">
        @if (session()->has('success'))
            <div id="alert" class="bg-green-300 p-3 rounded-lg text-green-700 font-semibold shadow-md">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div id="alert" class="bg-red-300 p-3 rounded-lg text-red-700 font-semibold shadow-md">
                {{ session('error') }}
            </div>
        @endif

        @if (session()->has('tooLarge'))
            <div id="alert" class="bg-red-300 p-3 rounded-lg text-red-700 font-semibold shadow-md">
                {{ session('tooLarge') }}
            </div>
        @endif
    </div>

    <div
        class="h-screen-200vh w-full xl:h-full flex justify-start xl:justify-center items-center flex-col space-y-20 xl:space-y-0 xl:flex-row xl:space-x-20">
        <div class="w-[80%] flex flex-col items-center justify-center xl:mt-0 xl:w-[40%] xl:h-[80%]">
            <h1 class="text-3xl font-semibold mb-4 mt-10 xl:mt-0">UPLOAD RESOURCES HERE</h1>

            <form action="{{ route('store-resource') }}" method="POST" id="resource-form"
                class="flex flex-col space-y-4 w-full p-8 bg-gray-100 rounded-md shadow-md" enctype="multipart/form-data">
                @csrf
                <select name="category" id="category" class="border p-2" onchange="toggleInputs()">
                    <option value="" disabled selected>Select Category</option>
                    <option value="pdf">PDF</option>
                    <option value="video">VIDEO</option>
                    <option value="infographic">INFOGRAPHIC</option>
                    <option value="ebook">E-BOOK</option>
                </select>

                <label for="title" class="text-sm font-medium hidden" id="title-label">Title</label>
                <input type="text" name="title" id="title" class="border p-2 hidden">

                <label for="description" class="text-sm font-medium hidden" id="description-label">Description</label>
                <input type="text" name="description" id="description" class="border p-2 hidden">

                <label for="file_content" class="text-sm font-medium hidden" id="pdf-label">PDF</label>
                <input type="file" name="file_content" id="file_content" accept=".pdf" class="border p-2 hidden">

                <label for="file_cover" class="text-sm font-medium hidden" id="cover-photo-label">Cover Photo</label>
                <input type="file" name="file_cover" id="file_cover" accept="image/*" class="border p-2 hidden">

                <label for="video" class="text-sm font-medium hidden" id="youtube-link-label">Video</label>
                <input type="file" name="video" id="video" class="border p-2 hidden" accept="video/*">

                <label for="infographic" class="text-sm font-medium hidden" id="infographic-label">Infographic</label>
                <input type="file" name="infographic" id="infographic" accept="image/*" class="border p-2 hidden">

                <label for="ebook" class="text-sm font-medium hidden" id="ebook-label">E-Book</label>
                <input type="file" name="ebook" id="ebook" accept=".pdf, .epub, .mobi" class="border p-2 hidden">

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700 hidden"
                    id="submitRes">Add
                    Resource</button>
            </form>
        </div>

        <div
            class="w-[80%] h-[50%] xl:w-[40%] bg-gradient-to-b from-adminPrimary to-gradientBlue p-6 rounded-md shadow-md overflow-y-auto xl:h-[80%]">
            <h1 class="text-2xl font-semibold text-white mb-4 text-center">Resources</h1>

            @foreach ($resources as $resource)
                <div class="bg-white p-4 rounded-md mb-4">
                    <div class="flex justify-between">
                        <div>
                            <div class="mb-2">
                                <label class="text-gray-700 font-semibold" for="title">Title:</label>
                                <h2 class="text-lg font-semibold text-gray-800">{{ $resource->title }}</h2>
                            </div>
                            <div class="mb-2">
                                <label class="text-gray-700 font-semibold" for="description">Description:</label>
                                <p class="text-gray-600">{{ $resource->description }}</p>
                            </div>

                            <div class="flex items-center justify-between">
                                <!-- Add a delete button with confirmation dialog -->
                                <form id="deleteForm{{ $resource->id }}" action="/delete-resource/{{ $resource->id }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-700"
                                        onclick="confirmDelete({{ $resource->id }})">Delete</button>
                                </form>
                            </div>
                        </div>

                        <div>
                            <!-- Display the appropriate content based on resource category -->
                            @if ($resource->category === 'infographic' && $resource->file_content)
                                <img src="{{ asset('storage/resources/' . $resource->file_content) }}" alt="Infographic"
                                    class="w-48 h-auto rounded-md">
                            @elseif (in_array($resource->category, ['pdf', 'ebook']) && $resource->file_cover)
                                <img src="{{ asset('storage/covers/' . $resource->file_cover) }}" alt="Cover Photo"
                                    class="w-48 h-auto rounded-md">
                            @elseif ($resource->category === 'video' && $resource->file_content)
                                <!-- Display video -->
                                <video width="320" height="240" controls>
                                    <source src="{{ asset('storage/resources/' . $resource->file_content) }}"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <script>
            function confirmDelete(resourceId) {
                if (confirm('Are you sure you want to delete this resource?')) {
                    // Proceed with form submission
                    document.getElementById('deleteForm' + resourceId).submit();
                } else {
                    // Prevent form submission if the user cancels
                    event.preventDefault(); // Add this line to prevent the default form submission
                }
            }
        </script>


    </div>
@endsection
