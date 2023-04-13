<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Projecto - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('stylesheets')
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    @show

    <script src="{{ asset('../resources/js/scripts.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!--  -->
    <title>Document</title>

</head>
<body>


<main>

    @include('navbar')
    <div class="bodyTable">

    <div class="container">
        @yield('content')
    </div>
    </div>

</main>

</body>
</html>
