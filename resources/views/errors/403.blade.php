<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>403 Forbidden</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url('https://wallpaperaccess.com/full/9070138.jpg');
            /* Rick and Morty background */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.7);
            height: 100vh;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        .content {
            position: relative;
            z-index: 2;
        }
    </style>
</head>

<body>
    <div class="overlay"></div>
    <div class="d-flex align-items-center justify-content-center vh-100 content text-center">
        <div>
            <h1 class="display-1 fw-bold text-danger">403</h1>
            <p class="fs-4">Wubba Lubba Dub Dub! You don’t have access to this dimension.</p>
            <a href="{{ route('dashboard') }}" class="btn btn-warning fw-bold">⬅ Back to Home</a>
        </div>
    </div>
</body>

</html>
