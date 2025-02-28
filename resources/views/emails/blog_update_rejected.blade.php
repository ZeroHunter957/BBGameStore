<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Rejected</title>
</head>
<body>
    <h1>Blog Update Rejected</h1>
    <p>Dear {{ $blog->user->name }},</p>

    <p>We regret to inform you that your request to {{ $rejectType }} the blog titled <strong>{{ $blog->title }}</strong> has been rejected by the admin.</p>

    <p>Reason: {{ $rejectMessage }}</p>

    <p>If you have any questions, please contact the admin.</p>

    <p>Best regards,</p>
    <p>The Admin Team</p>
</body>
</html>
