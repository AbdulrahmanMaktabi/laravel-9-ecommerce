<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }

        .checkmark-circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 2;
            stroke-miterlimit: 10;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }

        .checkmark {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: block;
            stroke-width: 2;
            stroke: #fff;
            stroke-miterlimit: 10;
            margin: 10% auto;
            box-shadow: 0 0 0 rgba(16, 185, 129, 0.4);
            animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
        }

        .checkmark-check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        }

        @keyframes stroke {
            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes scale {

            0%,
            100% {
                transform: none;
            }

            50% {
                transform: scale3d(1.1, 1.1, 1);
            }
        }

        @keyframes fill {
            100% {
                box-shadow: inset 0px 0px 0px 30px #10b981;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden w-full max-w-md animate__animated animate__fadeInUp">
            <div class="p-8 text-center">
                <!-- Animated Checkmark -->
                <div class="mb-6">
                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" />
                        <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                    </svg>
                </div>

                <h1 class="text-2xl font-bold text-gray-800 mb-2 animate__animated animate__fadeIn animate__delay-1s">
                    Order Confirmed!
                </h1>
                <p class="text-gray-600 mb-6 animate__animated animate__fadeIn animate__delay-1s">
                    Thank you for your purchase. Your order has been received and is being processed.
                </p>

                <!-- Order Details -->
                <div
                    class="bg-gray-50 rounded-lg p-6 mb-6 text-left animate__animated animate__fadeIn animate__delay-2s">
                    <h2 class="font-semibold text-gray-700 mb-3">Order Details</h2>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Order Number:</span>
                            <span class="font-medium">#{{ $order->number ?? '12345' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Date:</span>
                            <span class="font-medium">{{ now()->format('F j, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total:</span>
                            <span class="font-medium text-green-600">${{ number_format($order->total ?? 0, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 animate__animated animate__fadeIn animate__delay-3s">
                    <a href="{{ url('/') }}"
                        class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 py-3 px-4 rounded-lg font-medium transition duration-300 text-center">
                        Back To Home
                    </a>
                </div>
            </div>

            <!-- Footer Note -->
            <div class="bg-gray-50 px-8 py-4 text-center animate__animated animate__fadeIn animate__delay-4s">
                <p class="text-sm text-gray-500">
                    Need help? <a href="#" class="text-green-600 hover:underline">Contact us</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
