<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Support Message</title>
</head>
<body>
    <h2>New Support Request</h2>

    <p><strong>Name:</strong> {{ $name }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Subject:</strong> {{ $subjectText }}</p>

    <hr>

    <p><strong>Message:</strong></p>
    <p style="white-space: pre-line;">{{ $description }}</p>

    <hr>
    <p>This message was sent from the support form on your website.</p>
</body>
</html>
