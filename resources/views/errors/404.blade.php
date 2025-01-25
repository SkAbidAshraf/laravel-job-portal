<!DOCTYPE html>
<html class="no-js" lang="en_AU" />

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <title>
        @hasSection('title')
            @yield('title') - JobPortal.bd
        @else
            JobPortal.bd
        @endif
    </title>

    <meta name="description" content="" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="pinterest" content="nopin" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />

    <style>
        html {
            height: 100%;
        }

        body {
            min-height: 100%;
        }
    </style>
    <link rel="shortcut icon" type="image/x-icon" href="#" />
</head>

<body data-instant-intensity="mousedown" class="d-flex flex-column bg-light">
    <div class="container my-auto">
        <div class="p-4 my-auto text-center">
            <div class="card p-5 rounded text-secondary">
                <h1 class="display-1 fw-bold">
                    404
                </h1>
                <h4 class="display-6">
                    Invalid Request
                </h4>
                <hr>
                <p class="text-center my-2"> 
                    <a class="btn btn-primary btn-lg my-2" href="{{ route('home') }}">Return Home</a>
                </p>
            </div>
        </div>
    </div>

</body>

</html>
