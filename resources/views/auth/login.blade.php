<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
    <!-- <link rel="stylesheet" href="{{ asset('/dist/custom/css/header.css') }}"> -->
    <!-- <link rel="stylesheet" href="{{ asset('/dist/custom/css/footer.css') }}"> -->
    <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  </head>
  <body>
    <div id="app">
        <login></login>
    </div>

    <script src="{{ asset(mix('js/app.js')) }}"></script>
    <!-- <script src="{{ asset('/dist/custom/js/navbar.js') }}"></script> -->
  </body>
</html>
