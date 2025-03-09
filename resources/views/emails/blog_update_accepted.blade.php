<!DOCTYPE html>
<html>
<head>
    <title>Blog Update Accepted</title>
</head>
<body>
    <h2>Congratulations!</h2>
    <p>{{ $messageContent }}</p>
    <p><strong>Blog Title:</strong> {{ $blog->title }}</p>
    <p><strong>Published At:</strong> {{ $blog->updated_at->format('m/d/Y H:i') }}</p>
    <p>You can view your blog on the website.</p>
</body>
</html>
