<!-- resources/views/emails/reschedule-notification.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Rescheduled</title>
</head>

<body>
    <p>Hello {{ $user->name }},</p>

    <p>We regret to inform you that due to an emergency, your appointment has been cancelled.</p>

    <p>While we understand this might be inconvenient, we want to assure you that your well-being is our top priority.
        We encourage you to set a new appointment at your earliest convenience, and this time, you will be our priority.
        If you have any specific preferences or requirements, please let us know, and we'll do our best to accommodate
        them.</p>

    <!-- Include any other relevant information -->

    <p>Thank you for your understanding and cooperation.</p>
    <p>Best regards,</p>
    <p>The MindScape Team</p>
</body>

</html>
