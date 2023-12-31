@extends('layouts.adminlayout')

@section('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <div class="max-w-[90%] mx-auto mt-10 flex justify-between space-x-5">
        <div class="w-1/4">
            <label for="counselorFilter" class="block text-sm font-medium text-gray-700 mb-2">Counselor:</label>
            <select name="counselorFilter" id="counselorFilter" class="w-full px-3 py-2 border rounded">
                <option value="">All Counselors</option>
                @foreach ($counselors as $counselor)
                    <option value="{{ $counselor->id }}">{{ $counselor->firstname }} {{ $counselor->lastname }}</option>
                @endforeach
            </select>
        </div>

        <div class="w-1/4">
            <label for="courseFilter" class="block text-sm font-medium text-gray-700 mb-2">Program:</label>
            <select name="courseFilter" id="courseFilter" class="w-full px-3 py-2 border rounded">
                <option value="">All Programs</option>
                @foreach ($programs as $program)
                    <option value="{{ $program }}">{{ $program }}</option>
                @endforeach
            </select>
        </div>

        <div class="w-1/4">
            <label for="reasonFilter" class="block text-sm font-medium text-gray-700 mb-2">Reason:</label>
            <select name="reasonFilter" id="reasonFilter" class="w-full px-3 py-2 border rounded">
                <option value="">All Reasons</option>
                @foreach ($reasons as $reason)
                    <option value="{{ $reason }}">{{ $reason }}</option>
                @endforeach
            </select>
        </div>

        <div class="w-1/4">
            <label for="typeFilter" class="block text-sm font-medium text-gray-700 mb-2">Type:</label>
            <select name="typeFilter" id="typeFilter" class="w-full px-3 py-2 border rounded">
                <option value="">All Types</option>
                <option value="online">Online</option>
                <option value="onsite">Onsite</option>
            </select>
        </div>

        <div class="w-1/4">
            <label for="fromDateFilter" class="block text-sm font-medium text-gray-700 mb-2">From:</label>
            <input type="date" name="fromDateFilter" id="fromDateFilter" class="w-full px-3 py-2 border rounded">
        </div>

        <div class="w-1/4">
            <label for="toDateFilter" class="block text-sm font-medium text-gray-700 mb-2">To:</label>
            <input type="date" name="toDateFilter" id="toDateFilter" class="w-full px-3 py-2 border rounded">
        </div>
    </div>

    <h1 class="text-3xl font-semibold mb-6 text-center mt-10">SUMMARY REPORT</h1>

    <div class="max-w-[90%] mx-auto mt-8 p-6 bg-white rounded shadow-md text-center">
        <div id="totalAppointments" class="w-full flex justify-between items-center">
            <div>Total Appointments: <span id="appointmentCount" class="font-bold">{{ $totalSummaries }}</span></div>

            <div>
                <button id="printPdfBtn" onclick="downloadPdf()"
                    class="ml-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-3">Download as PDF</button>
            </div>
        </div>

        @if ($summaries->isEmpty())
            <p class="text-gray-600">No summary data available.</p>
        @else
            <table class="min-w-full bg-white border border-gray-300 mt-4">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Student</th>
                        <th class="py-2 px-4 border-b">Counselor</th>
                        <th class="py-2 px-4 border-b">Program</th>
                        <th class="py-2 px-4 border-b">Reason</th>
                        <th class="py-2 px-4 border-b">Type</th>
                        <th class="py-2 px-4 border-b">Date</th>
                    </tr>
                </thead>
                <tbody id="summaryTableBody"> <!-- Add ID to tbody for updating in JavaScript -->
                    @foreach ($summaries as $summary)
                        <tr>
                            <td class="py-2 px-4 border-b">
                                {{ $summary->student->firstname }}
                                @if ($summary->student->middlename)
                                    {{ $summary->student->middlename }}
                                @endif
                                {{ $summary->student->lastname }}
                            </td>
                            <td class="py-2 px-4 border-b">{{ $summary->counselor->firstname }}</td>
                            <td class="py-2 px-4 border-b">{{ $summary->course }}</td>
                            <td class="py-2 px-4 border-b">{{ $summary->reason }}</td>
                            <td class="py-2 px-4 border-b">{{ $summary->type }}</td>
                            <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($summary->date)->format('F d, Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script>
        $(document).ready(function() {
            $('#counselorFilter, #courseFilter, #reasonFilter, #typeFilter, #fromDateFilter, #toDateFilter')
                .change(function() {
                    var counselorId = $('#counselorFilter').val();
                    var program = $('#courseFilter').val(); // Corrected ID to courseFilter
                    var reason = $('#reasonFilter').val();
                    var type = $('#typeFilter').val();
                    var fromDate = $('#fromDateFilter').val();
                    var toDate = $('#toDateFilter').val();


                    // Make an AJAX request to the server
                    $.ajax({
                        type: 'GET',
                        url: '/filter-summaries', // Adjust the URL to your route
                        data: {
                            counselorFilter: counselorId,
                            programFilter: program,
                            reasonFilter: reason,
                            typeFilter: type,
                            fromDateFilter: fromDate,
                            toDateFilter: toDate,
                        },
                        success: function(data) {


                            // Update the table body with the filtered data
                            var tbody = $('#summaryTableBody');
                            var totalCount = data.totalAppointments; // New property in the response

                            // Update the total count in the HTML
                            $('#appointmentCount').text(totalCount);
                            tbody.empty(); // Clear the existing table rows

                            // Append the new rows based on the filtered data
                            $.each(data.summaries, function(index, summary) {
                                var row = '<tr>' +
                                    '<td class="py-2 px-4 border-b">' + (summary.student ? (
                                        summary.student.firstname +
                                        (summary.student.middlename ? ' ' + summary
                                            .student.middlename : '') +
                                        ' ' + summary.student.lastname
                                    ) : '') + '</td>' +
                                    '<td class="py-2 px-4 border-b">' + (summary.counselor ?
                                        summary.counselor.firstname : '') + '</td>' +
                                    '<td class="py-2 px-4 border-b">' + summary.course +
                                    '</td>' +
                                    '<td class="py-2 px-4 border-b">' + summary.reason +
                                    '</td>' +
                                    '<td class="py-2 px-4 border-b">' + summary.type +
                                    '</td>' +
                                    '<td class="py-2 px-4 border-b">' + moment(summary.date)
                                    .format('MMMM D, Y') + '</td>' +
                                    '</tr>';

                                tbody.append(row);
                            });
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                });
        });

        function downloadPdf() {
            var counselorId = $('#counselorFilter').val();
            var program = $('#courseFilter').val();
            var reason = $('#reasonFilter').val();
            var type = $('#typeFilter').val();
            var fromDate = $('#fromDateFilter').val();
            var toDate = $('#toDateFilter').val();

            // Redirect to the download PDF route with filter parameters
            window.location.href = '{{ route('generate.pdf') }}?counselorFilter=' + counselorId +
                '&programFilter=' + program + '&reasonFilter=' + reason +
                '&typeFilter=' + type + '&fromDateFilter=' + fromDate + '&toDateFilter=' + toDate;
        }
    </script>

@endsection
