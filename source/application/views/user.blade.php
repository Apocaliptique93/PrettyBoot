<!DOCTYPE html>
<html lang="en">

<head>
    @yield('meta')
    <title>{{ Appsettings::page_title() }}</title>
    {{ HTML::script('http://code.jquery.com/jquery-latest.min.js') }}
    {{ HTML::style('css/bootstrap.css') }}
    {{ HTML::style('css/userlayout.css') }}
</head>




<body>


<div class="contain">
    <a href="/" style="text-decoration: none;"><h1 style="text-align: center; font-size:350%; text-shadow: 0px 0px 5px #222">{{ Appsettings::logo() }}</h1></a>
    <div class="logre">

    @yield('content')
    </div>
</div>

<div class="credits">
    PrettyBoot written by Rogier
</div>
</body>


</html>