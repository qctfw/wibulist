<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $title ?? $code }} - {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <!-- Google Fonts - Lato -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"/>
    <!-- Google Fonts - Catamaran -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100;200;300;400;500;600;700;800;900&display=swap" />

    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
</head>
<body class="font-sans dark:bg-gray-800 dark:text-white">
    <article class="flex flex-col items-center justify-center h-screen gap-4 text-center">
        <h1 class="font-bold font-primary text-7xl">{{ $code }}</h1>
        <p>{{ $message }}</p>
        <p>- {{ config('app.name') }} -</p>
    </article>
</body>
</html>