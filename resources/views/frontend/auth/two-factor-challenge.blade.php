<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Authentication Challenge</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
        }

        .auth-container {
            background: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .auth-container:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-verify {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            transition: all 0.3s ease;
        }

        .btn-verify:hover {
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
                    <svg class="mx-auto h-12 w-12 text-indigo-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                    </svg>
                    <h2 class="mt-2 text-2xl font-bold text-gray-900">
                        Two-Factor Authentication
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Please verify your identity to continue
                    </p>
                </div>

                @if (session('status') == 'verification-code-sent')
                    <div
                        class="mb-4 p-4 bg-green-50 rounded-lg border border-green-200 animate__animated animate__fadeIn">
                        <div class="flex">
                            <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <p class="ml-2 text-sm text-green-700">
                                A new verification code has been sent.
                            </p>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('two-factor.login') }}" id="auth-form">
                    @csrf
                    <div class="mb-6">
                        <label for="code" class="block text-sm font-medium text-gray-700 mb-1">
                            Authentication Code
                        </label>
                        <input id="code" type="text" name="code" required autocomplete="one-time-code"
                            autofocus
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('code') border-red-300 text-red-900 @enderror">
                        @error('code')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <button type="submit"
                            class="btn-verify w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Verify Code
                        </button>
                    </div>
                </form>

                @if (Route::has('verification.send'))
                    <div class="text-center">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="text-indigo-600 hover:text-indigo-500 text-sm font-medium">
                                Resend Verification Code
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>
