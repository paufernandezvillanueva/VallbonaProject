<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') - {{ trans('translation.db_companies') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="{{ asset('css/lightmode.css') }}" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div id="container-form" class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg">
                <div id="school-logo" href="/">
                    <img src="{{ asset ('/img/logo-vallbona.png' )}}" class="w-20 h-20 fill-current text-gray-500"/><div>
                    {{ strtoupper(trans('translation.db_companies')) }}</div>
                </div>
                {{ $slot }}
            </div>
            <div class="language">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <label class="col-form-label" for="empresa_id">{{ trans('translation.language') }}</label>
                    </div>
            <div class="col-md-6 col-sm-6">
                <select id="changeLang" class="form-select changeLang">
                    <option value="ca" {{ session()->get('locale') == 'ca' ? 'selected' : '' }}>{{ trans('translation.catalan') }}</option>
                    <option value="es" {{ session()->get('locale') == 'es' ? 'selected' : '' }}>{{ trans('translation.spanish') }}</option>
                    <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>{{ trans('translation.english') }}</option>
                </select>
            </div>
        </div>
            </div>
        </div>
    </body>

</html>

<script type="text/javascript">

    window.onload = function () {
        var url = "{{ route('changeLang') }}";

        document.getElementById("changeLang").addEventListener("change", function(){
            window.location.href = url + "?lang="+ document.getElementById("changeLang").value;
        })
    }
</script>
