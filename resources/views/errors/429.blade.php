<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Too Many Requests</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
        }

        .error-container {
            background: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .error-container:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-retry {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            transition: all 0.3s ease;
        }

        .btn-retry:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.3);
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md bg-white rounded-xl shadow-md overflow-hidden animate__animated animate__fadeIn">
            <div class="p-8">
                <div class="text-center mb-6">
                    <svg class="mx-auto h-12 w-12 text-red-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <h2 class="mt-2 text-2xl font-bold text-gray-900">
                        429 - Too Many Requests
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        You've made too many requests too quickly.
                    </p>
                </div>

                <div
                    class="mb-6 p-4 bg-yellow-50 rounded-lg border border-yellow-200 animate__animated animate__fadeIn">
                    <div class="flex">
                        <svg class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p class="ml-2 text-sm text-yellow-700">
                            Please wait a few moments before trying again.
                        </p>
                    </div>
                </div>

                <div class="mb-6 text-center">
                    <p class="text-sm text-gray-500">
                        This is a rate-limiting protection to prevent abuse.
                        You'll be able to try again shortly.
                    </p>
                </div>

                <div class="mt-6 text-center">
                    <button onclick="window.location.reload()"
                        class="btn-retry inline-flex justify-center py-2 px-6 border border-transparent rounded-md shadow-sm text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Retry Now
                    </button>
                </div>

                <div class="mt-6 text-center text-xs text-gray-400">
                    <p>If this persists, please contact support.</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
