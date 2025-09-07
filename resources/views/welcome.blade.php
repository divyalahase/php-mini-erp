<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mini ERP</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="antialiased">
    <div class="flex justify-center items-center h-screen">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Mini ERP</h1>

            @if (Route::has('login'))
                <div class="space-x-4">
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
