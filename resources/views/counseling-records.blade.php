@extends(Auth::user()->is_admin == 1 ? 'layouts.adminlayout' : 'layouts.guidancelayout')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="stylesheet" href="resources/js/bootstrap.js">
        <style>
            .card {
                width: 90%;
                max-width: 900px;
                height: 700px;
                margin: 20px auto;
                border-radius: 8px;
                z-index: 1;
                padding: 20px;
                margin-top: 100px;
            }

            .tools {
                display: flex;
                align-items: center;
                padding: 9px;
            }

            .circle {
                padding: 0 4px;
            }

            .box {
                display: inline-block;
                align-items: center;
                width: 10px;
                height: 10px;
                padding: 1px;
                border-radius: 50%;
            }

            .red {
                background-color: #ff605c;
            }

            .yellow {
                background-color: #ffbd44;
            }

            .green {
                background-color: #00ca4e;
            }

            /* Styles for the modal */

            .modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                justify-content: center;
                align-items: center;
            }

            .modal-content {
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                overflow: auto;
                /* Add overflow property */
                max-height: 80vh;
                /* Set a maximum height */
                width: 100%;
                /* Set full width */
            }

            /* Add media query for mobile view */
            @media only screen and (max-width: 767px) {
                .modal-content {
                    height: 100%;
                    /* Set full height on mobile view */
                    max-height: none;
                    /* Remove max-height on mobile view */
                }

                /* Make child elements display in one column */
                .modal-content>* {
                    width: 100%;
                    box-sizing: border-box;
                    margin-bottom: 12px;
                }
            }

            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }

            .modal-container {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                justify-content: center;
                align-items: center;
            }

            .modal-content-container {
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                overflow: auto;
                /* Add overflow property */
                max-height: 80vh;
                /* Set a maximum height */
            }

            .modal-label {
                display: block;
                margin-bottom: 8px;
            }

            .modal-textarea,
            .modal-input {
                width: 100%;
                border: 1px solid #ccc;
                padding: 8px;
                border-radius: 4px;
                margin-bottom: 12px;
            }

            .modal-button {
                border: 1px solid #333;
                background-color: #555;
                color: white;
                padding: 8px 16px;
                border-radius: 4px;
                cursor: pointer;
            }

            .modal-title {
                font-size: 20px;
            }

            .modal-close {
                position: absolute;
                top: 10px;
                right: 10px;
                cursor: pointer;
            }
        </style>
    </head>

    <body>
        <div
            class="card bg-gradient-to-b {{ Auth::user()->is_admin == 1 ? 'from-adminPrimary to-gradientBlue' : (Auth::user()->is_admin == 2 ? 'from-guidancePrimary to-orange-950' : '') }}">

            <div class="tools">
                <div class="circle">
                    <span class="red box"></span>
                </div>
                <div class="circle">
                    <span class="yellow box"></span>
                </div>
                <div class="circle">
                    <span class="green box"></span>
                </div>
            </div>
            <div class="flex items-start justify-center">
                <h1 class="font-bold text-white p-4 font-serif text-xl md:text-3xl">
                    Guidance Counseling Records
                </h1>
            </div>
            @if (isset($studentNumber))
                <x-searchforstudents :studentNumber="$studentNumber" />
            @else
                <x-searchforstudents />
            @endif
            @if (session()->has('error'))
                <div class=" top-0 left-0 mt-4" id="errorAlert">
                    <div class="bg-red-300 p-3 rounded-lg text-white font-semibold shadow-md text-center">
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @if (session()->has('success'))
                <div class=" top-0 left-0 mt-2 " id="successAlert">
                    <div class="bg-green-300 p-3 rounded-lg text-green-700 font-semibold shadow-md text-center">
                        {{ session('success') }}
                    </div>
                    <script>
                        // Close the pop-up window after 3 seconds (3000 milliseconds)
                        setTimeout(function() {
                            window.close();
                        }, 3000);
                    </script>
                </div>
            @endif

            <script>
                // Set timeout for error alert
                setTimeout(function() {
                    var errorAlert = document.getElementById('errorAlert');
                    if (errorAlert) {
                        errorAlert.style.display = 'none';
                    }
                }, 3000); // 3000 milliseconds (3 seconds)
            </script>


            @if (isset($user))
                <div class="mt-4">
                    <h2 class="text-lg font-semibold">Counseling Records for Student: {{ $studentNumber }}</h2>
                    <div class="border p-4 mt-2">
                        <!-- Additional details about the student -->
                        <p><strong>Name:</strong> {{ $user->firstname }}
                            @if ($user->middlename)
                                {{ $user->middlename }}
                            @endif
                            {{ $user->lastname }}
                        </p>
                        <p><strong>Course:</strong> {{ $user->course }}</p>
                        <!-- Add other fields as needed -->
                    </div>
                    @if (isset($counselingRecords) && !$counselingRecords->isEmpty())
                        <div class="mt-4">
                            <h2 class="text-lg font-semibold">Previous Records</h2>
                            <ul class="list-group">
                                @foreach ($counselingRecords as $record)
                                    <li class="list-group-item">
                                        <!-- Make the date a link to view the record details -->
                                        <a href="javascript:void(0);"
                                            onclick="openModal('{{ $record->id }}', '{{ $record->user->name }}', '{{ $record->counseled_by }}', '{{ $record->findings }}', '{{ $record->present_conditions }}', '{{ $record->conclusions }}', '{{ $record->recommendations }}', '{{ $record->difficulties }}', '{{ $record->background_of_study }}')">
                                            Counseling Session {{ $loop->iteration }} - {{ $record->updated_at }}
                                        </a>

                                        <!-- Modal for record details -->
                                        <div id="myModal{{ $record->id }}" class="modal">
                                            <div class="modal-content">
                                                <span class="close"
                                                    onclick="closeModal('{{ $record->id }}')">&times;</span>
                                                <h2>Counseling Record of: {{ $record->user->name }}</h2>
                                                <!-- Add a hidden div to display the record details -->
                                                <div id="recordDetails{{ $record->id }}"
                                                    class="mt-2 p-4 border border-gray-300 rounded-lg shadow-lg bg-white">
                                                    <h5 class="text-lg font-semibold mb-3">Details:</h5>
                                                    <dl class="grid grid-cols-2 gap-4">
                                                        <div class="mb-4 border-2">
                                                            <dt class="text-gray-600">Counseled by:</dt>
                                                            <dd class="text-black">{{ $record->counseled_by }}</dd>
                                                        </div>

                                                        <div class="mb-4 border-2">
                                                            <dt class="text-gray-600">Findings:</dt>
                                                            <dd class="text-black">{{ $record->findings }}</dd>
                                                        </div>

                                                        <div class="mb-4">
                                                            <dt class="text-gray-600">Present Conditions:</dt>
                                                            <dd class="text-black">{{ $record->present_conditions }}
                                                            </dd>
                                                        </div>

                                                        <div class="mb-4">
                                                            <dt class="text-gray-600">Conclusions:</dt>
                                                            <dd class="text-black">{{ $record->conclusions }}</dd>
                                                        </div>

                                                        <div class="mb-4">
                                                            <dt class="text-gray-600">Recommendations:</dt>
                                                            <dd class="text-black">{{ $record->recommendations }}</dd>
                                                        </div>

                                                        <div class="mb-4">
                                                            <dt class="text-gray-600">Difficulties:</dt>
                                                            <dd class="text-black">{{ $record->difficulties }}</dd>
                                                        </div>

                                                        <div class="mb-4">
                                                            <dt class="text-gray-600">Background of the Study:</dt>
                                                            <dd class="text-black">{{ $record->background_of_study }}</dd>
                                                        </div>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <p>No Counseling Records Found for {{ $user->name }}</p>
                    @endif
                </div>
                <div class="mt-4">
                    <button onclick="showAddRecordForm('{{ $studentNumber }}')"
                        class="border bg-adminPrimary rounded-3xl w-[125px] text-white mx-2">Add a Record</button>
                </div>

                <script>
                    function showRecordDetails(recordId, name) {
                        // Open a new window with the record details
                        const detailsWindow = window.open('', 'Record Details', 'width=600,height=400');
                        detailsWindow.document.write(`<html><head><title>Record Details</title></head><body>`);
                        detailsWindow.document.write(`<h1>Counseling Record of: ${name}</h1>`);
                        detailsWindow.document.write(document.getElementById(`recordDetails${recordId}`).innerHTML);
                        detailsWindow.document.write(`</body></html>`);
                        detailsWindow.document.close();
                    }

                    function openModal(recordId, name, counseledBy, findings, presentConditions, conclusions, recommendations,
                        difficulties, backgroundOfStudy) {
                        // Get the modal element
                        var modal = document.getElementById("myModal" + recordId);

                        // Display the modal
                        modal.style.display = "block";

                        // Populate modal content
                        var modalContent = modal.querySelector('.modal-content');
                        modalContent.innerHTML = `
            <span class="close" onclick="closeModal('${recordId}')">&times;</span>
            <h2>Counseling Record of: ${name}</h2>
            <div id="recordDetails${recordId}" class="mt-2 p-4 border border-gray-300 rounded-lg shadow-lg bg-white">
                <h5 class="text-lg font-semibold mb-3">Details:</h5>
                <dl class="grid grid-cols-2 gap-4">
                    <div class="mb-4 border-2 rounded-xl p-2">
                        <dt class="text-gray-600 font-bold">Counseled by:</dt>
                        <dd class="text-black">${counseledBy}</dd>
                    </div>

                    <div class="mb-4 border-2 rounded-xl p-2">
                        <dt class="text-gray-600 font-bold">Findings:</dt>
                        <dd class="text-black">${findings}</dd>
                    </div>

                    <div class="mb-4 border-2 rounded-xl p-2">
                        <dt class="text-gray-600 font-bold">Present Conditions:</dt>
                        <dd class="text-black">${presentConditions}</dd>
                    </div>

                    <div class="mb-4 border-2 rounded-xl p-2">
                        <dt class="text-gray-600 font-bold">Conclusions:</dt>
                        <dd class="text-black">${conclusions}</dd>
                    </div>

                    <div class="mb-4 border-2 rounded-xl p-2">
                        <dt class="text-gray-600 font-bold">Recommendations:</dt>
                        <dd class="text-black">${recommendations}</dd>
                    </div>

                    <div class="mb-4 border-2 rounded-xl p-2">
                        <dt class="text-gray-600 font-bold">Difficulties:</dt>
                        <dd class="text-black">${difficulties}</dd>
                    </div>

                    <div class="mb-4 border-2 rounded-xl p-2">
                        <dt class="text-gray-600 font-bold">Background of the Study:</dt>
                        <dd class="text-black">${backgroundOfStudy}</dd>
                    </div>
                </dl>
            </div>`;
                    }

                    function closeModal(recordId) {
                        // Get the modal element
                        var modal = document.getElementById("myModal" + recordId);

                        // Hide the modal
                        modal.style.display = "none";
                    }

                    // Close the modal if the user clicks outside of it
                    window.onclick = function(event) {
                        if (event.target.className === "modal") {
                            event.target.style.display = "none";
                        }
                    };

                    function showAddRecordForm(studentId) {
                        // Check if the modal container already exists
                        var modal = document.getElementById('addRecordModal');

                        // If the modal doesn't exist, create and append it to the body
                        if (!modal) {
                            modal = document.createElement('div');
                            modal.className = 'modal-container';
                            modal.id = 'addRecordModal';
                            document.body.appendChild(modal);
                        }

                        // Include styles directly in the HTML
                        modal.innerHTML = `
                <div class="modal-content-container">
                    <span class="modal-close" onclick="closeAddRecordModal()">&times;</span>
                    <form action="{{ route('counseling-records.create') }}?studentId=${studentId}" method="GET">
                        @csrf
                        <input type="hidden" name="student_id" value="{{ $user->id }}">
                        <div class="mt-4">
                            <h1 class="modal-title">Records For: {{ $user->name }}</h1>
                        </div>
                        <div class="mt-4">
                            <label for="newFindings" class="modal-label">Findings:</label>
                            <textarea id="newFindings" name="findings" class="modal-textarea"
                                placeholder="Enter new findings..."></textarea>
                        </div>

                        <div class="mt-4">
                                    <label for="newPresentConditions">Present Conditions:</label>
                                    <textarea id="newPresentConditions" name="presentconditions" class="w-full border p-2 rounded-xl" placeholder="Enter Present Conditions..."></textarea>
                                </div>

                                <div class="mt-4">
                                    <label for="newConclusions">Conclusions:</label>
                                    <textarea id="newConclusions" name="conclusions" class="w-full border p-2 rounded-xl" placeholder="Enter Conclusions..."></textarea>
                                </div>

                                <div class="mt-4">
                                    <label for="newRecommendations">Recommendations:</label>
                                    <textarea id="newRecommendations" name="recommendations" class="w-full border p-2 rounded-xl" placeholder="Enter Recommendations..."></textarea>
                                </div>

                                <div class="mt-4">
                                    <label for="newDifficulties">Difficulties:</label>
                                    <textarea id="newDifficulties" name="difficulties" class="w-full border p-2 rounded-xl" placeholder="Enter Difficulties..."></textarea>
                                </div>

                                <div class="mt-4">
                                    <label for="newBackground">Background of the Study:</label>
                                    <textarea id="newBackground" name="backgroundOfStudy" class="w-full border p-2 rounded-xl" placeholder="Enter Background of the Study..."></textarea>
                                </div>

                        <div class="mt-4">
                            <button type="submit" class="modal-button">Save</button>
                            <button type="button" onclick="closeAddRecordModal()" class="modal-button">Cancel</button>
                        </div>
                    </form>
                </div>
            `;

                        // Display the modal
                        modal.style.display = 'flex';
                    }

                    function closeAddRecordModal() {
                        var modal = document.getElementById('addRecordModal');
                        if (modal) {
                            modal.style.display = 'none';
                        }
                    }

                    // Close the modal if the user clicks outside of it
                    window.onclick = function(event) {
                        var modal = document.getElementById('addRecordModal');
                        if (modal && event.target === modal) {
                            closeAddRecordModal();
                        }
                    };
                </script>
            @else
                <p></p>
            @endif
        </div>
    </body>

    </html>

@endsection
