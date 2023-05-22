<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') - {{ trans('translation.db_companies') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('stylesheets')
    @if (Auth::user()->darkmode == 0)
    <link rel="stylesheet" id="skin" href="{{ asset('css/lightmode.css') }}" />
    @else
    <link rel="stylesheet" id="skin" href="{{ asset('css/darkmode.css') }}" />
    @endif
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    @show

    <script src="{{ asset('../resources/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/darkmodeChanger.js') }}"></script>
    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!--  -->

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
<script type="application/javascript">
    var locale = "{{ Session::get('locale')}}";
    document.getElementById("darkmode").parentElement.addEventListener("click", function() {
        demanaDarkmode("{{  url('') }}");
    });

    // Abrir/Cerrar Menú
    function toggleDiv() {
        var div = document.getElementById("navbar");
        if (div.classList.contains("navbar-origin-open")) {
            div.classList.replace("navbar-origin-open", "navbar-close");
            document.getElementById("toggleButton").innerHTML = '<i class="bi bi-arrow-bar-right"></i>';
            localStorage.setItem("menuState", "hidden");
        } else if (div.classList.contains("navbar-origin-close")) {
            div.classList.replace("navbar-origin-close", "navbar-open");
            document.getElementById("toggleButton").innerHTML = '<i class="bi bi-arrow-bar-left"></i>';
            localStorage.setItem("menuState", "visible");
        } else if (div.classList.contains("navbar-open")) {
            div.classList.replace("navbar-open", "navbar-close");
            document.getElementById("toggleButton").innerHTML = '<i class="bi bi-arrow-bar-right"></i>';
            localStorage.setItem("menuState", "hidden");
        } else if (div.classList.contains("navbar-close")) {
            div.classList.replace("navbar-close", "navbar-open");
            document.getElementById("toggleButton").innerHTML = '<i class="bi bi-arrow-bar-left"></i>';
            localStorage.setItem("menuState", "visible");
        }
    }

    // Restaurar el estado del menú al cargar la página
    var menuState = localStorage.getItem("menuState");
    if (menuState === "hidden") {
        var div = document.getElementById("navbar");
        div.classList.replace("navbar-origin-open", "navbar-origin-close");
        document.getElementById("toggleButton").innerHTML = '<i class="bi bi-arrow-bar-right"></i>';
    }
</script>

</html>