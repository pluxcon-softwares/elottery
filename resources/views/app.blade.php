<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>iLottery</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div id="app">
    <router-view></router-view>
</div>

<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
