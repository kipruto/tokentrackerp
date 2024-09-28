<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>
<style>
    h1,
    h2,
    h3,
    h4,
    h5,
    p,
    a {
        font-family: "Figtree" !important;
    }
</style>
@vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js' ])

<body class="font-sans antialiased dark:bg-black dark:text-white/50 ">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <img id="background" class="absolute -left-20 top-0 max-w-[877px] h-full" src="{{ asset('images/background.svg') }}" />
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <main>
                    <div class="relative container px-4 mx-auto">
                        <div class="relative max-w-4xl mx-auto">
                            <div class="absolute inset-0  -ml-4 -mr-4"></div>
                            <div class="relative px-4 sm:px-8 ">
                                <div class="max-w-lg mx-auto text-center">
                                    <a class="inline-block mb-14 text-3xl font-bold font-heading" href="#">
                                        <img class="h-20" src="{{ asset('images/logo.png') }}" alt="" width="auto">
                                    </a>
                                    <h3 class="mb-8 text-4xl md:text-5xl font-bold font-heading">Welcome to ProjectPRO</h3>
                                    <p class="mb-10 font-semibold font-heading">Please Login to Continue</p>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <input class="w-full mb-4 px-12 py-3 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="text" placeholder="Email Address" name="email" required value="{{ old('email') }}">
                                        <input class="w-full mb-4 px-12 py-3 border border-gray-200 focus:ring-blue-300 focus:border-blue-300 rounded-md" type="password" placeholder="Password" name="password" required>
                                        @error('errorMessage')
                                        <div class=" text-red-600 font-bold text-sm">{{ $message }}</div>
                                        @enderror
                                        <button id="loginButton" class="w-full mt-4 bg-blue-800 hover:bg-blue-900 text-white font-bold font-heading py-3 rounded-md uppercase" type="submit">SUBMIT</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                @php

                $appVersion = env('APP_VERSION', 'unknown');

                @endphp

                <p class="py-10 text-center text-md text-black dark:text-white/70">
                   By continuing you agree to our Terms of Use & Privacy Policy
                </p>
                <p class="py-12 text-center text-sm text-black dark:text-white/70">
                    Project-PRO v{{ $appVersion }} (PHP v{{ PHP_VERSION }})
                </p>
            </div>
        </div>
    </div>
</body>

<script>


</script>

</html>