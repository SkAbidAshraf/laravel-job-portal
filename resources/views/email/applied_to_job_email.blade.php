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
        <h1>Dear {{ $mailData['employer']->name }},</h1>

        <p>We are excited to inform you that a new application has been submitted for your job posting:
            <strong>"{{ $mailData['job']->title }}"</strong>.
        </p>

        <p>Here are the applicant's details:</p>
        <strong>Name:</strong> {{ $mailData['user']->name }}<br>
        <strong>Email:</strong> {{ $mailData['user']->email }}<br>
        @if (!empty($mailData['user']->mobile))
            <strong>Phone:</strong> {{ $mailData['user']->mobile }}<br>
        @endif


        <p>We recommend contacting the applicant at your earliest convenience to take the next steps in your hiring
            process.</p>

        <p>Thank you for choosing our platform to find top talent for your organization!</p>

        <p>To manage your job postings and applications, visit our website:</p>
        <a href="{{ route('home') }}" class="button">Go to JobPortal.bd</a>

        <div class="footer">
            <p>Best regards,</p>
            <strong>JobPortal.bd Team</strong>
        </div>
    </div>
</body>

</html>
