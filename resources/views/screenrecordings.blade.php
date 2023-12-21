@extends(Auth::user()->is_admin == 1 ? 'layouts.adminlayout' : 'layouts.guidancelayout')

@section('content')
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Recordings</title>
        <script src="https://cdn.metered.ca/sdk/video/1.4.5/sdk.min.js"></script>
        <!-- Include Tailwind CSS -->
        <link href="{{ asset('public/css/output.css') }}" rel="stylesheet">
    </head>

    <body class="bg-gray-100 h-screen flex items-center justify-center">

        <div class="max-w-md mx-auto bg-white p-8 rounded shadow-md">
            <h1 class="text-2xl font-bold mb-4">Recordings</h1>

            @foreach ($recordings['data'] as $recording)
                <div class="mb-4">
                    <p class="text-lg font-semibold mb-2">{{ $recording['room'] }}</p>
                    <a href="#" class="text-blue-500 font-bold"
                        onclick="viewRecording('{{ $recording['_id'] }}')">View Recording</a>
                    <br>
                    <a href="#" class="text-blue-500 font-bold"
                        onclick="downloadRecording('{{ $recording['_id'] }}')">Download Recording</a>
                </div>
            @endforeach
        </div>

        <iframe id="downloadFrame" style="display: none;"></iframe>

        <script>
            function viewRecording(recordingId) {
                // Fetch the view URL
                fetchViewUrl(recordingId);
            }

            function downloadRecording(recordingId) {
                // Fetch the download URL
                fetchDownloadUrl(recordingId);
            }

            function fetchViewUrl(recordingId) {
                // Fetch the secretKey securely
                const secretKey = 'gLgCp1VC7JuWBY6puHD6adthX0PvafGpvYi562wcKu8H13nq';

                // Fetch the view URL
                fetch(`https://mindscape.metered.live/api/v1/recording/${recordingId}/view?secretKey=${secretKey}`)
                    .then(response => response.json())
                    .then(data => {
                        // Redirect to the view URL in the same tab
                        window.open(data.url, '_blank');
                    });
            }

            function fetchDownloadUrl(recordingId) {
                // Fetch the secretKey securely
                const secretKey = 'gLgCp1VC7JuWBY6puHD6adthX0PvafGpvYi562wcKu8H13nq';

                // Fetch the download URL
                fetch(`https://mindscape.metered.live/api/v1/recording/${recordingId}/download?secretKey=${secretKey}`)
                    .then(response => response.json())
                    .then(data => {
                        // Create a hidden iframe for downloading
                        const iframe = document.getElementById('downloadFrame');
                        iframe.src = data.url;
                    });
            }
        </script>
    </body>




    </html>
@endsection
