<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Shipbay</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://js.stripe.com/v3/"></script>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic|Material+Icons">
    <style>
        html,
        body {
            height: 100%;
            min-height: 100%;
        }

        #app {
            height: 100%;
            min-height: 100%;
        }
    </style>
</head>

<body>
    <div id="app">
        <app></app>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>