
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SVD e-commerce</title>
    <link rel="stylesheet" href="{{asset("assets/css/bootstrap.min.css")}}">
    @yield("style")
</head>
<body class="d-flex aliign-items-center py-4 bg-body-tertiary">
    {{-- This for the login and registration --}}
    @yield("content")
    <script src="{{asset("assets/js/bootstrap.min.js")}}"></script>
    @yield("script")
    

</body>
</html>