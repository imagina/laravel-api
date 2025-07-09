<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body>
    @include('inotification::emails.base.header')
    @yield('content')
    @include('inotification::emails.base.footer')
</body>
</html>
