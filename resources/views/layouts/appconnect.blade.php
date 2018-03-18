<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Physics C&C</title>

    <link rel="stylesheet" href="{{ url('css/styles.css') }}">
</head>
<body>
    <div id="physics_menu">
        <div id="physics_logo">
            <img src="{{ url('imgs/logo2.png') }}">
        </div>
        <div id="physics_sidebar">
            <a href=""></a>
        </div>
    </div>

    <div id="container">
        @if(session()->has('message.level'))
            <div class="flash_message {{ session('message.level') }}">
                {!! session('message.content') !!}
            </div>
        @endif
        @yield('container')
    </div>
</body>
</html>