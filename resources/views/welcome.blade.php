<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        /**
 * This CSS ensures that Emoji are the same size as the font and are centered up correctly.
 */
        .emoji {
            display: inline-flex;
            height: 1em;
            width: 1em;
            margin: 0 .05em 0 .1em;
            vertical-align: -0.14em;
            background: no-repeat center center;
            background-size: 1em 1em;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            <i class="emoji"
               style="background-image: url('https://raw.githubusercontent.com/iamcal/emoji-data/master/img-twitter-64/1f603.png')"></i>
            Laravel <img class="emoji"
                         src="https://raw.githubusercontent.com/iamcal/emoji-data/master/img-twitter-64/1f603.png">
        </div>

        <div class="links">

            <a href="https://laravel.com/docs">Documentation</a>
            <a href="https://laracasts.com">Laracasts</a>
            <a href="https://laravel-news.com">News</a>
            <a href="https://forge.laravel.com">Forge</a>
            <a href="https://github.com/laravel/laravel">GitHub</a>
            <a href="https://www.rhodes.ml"><i class="emoji"
                                               style="background-image: url('https://raw.githubusercontent.com/iamcal/emoji-data/master/img-twitter-64/1f603.png')"></i>
                My Site <img class="emoji"
                             src="https://raw.githubusercontent.com/iamcal/emoji-data/master/img-twitter-64/1f603.png"></a>
        </div>
    </div>
</div>
</body>
</html>
