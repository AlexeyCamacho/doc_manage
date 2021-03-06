
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
        <link rel="stylesheet" href="{{ asset('css/tableSort.css') }}">
        <link rel="stylesheet" href="{{ asset('css/vanillaSelectBox.css') }}">


        <!-- Scripts -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/index.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/hint.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/TableSort.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/vanillaSelectBox.js') }}"></script>
    </head>
    <body class="h-100 d-flex flex-column">

        @include('inc.navbar')

        <main class="opacity-50">
            @yield('content')
        </main>

        @include('inc.footer')

        <form id="ajax-form">
            @csrf
        </form>

    </body>
</html>



<script type="text/javascript">

document.addEventListener('DOMContentLoaded', function(){
    reload_hint();
});

</script>

@yield('running_scripts')
