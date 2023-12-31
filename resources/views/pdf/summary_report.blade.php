<!-- resources/views/pdf/summary_report.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUMMARY REPORT</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <h1>SUMMARY REPORT</h1>

    <p>Total Appointments: {{ $totalCount }}</p>

    @if ($filteredSummaries->isEmpty())
        <p class="text-gray-600">No summary data available.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Counselor</th>
                    <th>Program</th>
                    <th>Reason</th>
                    <th>Type</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($filteredSummaries as $summary)
                    <tr>
                        <td>
                            {{ $summary->student->firstname }}
                            @if ($summary->student->middlename)
                                {{ $summary->student->middlename }}
                            @endif
                            {{ $summary->student->lastname }}
                        </td>
                        <td>{{ $summary->counselor->firstname }}</td>
                        <td>{{ $summary->course }}</td>
                        <td>{{ $summary->reason }}</td>
                        <td>{{ $summary->type }}</td>
                        <td>{{ \Carbon\Carbon::parse($summary->date)->format('F d, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>

</html>
