<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Physics C&C</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css" integrity="sha384-v2Tw72dyUXeU3y4aM2Y0tBJQkGfplr39mxZqlTBDUZAb9BGoC40+rdFCG0m10lXk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css" integrity="sha384-q3jl8XQu1OpdLgGFvNRnPdj5VIlCvgsDQTQB6owSOHWlAurxul7f+JpUOVdAiJ5P" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('css/styles.css') }}">
</head>
<body>
    <div id="physics_menu">
        <div id="physics_logo">
            <img src="{{ url('imgs/logo2.png') }}">
        </div>
        <div id="physics_sidebar">
            <a href="{{ url('/user/account/devices') }}">Devices</a>
            <a href="{{ url('/user/account/settings') }}">settings</a>
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