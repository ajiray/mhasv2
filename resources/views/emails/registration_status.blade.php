<p>Hello {{ $userName }},</p>

@if ($status === 'approved')
    <p>Your registration has been approved. You can now log in to your account.</p>
@else
    <p>We regret to inform you that your registration has been declined.</p>
@endif

<p>Thank you for your interest.</p>
