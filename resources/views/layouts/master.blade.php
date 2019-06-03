<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LMS | Land Management System</title>
    
    <link rel="icon" href="{{ asset('/img/logo.png') }}" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
  </head>
  <body class="hold-transition sidebar-mini">
    <div id="app"></div>
    <script src="{{ asset('/js/app.js') }}"></script>
  </body>
</html>
