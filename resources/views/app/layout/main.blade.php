<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite('resources/css/app.css')

</head>

<body class="bg-[#ffffff] dark:bg-slate-800 h-screen w-screen overflow-hidden">

    @include('app.layout.header')

    @yield('main')

    @vite(['resources/js/alpine.js'])
  
</body>

</html>