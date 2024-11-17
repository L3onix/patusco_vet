<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>O Patusco</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        @vite('resources/js/app.js')
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div id="app"></div>
    </body>
</html>
