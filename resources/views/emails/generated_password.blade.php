<!-- resources/views/emails/generated_password.blade.php -->

<p>Hello {{ $user->name }},</p>

<p> Your Account has been Approved.</p>

<p> Use this Login Credentials to login</p>

<p> Email : {{ $user->email }}</p>

<p>Password: <strong>{{ $temporaryPassword }}</strong></p>

<p>Feel free to log in with this password. We recommend changing it after your first login.</p>

<p>Thank you!</p>
