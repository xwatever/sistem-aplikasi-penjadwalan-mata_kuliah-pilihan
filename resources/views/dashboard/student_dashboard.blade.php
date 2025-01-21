<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    @if (Auth::check())
        <meta name="user_id" content="{{ Auth::user()->identity_number }}" />
    @endif
    <title></title>
    <!-- <link rel="stylesheet" href="{{ asset('/dist/custom/css/header.css') }}"> -->
    <!-- <link rel="stylesheet" href="{{ asset('/dist/custom/css/footer.css') }}"> -->
    <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animasi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fcmodifiedstu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dtmodified.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vdtpmodified.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard_contents.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/datatablejs/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/datatablejs/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vue3-datetimepicker/dist/main.css') }}">
  </head>
  <body>
    <div id="app">
      <student-dashboard></student-dashboard>
    </div>
    <form id="logout-form" action="/logout" method="POST" class="d-none">
        @csrf
    </form>

    <script src="{{ asset(mix('js/app.js')) }}"></script>
    <!-- <script src="{{ asset('js/dist/datatablejs/jquery.dataTables.min.css') }}"></script> -->
    <!-- <script src="{{ asset('js/dashboard.js') }}"></script> -->
    <!-- <script src="{{ asset('/dist/custom/js/navbar.js') }}"></script> -->
  </body>
</html>
