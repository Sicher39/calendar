<!DOCTYPE html>
<html lang="cz" class="scroll-smooth">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>


    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="{{ asset('img/favicon/favicon.svg')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/favicon/apple-touch-icon-144.svg')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/favicon/apple-touch-icon-114.svg')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/favicon/apple-touch-icon-72.svg')}}">
    <link rel="apple-touch-icon" href="{{ asset('img/favicon/apple-touch-icon-57.svg')}}">

    <!-- styles     -->
    <link rel="stylesheet" href="https://use.typekit.net/gkv1kcq">
    @vite('resources/css/app.css')
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>


<body >
<div class="block w-full z-0 bg-dark min-h-screen">
    {{ $slot }}
</div>


</body>
</html>
