<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Rescheduled</title>
</head>

<body>
    <p>Dear {{ $counselorName }},</p>

    <p>I hope this message finds you well. Unfortunately, I must inform you that I've encountered an unexpected
        emergency, and I am unable to proceed with our scheduled appointment.</p>

    <p>I apologize for any inconvenience this may cause, and I appreciate your understanding. As soon as my situation
        stabilizes, I will prioritize rescheduling our appointment. In the meantime, please let me know if there are any
        specific details or preferences you'd like me to consider when proposing a new time.</p>

    <!-- Display the rescheduled appointment details -->
    <p>Rescheduled Appointment Details:</p>
    <ul>
        <li>Date: {{ $appointment->date }}</li>
        <li>Time: {{ $appointment->time }}</li>
        <li>Type: {{ $appointment->type }}</li>
        <!-- Add any other appointment details you want to display -->
    </ul>

    <p>Thank you for your understanding and cooperation.</p>
    <p>Best regards,</p>
    <p>{{ $studentFullName }}<br>{{ $studentId }}</p>
</body>

</html>
