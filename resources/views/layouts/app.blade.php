<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ config('app.name') }} - {{ isset($page_title)?$page_title:'This route does not have a defined title.' }}
    </title>

    <!-- Styles -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
	<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet"/>

    @stack('styles')
    @stack('scripts_header')
</head>

<body data-ma-theme="{{ config('roadzoft.roadzoft_theme') }}">

	<body data-ma-theme="{{ config('roadzoft.roadzoft_theme') }}">



    @yield('content')

    <!-- Older IE warning message -->
    <!--[if IE]>
    <div class="ie-warning">
        <h1>Warning!!</h1>
        <p>You are using an outdated version of Internet Explorer, please upgrade to any of the following web browsers to access this website.</p>

        <div class="ie-warning__downloads">
            <a href="http://www.google.com/chrome">
                <img src="{{ asset('img/browsers/chrome.png') }}" alt="">
            </a>

            <a href="https://www.mozilla.org/en-US/firefox/new">
                <img src="{{ asset('img/browsers/firefox.png') }}" alt="">
            </a>

            <a href="http://www.opera.com">
                <img src="{{ asset('img/browsers/opera.png') }}" alt="">
            </a>

            <a href="https://support.apple.com/downloads/safari">
                <img src="{{ asset('img/browsers/safari.png') }}" alt="">
            </a>

            <a href="https://www.microsoft.com/en-us/windows/microsoft-edge">
                <img src="{{ asset('img/browsers/edge.png') }}" alt="">
            </a>

            <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                <img src="{{ asset('img/browsers/ie.png') }}" alt="">
            </a>
        </div>
        <p>Sorry for the inconvenience!</p>
    </div>
    <![endif]-->

    <!-- Scripts -->
    <script src="{{ asset('js/all.js') }}"></script>
    <script src="{{ asset('js/lodash.min.js') }}"></script>

 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 


	<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@1.5.4/src/loadingoverlay.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@1.5.4/extras/loadingoverlay_progress/loadingoverlay_progress.min.js"></script>
    <script>
        function setHeader(xhr) {
            xhr.setRequestHeader('Content-Type', 'application/json');
        }
    </script>
    @stack('scripts')
</body>
</html>
