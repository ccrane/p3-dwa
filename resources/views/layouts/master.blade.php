<!doctype html>
<html lang='en'>
<head>
    <title>@yield('title', config('app.name'))</title>
    <meta charset='utf-8'>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans"/>

    {{-- CSS global to every page can be loaded here --}}
    <link rel="stylesheet"
          type="text/css"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <link href='{{ asset("css/foreignexchange.css") }}' rel='stylesheet'>

    {{-- CSS specific to a given page/child view can be included via a stack --}}
    @stack('head')
</head>
<body>

<header>
    {{-- Global header content, ie nav bar --}}
</header>

<section>
    @yield('content')
</section>

<footer>
    &copy; {{ date('Y') }}
</footer>

{{-- JS global to every page can be loaded here; jQuery included just as an example --}}
{{-- jQuery JS --}}
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
{{-- Bootstrap JS --}}
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"
        integrity="sha384-pjaaA8dDz/5BgdFUPX6M/9SUZv4d12SUPF0axWc+VRZkx5xU3daN+lYb49+Ax+Tl"
        crossorigin="anonymous"></script>

{{-- App specific JS--}}
<script type='text/javascript' src='{{ asset("js/foreignexchange.js") }}'></script>

{{-- JS specific to a given page/child view can be included via a stack --}}
@stack('body')

</body>
</html>
