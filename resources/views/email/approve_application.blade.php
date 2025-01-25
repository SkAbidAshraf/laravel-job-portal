<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Application Notification</title>
</head>

<body>
    <div class="email-container">
        <h1>Dear {{ $mailData['user']->name }},</h1>

        <p>We are pleased to inform you that your job application for the posting:
            <strong>"{{ $mailData['job']->title }}"</strong> has been approved.
        </p>

        <p>Please contact the employer using the information below:</p>
        <strong>Name:</strong> {{ $mailData['employer']->name }}<br>
        <strong>Email:</strong> {{ $mailData['employer']->email }}<br>
        @if (!empty($mailData['employer']->mobile))
            <strong>Phone:</strong> {{ $mailData['employer']->mobile }}<br>
        @endif

        <p>
            Thank you for using our platform to connect with hiring professionals and explore exciting job opportunities!
        </p>

        <p>To explore more job postings, visit our website:</p>
        <a href="{{ route('home') }}" class="button">Visit JobPortal.bd</a>

        <div class="footer">
            <p>Best regards,</p>
            <strong>JobPortal.bd Team</strong>
        </div>
    </div>
</body>

</html>
