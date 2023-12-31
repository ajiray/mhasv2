@extends('layouts.adminlayout')

@section('content')
<div class="container mx-auto mt-8 flex">
    @if (session()->has('success'))
        <div id="alert" class="bg-green-300 p-3 rounded-lg text-green-700 font-semibold shadow-md h-11 absolute">
            {{ session('success') }}
        </div>
    @endif
    <!-- Create Event Form (Left Side) -->
    <div class="max-w-md bg-white p-8 rounded shadow-md mr-4 w-[50%]">
        <h2 class="text-2xl font-semibold mb-6">Create Event</h2>
        <form method="post" action="/events.store">
            @csrf

            <!-- Form fields for creating an event -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Event Name:</label>
                <input type="text" class="form-input w-full border border-gray-300 " id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="mb-4">
                <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Event Date:</label>
                <input type="date" class="form-input w-full border border-gray-300" id="date" name="date">
            </div>
            
            <script>
                // Get the current date in the format 'YYYY-MM-DD'
                var currentDate = new Date().toISOString().split('T')[0];
            
                // Set the minimum date for the input element
                document.getElementById('date').setAttribute('min', currentDate);
            </script>

            <div class="mb-4">
                <label for="time" class="block text-gray-700 text-sm font-bold mb-2">Event Time:</label>
                <input type="time" class="form-input w-full border border-gray-300" id="time" name="time" value="{{ old('time') }}" required>
            </div>

            <div class="mb-4">
                <label for="location" class="block text-gray-700 text-sm font-bold mb-2">Event Location:</label>
                <input type="text" class="form-input w-full border border-gray-300" id="location" name="location" value="{{ old('location') }}" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Event Description:</label>
                <textarea class="form-textarea w-full border border-gray-300" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Event</button>
        </form>
    </div>

    <!-- Uploaded Events (Right Side) -->
    <div class="flex-1 p-8 rounded-xl shadow-md w-[50%] text-center bg-gradient-to-b from-adminPrimary to-gradientBlue overflow-y-auto">
        <h2 class="text-2xl font-semibold mb-6 text-white">Uploaded Events</h2>

        <!-- Display uploaded events with options to edit or delete -->
        @foreach($events as $event)
            <div class="mb-4 border border-black bg-white rounded-xl">
                <!-- Event details display -->
                <h3 class="text-2xl font-semibold">{{ $event->name }}</h3>
                <p class="font-bold">Date: {{ $event->date }}</p> 
                <p class="font-bold">Time: {{ $event->time }}</p> 
                <p class="font-bold">Location: {{ $event->location }}</p>
                <p class="font-bold">Description: {{ $event->description }}</p>
                
                <!-- Edit and Delete buttons -->
                <div class="mt-2">
                    <a href="javascript:void(0);" onclick="openEditModal({{ $event->id }}, '{{ $event->name }}', '{{ $event->date }}', '{{ $event->time }}', '{{ $event->location }}', '{{ $event->description }}');" class="text-blue-500 hover:underline mr-4">Edit</a>

                    <form action="{{ route('events.destroy', $event->id) }}" method="post" class="inline" onsubmit="return confirm('Are you sure you want to delete this event?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@foreach($events as $event)
<!-- Edit Event Modal and Overlay -->
<div id="editModalOverlay" class="hidden fixed inset-0 bg-black opacity-50 z-50"></div>
<div id="editModal" class="hidden fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-white p-8 rounded shadow-md">
        <h2 class="text-2xl font-semibold mb-6">Edit Event</h2>
        <form id="editEventForm" method="post" action="/events/{{ $event->id }}">
            @csrf
            @method('PUT')

            <!-- Form fields for editing an event -->
            <div class="mb-4">
                <label for="edit_name" class="block text-gray-700 text-sm font-bold mb-2">Event Name:</label>
                <input type="text" class="form-input w-full border border-gray-300" id="edit_name" name="edit_name">
            </div>

            <div class="mb-4">
                <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Event Date:</label>
                <input type="date" class="form-input w-full border border-gray-300" id="edit_date" name="edit_date">
            </div>
            
            <script>
                // Get the current date in the format 'YYYY-MM-DD'
                var currentDate = new Date().toISOString().split('T')[0];
            
                // Set the minimum date for the input element
                document.getElementById('edit_date').setAttribute('min', currentDate);
            </script>

            <div class="mb-4">
                <label for="time" class="block text-gray-700 text-sm font-bold mb-2">Event Time:</label>
                <input type="time" class="form-input w-full border border-gray-300" id="edit_time" name="edit_time">
            </div>

            <div class="mb-4">
                <label for="location" class="block text-gray-700 text-sm font-bold mb-2">Event Location:</label>
                <input type="text" class="form-input w-full border border-gray-300" id="edit_location" name="edit_location">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Event Description:</label>
                <textarea class="form-textarea w-full border border-gray-300" id="edit_description" name="edit_description" rows="3"></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Event</button>
        </form>
        <button id="closeEditModal" class="mt-4 text-gray-500 hover:underline">Cancel</button>
    </div>
</div>

<script>
    // JavaScript code for handling modal interactions
    // Function to open the edit modal
    function openEditModal(eventId, eventName, eventDate, eventTime, eventLocation, eventDescription) {      
        document.getElementById('edit_name').value = eventName;
        document.getElementById('edit_date').value = eventDate;
        document.getElementById('edit_time').value = eventTime;
        document.getElementById('edit_location').value = eventLocation;
        document.getElementById('edit_description').value = eventDescription;
        // Similar lines for other form fields
        // Set the form action dynamically based on the event ID
        document.getElementById('editEventForm').action = `/events/${eventId}`;
        
        // Show the modal and overlay
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModalOverlay').classList.remove('hidden');
    }

    // Function to close the edit modal
    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('editModalOverlay').classList.add('hidden');
    }

    // Event listener for close button
    document.getElementById('closeEditModal').addEventListener('click', closeEditModal);

    // Event listener for overlay click to close the modal
    document.getElementById('editModalOverlay').addEventListener('click', closeEditModal);
</script>
@endforeach
@endsection
