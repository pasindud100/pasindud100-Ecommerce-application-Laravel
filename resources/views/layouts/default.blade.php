<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SVD e-commerce</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    @yield('style')
</head>
{{-- default blade layout .this for other pages after and before login ..not in register and login page --}}

<body>
    @include('includes.header')
    @yield('content')
    @include('includes.footer')
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    @yield('script')


</body>

</html>
